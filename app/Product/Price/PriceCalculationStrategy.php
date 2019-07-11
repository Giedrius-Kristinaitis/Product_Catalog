<?php

namespace App\Product\Price;

interface PriceCalculationStrategy
{
    /**
     * Calculates product's price based on it's base price
     *
     * @param float $base_price
     * @return float
     */
    public function calculatePrice(float $base_price): float;
}