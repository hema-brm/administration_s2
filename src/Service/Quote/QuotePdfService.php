<?php

namespace App\Service\Quote;

use App\Entity\Quote;

class QuotePdfService {
    public function getData(Quote $quote)
    {
        $categories = [];

        foreach ($quote->getProductQuotes() as $productQuote) {
            $product = $productQuote->getProduct();
            $category = $product->getCategory();
            $categories[$category->getId()][] = [
                'product' => $product->getName(),
                'quantity' => $productQuote->getQuantity(),
                'price' => $productQuote->getPrice(),
                'tva' => $productQuote->getTva(),
                'discount' => $productQuote->getDiscount(),
                'total' => $productQuote->getTotal(),
            ];
        }
    }
}
