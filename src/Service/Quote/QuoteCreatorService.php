<?php

namespace App\Service\Quote;

use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\ProductQuote;
use App\Entity\Quote;
use App\Repository\CustomerRepository;
use App\Repository\ProductRepository;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;

class QuoteCreatorService {

    public function __construct(
        private readonly CustomerRepository $customerRepository,
        private readonly ProductRepository $productRepository,
        private readonly QuoteRepository $quoteRepository,
    ) {}

    private static function setDefaultIssuanceDate(?\DateTime &$defaultIssuanceDate): void
    {
        $defaultIssuanceDate = new \DateTime();
    }

    private static function setDefaultExpiryDate(
        ?\DateTimeInterface $issuanceDate,
        ?\DateTime &$expiryDate
    ): void
    {
        if (empty($issuanceDate))
        {
            $expiryDate = new \DateTime();
        }
        $issuanceDateTmp = clone $issuanceDate;
        $expiryDate = \DateTime::createFromInterface($issuanceDateTmp->add(new \DateInterval('P3M')));
    }

    public function setDefaultDates(
        ?\DateTimeInterface &$issuanceDate,
        ?\DateTime &$expiryDate
    ): void
    {
        self::setDefaultIssuanceDate($issuanceDate);
        self::setDefaultExpiryDate($issuanceDate, $expiryDate);
    }

    public function getDefaultQuoteNumber(): string
    {
        $lastQuote = $this->quoteRepository->findLastQuote();
        $now = (new \DateTime())->format('Ymd');

        if (empty($lastQuote))
        {
            return $now . '1';
        }

        return $now . ($lastQuote->getId() + 1);
    }

    public function getDefaultCustomer(): ?Customer
    {
        return $this->customerRepository->getFirstCustomer();
    }

    public function findCustomer(int $customerId): ?Customer
    {
        return $this->customerRepository->find($customerId);
    }

    public function findProduct(int $id): ?Product
    {
        return $this->productRepository->find($id);
    }

    public function addLineItem(array &$lineItems): void
    {
        $lineItems[] = [
            'productId' => null,
            'quantity' => 1,
            'price' => 0.0,
            'total' => 0.0,
            'isEditing' => true,
        ];
    }

    public function removeLineItem(array &$lineItems, int $key): void
    {
        if (!isset($lineItems[$key])) {
            return;
        }

        unset($lineItems[$key]);
    }

    public function onLineItemEditModeChange(array &$lineItems, int $key, bool $isEditing): void
    {
        if (!isset($lineItems[$key])) {
            return;
        }

        $lineItems[$key]['isEditing'] = $isEditing;
    }

    public function saveLineItem(
        array &$lineItems,
        int $key,
        Product $product,
        int $quantity,
        float $price,
        float $total
    ): void
    {
        if (!isset($lineItems[$key])) {
            return;
        }

        $lineItems[$key]['productId'] = $product->getId();
        $lineItems[$key]['price'] = $price;
        $lineItems[$key]['quantity'] = $quantity;
        $lineItems[$key]['total'] = $total;
    }

    private function ensurePresentProductQuote(?Quote $quoteData): void
    {
        foreach ($quoteData->getProductQuotes() as $key => $item) {
            if (!isset($this->lineItems[$key])) {
                $quoteData->removeProductQuote($item);
            }
        }
    }

    private function setProductQuoteItems(EntityManagerInterface $entityManager, ?Quote $quoteData, array &$lineItems): void
    {
        foreach ($lineItems as $key => $lineItem) {
            $productQuoteItem = $quoteData->getProductQuotes()->get($key);
            if (null === $productQuoteItem) {
                $productQuoteItem = new ProductQuote();
                $entityManager->persist($productQuoteItem);
                $quoteData->addProductQuote($productQuoteItem);
            }

            $product = $this->findProduct($lineItem['productId']);
            $productQuoteItem->setProduct($product);
            $productQuoteItem->setQuantity($lineItem['quantity']);
            $productQuoteItem->setPrice($lineItem['price']);
        }
    }

    private function setQuoteBeforeSaving(
        EntityManagerInterface $entityManager,
        Quote $quoteData,
        int $customerId,
        string $quoteNumber,
        \DateTimeInterface $issuanceDate,
        \DateTimeInterface $expiryDate,
        float $discount,
        float $tva,
        int $status,

    ): void
    {
        $customer = $this->findCustomer($customerId);

        $quoteData->setCustomer($customer);
        $quoteData->setQuoteNumber($quoteNumber);
        $quoteData->setDiscount($discount);
        $quoteData->setTva($tva);
        $quoteData->setStatus($status);
        $quoteData->setQuoteIssuanceDate($issuanceDate);
        $quoteData->setExpiryDate($expiryDate);

        $entityManager->persist($quoteData);
        $entityManager->flush();
    }

    public function saveQuote(
        EntityManagerInterface $entityManager,
        Quote $quoteData,
        int $customerId,
        string $quoteNumber,
        \DateTimeInterface $issuanceDate,
        \DateTimeInterface $expiryDate,
        float $discount,
        float $tva,
        int $status,
        array &$lineItems
    ): void
    {
        $this->ensurePresentProductQuote($quoteData);
        $this->setProductQuoteItems($entityManager, $quoteData, $lineItems);
        $this->setQuoteBeforeSaving($entityManager, $quoteData, $customerId, $quoteNumber, $issuanceDate, $expiryDate, $discount, $tva, $status);
    }

    private function areAnyLineItemsEditing(array $lineItems): bool
    {
        foreach ($lineItems as $lineItem) {
            if ($lineItem['isEditing']) {
                return true;
            }
        }

        return false;
    }

    public function productItemsIsEmpty(array $lineItems): bool
    {
        return empty($lineItems);
    }

    public function canSaveQuote(array $lineItems): bool
    {
        return !$this->areAnyLineItemsEditing($lineItems) && !$this->productItemsIsEmpty($lineItems);
    }

    public function getTotals(
        array $lineItems,
        ?float $discount,
        ?float $tva,
    ): array
    {
        $total = 0;

        foreach ($lineItems as $lineItem) {
            $total += $lineItem['total'];
        }

        $totalTva = $total * ($tva / 100);
        $totalDiscount = $total * ($discount / 100);

        $totalTTC = $total + $totalTva;

        return [
            'total' => $total,
            'totalTva' => $totalTva,
            'totalTTC' => $totalTTC,
            'totalDiscount' => $totalDiscount,
            'grandTotal' => $totalTTC - $totalDiscount,
        ];
    }

}
