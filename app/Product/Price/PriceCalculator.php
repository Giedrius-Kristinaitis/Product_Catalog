<?php

namespace App\Product\Price;

use App\Product;

interface PriceCalculator
{
    /**
     * Calculates product's price
     *
     * @param Product $product
     * @return float
     */
    public function calculateProductPrice(Product $product): float;
}