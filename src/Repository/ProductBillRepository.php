<?php

namespace App\Repository;

use App\Entity\ProductBill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductBillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductBill::class);
    }

    public function getProductSalesByMonth(): array
    {
        $productSales = $this->createQueryBuilder('productBill')
            ->select('p.name AS productName', "DATE_FORMAT(pay.datePaiement, '%Y-%m') AS period", 'SUM(productBill.quantity) AS totalQuantity', 'SUM(productBill.quantity * productBill.price) AS totalAmount')
            ->join('productBill.bill', 'bill')
            ->join('bill.payment', 'pay')
            ->join('productBill.product', 'p')
            ->where('pay.status = :status')
            ->setParameter('status', 'terminé')
            ->groupBy('productName', 'period')
            ->orderBy('period', 'DESC')
            ->getQuery()
            ->getResult();

        foreach ($productSales as &$productSale) {
            $productSale['totalAmount'] = $this->calculateTotalForProductSale($productSale);
        }

        return $productSales;
    }


    private function calculateTotalForProductSale(array $productSale): float
    {
        $totalAmount = 0;
        $productBills = $this->createQueryBuilder('productBill')
            ->join('productBill.bill', 'bill')
            ->join('bill.payment', 'pay')
            ->join('productBill.product', 'p')
            ->where('pay.status = :status')
            ->andWhere('p.name = :productName')
            ->andWhere("DATE_FORMAT(pay.datePaiement, '%Y-%m') = :period")
            ->setParameter('status', 'terminé')
            ->setParameter('productName', $productSale['productName'])
            ->setParameter('period', $productSale['period'])
            ->getQuery()
            ->getResult();

        foreach ($productBills as $productBill) {
            $totalAmount += $productBill->getTotal();
        }

        return $totalAmount;
    }
}
