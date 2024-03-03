<?php

namespace App\Service\Quote;

use App\Entity\Quote;
use App\Entity\Product;
use App\Entity\Customer;
use App\Service\PdfService;
use App\Entity\ProductQuote;
use App\Repository\QuoteRepository;
use App\Controller\MailerController;
use App\Repository\ProductRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Quote\QuotePdfController;

class QuoteCreatorService {

    public const CREATE_MODE = 'create';
    public const EDIT_MODE = 'edit';
    public const READONLY_MODE = 'readonly';

    public function __construct(
        private readonly CustomerRepository $customerRepository,
        private readonly ProductRepository $productRepository,
        private readonly QuoteRepository $quoteRepository,
        private readonly PdfService $pdfService,
        private readonly QuotePdfController $quotePdfController,
        private readonly MailerController $mailer
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

    public function addLineItem(array &$lineItems): void
    {
        $defaultProduct = $this->productRepository->getFirstProduct();

        $lineItems[] = [
            'productId' => $defaultProduct->getId(),
            'price' => $defaultProduct->getPrice(),
            'quantity' => 1,
            'tva' => Product::DEFAULT_TAX_RATE,
            'discount' => 0,
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
                    'price' => $productQuote->getPrice(),
                    'quantity' => $productQuote->getQuantity(),
                    'tva' => $productQuote->getTva(),
                    'discount' => $productQuote->getDiscount(),
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
        float $tva,
        float $discount,
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
        $lineItems[$key]['tva'] = $tva;
        $lineItems[$key]['discount'] = $discount;
    }

    private function removeExistingProductQuotes(EntityManagerInterface $entityManager,?Quote $quoteData, array &$lineItems): void
    {
        foreach ($quoteData->getProductQuotes() as $key => $item) {
            $quoteData->removeProductQuote($item);
            $entityManager->remove($item);
        }
    }

    private function setProductQuoteItems(EntityManagerInterface $entityManager, ?Quote $quoteData, array &$lineItems): void
    {
        foreach ($lineItems as $key => $lineItem) {
            $productQuoteItem = new ProductQuote();
            $product = $this->findProduct($lineItem['productId']);
            $productQuoteItem->setProduct($product);
            $productQuoteItem->setQuantity($lineItem['quantity']);
            $productQuoteItem->setTva($lineItem['tva']);
            $productQuoteItem->setDiscount($lineItem['discount']);
            $productQuoteItem->setPrice($lineItem['price']);
            $productQuoteItem->setQuote($quoteData);
            $quoteData->addProductQuote($productQuoteItem);
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
        int $status,
        array &$lineItems,
    ): void
    {
        $customer = $this->findCustomer($customerId);

        $quoteData->setCustomer($customer);
        $quoteData->setQuoteNumber($quoteNumber);
        $quoteData->setDiscount($discount);
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
        int $status,
        array &$lineItems,
    ): void
    {
        $this->removeExistingProductQuotes($entityManager, $quoteData, $lineItems);
        $this->setQuoteBeforeSaving($entityManager, $quoteData, $customerId, $quoteNumber, $issuanceDate, $expiryDate, $discount, $status, $lineItems);
        
        if($quoteData->getStatus() == Quote::STATUS_SENT || $quoteData->getStatus() == Quote::STATUS_ACCEPTED){
            $this->mailer->newQuoteCreateEmail($quoteData->getCustomer(), $quoteData, $this->pdfService, $this->quotePdfController);
        }
        
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
