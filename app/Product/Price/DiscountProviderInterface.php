<?php

namespace App\Product\Price;

use App\Product;

interface DiscountProviderInterface
{
    /**
     * Gets the discount that is applied to the specified product
     *
     * @param Product $product
     * @return float
     */
    public function getAppliedDiscount(Product $product): float;
}