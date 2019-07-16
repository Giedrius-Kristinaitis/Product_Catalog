<?php

namespace Tests\Unit\Product\Price;

use App\Product\Price\TaxedDiscountPriceCalculationStrategy;
use Tests\TestCase;

class TaxedDiscountPriceCalculationStrategyTest extends TestCase
{
    public function testCalculatePriceShouldApplyTaxRate(): void
    {
        $calculation_strategy = new TaxedDiscountPriceCalculationStrategy(0, 10);
        $calculated_price = $calculation_strategy->calculatePrice(10);
        $this->assertEquals(11, $calculated_price);
    }
}
