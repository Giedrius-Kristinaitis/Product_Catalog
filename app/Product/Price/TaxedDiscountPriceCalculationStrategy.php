<?php

namespace App\Product\Price;

class TaxedDiscountPriceCalculationStrategy extends DiscountPriceCalculationStrategy
{
    /**
     * @var float Applied tax rate
     */
    public $tax_rate;

    /**
     * TaxedDiscountPriceCalculationStrategy constructor.
     * @param float $discount
     * @param float $tax_rate
     */
    public function __construct(float $discount, float $tax_rate)
    {
        parent::__construct($discount);

        $this->tax_rate = $tax_rate;
    }

    /**
     * Calculates product's price based on it's base price, applied discount and tax rate
     * @param float $base_price
     * @return float
     */
    public function calculatePrice(float $base_price): float
    {
        return max(0, ($base_price - $this->discount) * (1 + $this->tax_rate / 100));
    }
}