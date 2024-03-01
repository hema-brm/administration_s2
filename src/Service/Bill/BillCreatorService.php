<?php

namespace App\Service\Bill;

use App\Entity\Bill;
use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\ProductBill;
use App\Entity\ProductQuote;
use App\Entity\Quote;
use App\Repository\BillRepository;
use App\Repository\CustomerRepository;
use App\Repository\ProductRepository;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;

class BillCreatorService {

    public function __construct(
        private readonly BillRepository $billRepository,
        private readonly CustomerRepository $customerRepository,
    ) {}

    public function getDefaultBillNumber(?Bill $bill = null): int|string
    {
        if (!empty($bill) && $bill->hasId()) {
            return $bill->getBillNumber();
        }

        $lastBill = $this->billRepository->findLastBill();
        $now = (new \DateTime())->format('Ymd');

        if (empty($lastBill)) {
            return $now . '1';
        }

        return $now . ($lastBill->getId() + 1);
    }

    public function getDefaultCustomer(?Bill $bill = null): ?Customer
    {
        $billExists = !empty($bill) && $bill->hasId();
        if ($billExists) {
            return $bill->getCustomer();
        }

        return $this->customerRepository->getFirstCustomer();
    }

    public function getDefaultBillIssuanceDate(?Bill $bill = null): \DateTimeInterface
    {
        $billExists = !empty($bill) && $bill->hasId();
        if ($billExists) {
            return $bill->getBillIssuanceDate();
        }

        return new \DateTime();
    }

    public function getDefaultBillStatus(?Bill $bill = null): int
    {
        $billExists = !empty($bill) && $bill->hasId();
        if ($billExists) {
            return $bill->getStatus();
        }

        return Bill::STATUS_DRAFT;
    }

    public function getDefaultDiscount(?Bill $bill = null): float
    {
        $billExists = !empty($bill) && $bill->hasId();
        if ($billExists) {
            return $bill->getDiscount();
        }

        return 0.0;
    }

    public function getDefaultProductBills(?Bill $bill = null): array
    {
        $billExists = !empty($bill) && $bill->hasId();
        $productBills = [];
        if ($billExists) {
            foreach ($bill->getProductBills() as $productBill) {
                $productBills[] = $this->generateProductBillDataArray($productBill);
            }
        }

        return $productBills;
    }

    private function generateProductBillDataArray(ProductBill $productBill): array
    {
        return [
            'productId' => $productBill->getProduct()->getId(),
            'quantity' => $productBill->getQuantity(),
            'price' => $productBill->getPrice(),
            'tva' => $productBill->getTva(),
            'total' => $productBill->getRealTotal(),
            'isEditing' => false,
        ];
    }

}
