<?php

namespace App\Service;

use App\Repository\ProductBillRepository;

class SalesReportService
{
    private $productBillRepository;

    public function __construct(ProductBillRepository $productBillRepository)
    {
        $this->productBillRepository = $productBillRepository;
    }

    public function getProductSalesByMonth(): array
    {
        return $this->productBillRepository->getProductSalesByMonth();
    }

    public function getProductSalesByYear(): array
    {
        return $this->productBillRepository->getProductSalesByYear();
    }
}
