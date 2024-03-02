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
        return $this->createQueryBuilder('productBill')
            ->select('p.name AS productName', "DATE_FORMAT(pay.datePaiement, '%Y-%m') AS period", 'SUM(productBill.quantity) AS totalQuantity', 'SUM(productBill.quantity * productBill.price) AS totalAmount')
            ->join('productBill.bill', 'bill')
            ->join('bill.payment', 'pay')
            ->join('productBill.product', 'p')
            ->where('pay.status = :status')
            ->setParameter('status', 'terminé')
            ->groupBy('productName', 'period', 'pay.datePaiement')
            ->getQuery()
            ->getResult();
    }

    public function getProductSalesByYear(): array
    {
        return $this->createQueryBuilder('productBill')
            ->select('p.name AS productName', "DATE_FORMAT(pay.datePaiement, '%Y') AS year", 'SUM(productBill.quantity) AS totalQuantity', 'SUM(productBill.quantity * productBill.price) AS totalAmount')
            ->join('productBill.bill', 'bill')
            ->join('bill.payment', 'pay')
            ->join('productBill.product', 'p')
            ->where('pay.status = :status')
            ->setParameter('status', 'terminé')
            ->groupBy('productName', 'year', 'pay.datePaiement')
            ->getQuery()
            ->getResult();
    }
}
