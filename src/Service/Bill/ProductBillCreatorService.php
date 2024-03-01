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
        $product = $this->getDefaultProduct();
        $quantity = $this->getDefaultQuantity();
        $price = $product->getPrice();

        return [
            'productId' => $product->getId(),
            'quantity' => $quantity,
            'price' => $price,
            'total' => $quantity * $price,
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

        return $productBill;
    }

    public function getDefaultProduct(): Product
    {
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

}
