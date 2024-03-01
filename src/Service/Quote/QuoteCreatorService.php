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

    public const CREATE_MODE = 'create';
    public const EDIT_MODE = 'edit';
    public const READONLY_MODE = 'readonly';

    public function __construct(
        private readonly CustomerRepository $customerRepository,
        private readonly ProductRepository $productRepository,
        private readonly QuoteRepository $quoteRepository,
    ) {}

    private static function setDefaultIssuanceDate(?\DateTime &$defaultIssuanceDate, ?Quote $quote = null): void
    {
        $quoteExists = !empty($quote) && $quote->hasId();
        if ($quoteExists) {
            $defaultIssuanceDate = $quote->getQuoteIssuanceDate();
            return;
        }
        $defaultIssuanceDate = new \DateTime();
    }

    private static function setDefaultExpiryDate(
        ?\DateTimeInterface $issuanceDate,
        ?\DateTime &$expiryDate,
        ?Quote $quote = null
    ): void
    {
        $quoteExists = !empty($quote) && $quote->hasId();
        if ($quoteExists) {
            $expiryDate = $quote->getExpiryDate();
            return;
        }

        if (empty($issuanceDate))
        {
            $expiryDate = new \DateTime();
        }
        $issuanceDateTmp = clone $issuanceDate;
        $expiryDate = \DateTime::createFromInterface($issuanceDateTmp->add(new \DateInterval('P3M')));
    }

    public static function setDefaultDates(
        ?\DateTimeInterface &$issuanceDate,
        ?\DateTime &$expiryDate,
        ?Quote $quote = null
    ): void
    {
        self::setDefaultIssuanceDate($issuanceDate, $quote);
        self::setDefaultExpiryDate($issuanceDate, $expiryDate, $quote);
    }

    public function getDefaultQuoteNumber(?Quote $quote = null): string
    {
        $quoteExists = !empty($quote) && $quote->hasId();

        if ($quoteExists) {
            return $quote->getQuoteNumber();
        }

        $lastQuote = $this->quoteRepository->findLastQuote();
        $now = (new \DateTime())->format('Ymd');

        if (empty($lastQuote))
        {
            return $now . '1';
        }

        return $now . ($lastQuote->getId() + 1);
    }

    public function getDefaultCustomer(?Quote $quote = null): ?Customer
    {
        $quoteExists = !empty($quote) && $quote->hasId();
        if ($quoteExists) {
            return $quote->getCustomer();
        }

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

    public static function addLineItem(array &$lineItems): void
    {
        $lineItems[] = [
            'productId' => null,
            'quantity' => 1,
            'price' => 0.0,
            'total' => 0.0,
            'isEditing' => true,
        ];
    }

    public static function setDefaultProductQuotes(
        ?Quote $quote = null,
        array &$lineItems = null,
    ): void
    {
        $quoteExists = !empty($quote) && $quote->hasId();
        if ($quoteExists) {
            $productQuotes = $quote->getProductQuotes();
            foreach ($productQuotes as $productQuote) {
                $lineItems[] = [
                    'productId' => $productQuote->getProduct()->getId(),
                    'quantity' => $productQuote->getQuantity(),
                    'price' => $productQuote->getPrice(),
                    'total' => ProductQuote::_getTotal($productQuote->getPrice(), $productQuote->getQuantity()),
                    'isEditing' => false,
                ];
            }
        }
    }

    public static function removeLineItem(array &$lineItems, int $key): void
    {
        if (!isset($lineItems[$key])) {
            return;
        }

        unset($lineItems[$key]);
    }

    public static function onLineItemEditModeChange(array &$lineItems, int $key, bool $isEditing): void
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

    private function ensurePresentProductQuote(?Quote $quoteData, array &$lineItems): void
    {

        foreach ($quoteData->getProductQuotes() as $key => $item) {
            if (!isset($lineItems[$key])) {
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
                $product = $this->findProduct($lineItem['productId']);
                $productQuoteItem->setProduct($product);
                $productQuoteItem->setQuantity($lineItem['quantity']);
                $productQuoteItem->setPrice($lineItem['price']);
                $productQuoteItem->setQuote($quoteData);
                $quoteData->addProductQuote($productQuoteItem);
            }
            $entityManager->persist($productQuoteItem);
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
        array &$lineItems,
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

        $this->setProductQuoteItems($entityManager, $quoteData, $lineItems);

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
        array &$lineItems,
    ): void
    {
        $this->ensurePresentProductQuote($quoteData, $lineItems);
        $this->setQuoteBeforeSaving($entityManager, $quoteData, $customerId, $quoteNumber, $issuanceDate, $expiryDate, $discount, $tva, $status, $lineItems);
    }

    private static function areAnyLineItemsEditing(array $lineItems): bool
    {
        foreach ($lineItems as $lineItem) {
            if ($lineItem['isEditing']) {
                return true;
            }
        }

        return false;
    }

    public static function productItemsIsEmpty(array $lineItems): bool
    {
        return empty($lineItems);
    }

    public function canSaveQuote(array $lineItems): bool
    {
        return (!self::areAnyLineItemsEditing($lineItems))
            && (!self::productItemsIsEmpty($lineItems));
    }

    public static function getTotals(
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

    public static function getMode(?Quote $quote = null): string
    {
        if (empty($quote) || !$quote->hasId()) {
            return self::CREATE_MODE;
        }

        $editableStatuses = [
            Quote::STATUS_DRAFT,
            Quote::STATUS_SENT,
            Quote::STATUS_REFUSED,
        ];

        if (in_array($quote->getStatus(), $editableStatuses)) {
            return self::EDIT_MODE;
        }

        return self::READONLY_MODE;
    }

}
