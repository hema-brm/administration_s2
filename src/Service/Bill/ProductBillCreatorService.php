<?php

namespace App\Service\Bill;

use App\Entity\Product;
use App\Entity\ProductBill;
use App\Repository\ProductRepository;

class ProductBillCreatorService {

    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    public function generateDefaultProductBill(): ProductBill
    {
        $product = $this->productRepository->getFirstProduct();

        $newProductItem = new ProductBill();
        $newProductItem->setProduct($product);
        $newProductItem->setQuantity(1);
        $newProductItem->setPrice(0.0);

        return $newProductItem;
    }

    public function generateDefaultProductBillData(): array
    {
        $newProductBill = $this->generateDefaultProductBill();
        $price = $newProductBill->getProduct()->getPrice();
        $newProductBill->setPrice($price);
        $newProductBill->setTva(Product::DEFAULT_TAX_RATE);

        return [
            'productId' => $newProductBill->getProduct()->getId(),
            'quantity' => $newProductBill->getQuantity(),
            'price' => $newProductBill->getPrice(),
            'tva' => $newProductBill->getTva(),
            'discount' => 0.0,
            'total' => $newProductBill->getTotal(),
            'isEditing' => true,
        ];
    }

    public function createProductBill(array $data): ProductBill
    {
        $productBill = new ProductBill();

        $product = $this->productRepository->find($data['productId']);
        $productBill->setProduct($product);
        $productBill->setQuantity($data['quantity']);
        $productBill->setPrice($data['price']);
        $productBill->setTva($data['tva']);
        $productBill->setDiscount($data['discount']);

        return $productBill;
    }

    public function getDefaultProduct(?int $id = null): Product
    {
        if ($id) {
            return $this->productRepository->find($id);
        }
        return $this->productRepository->getFirstProduct();
    }

    public function getDefaultQuantity(): int
    {
        return 1;
    }

    public function getDefaultPrice(): float
    {
        return 0.0;
    }

    public function getDefaultTotal(): float
    {
        return 0.0;
    }

    public function getDefaultTva(): float
    {
        return Product::DEFAULT_TAX_RATE;
    }

    public function getDefaultDiscount(): float
    {
        return 0.0;
    }

    public static function getTotalTTC(float $price, int $quantity, float $tva): float
    {
        $totalHT = $price * $quantity;
        $totalTTC = $totalHT * ($tva / 100);

        return $totalHT + $totalTTC;
    }

}
