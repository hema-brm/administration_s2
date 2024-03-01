<?php

// src/Service/SalesReportService.php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class SalesReportService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function generateSalesReport(): array
    {
        // Query to get product sales data
            $productSalesQuery = $this->entityManager->createQuery('
            SELECT p.name AS product_name, 
                   SUBSTRING(b.billIssuanceDate, 1, 4) AS year, 
                   SUBSTRING(b.billIssuanceDate, 6, 2) AS month, 
                   SUM(pb.quantity) AS total_sales
            FROM App\Entity\ProductBill pb
            JOIN pb.bill b
            JOIN pb.product p
            GROUP BY product_name, year, month
        ');

        $productSalesData = $productSalesQuery->getResult();

        // Query to get category sales data
        $categorySalesQuery = $this->entityManager->createQuery('
            SELECT c.name AS category_name, 
                   SUBSTRING(b.billIssuanceDate, 1, 4) AS year, 
                   SUBSTRING(b.billIssuanceDate, 6, 2) AS month, 
                   SUM(pb.quantity) AS total_sales
            FROM App\Entity\ProductBill pb
            JOIN pb.bill b
            JOIN pb.product p
            JOIN p.category c
            GROUP BY category_name, year, month
        ');

        $categorySalesData = $categorySalesQuery->getResult();

        return [
            'product_sales' => $productSalesData,
            'category_sales' => $categorySalesData,
        ];
    }
}
