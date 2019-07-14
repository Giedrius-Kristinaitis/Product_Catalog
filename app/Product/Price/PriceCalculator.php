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

    /**
     * Calculates product's price without it's discount
     *
     * @param Product $product
     * @return float
     */
    public function calculateProductPriceWithoutDiscount(Product $product): float;

    /**
     * Gets the discount that is applied to the specified product
     *
     * @param Product $product
     * @return float
     */
    public function getAppliedDiscount(Product $product): float;
}