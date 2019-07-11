<?php

namespace App\Product\Price;

class DiscountPriceCalculationStrategy implements PriceCalculationStrategy
{
    /**
     * @var float Applied discount
     */
    public $discount;

    /**
     * DiscountPriceCalculationStrategy constructor.
     * @param float $discount Applied discount
     */
    public function __construct(float $discount)
    {
        $this->discount = $discount;
    }

    /**
     * Calculates product's price based on it's base price and applied discount
     *
     * @param float $base_price
     * @return float
     */
    public function calculatePrice(float $base_price): float
    {
        return max(0, $base_price - $this->discount);
    }
}