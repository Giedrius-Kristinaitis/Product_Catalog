<?php

namespace Tests\Unit\Product\Price;

use App\Product\Price\DiscountPriceCalculationStrategy;
use Tests\TestCase;

class DiscountPriceCalculationStrategyTest extends TestCase
{
    /**
     * @dataProvider calculationStrategyProvider
     */
    public function testCalculatePriceShouldApplyDiscount(DiscountPriceCalculationStrategy $calculation_strategy): void
    {
        $calculated_price = $calculation_strategy->calculatePrice(15);
        $this->assertEquals(5, $calculated_price);
    }

    /**
     * @dataProvider calculationStrategyProvider
     */
    public function testCalculatePriceShouldNotReturnNegativePrice(DiscountPriceCalculationStrategy $calculation_strategy): void
    {
        $calculated_price = $calculation_strategy->calculatePrice(5);
        $this->assertEquals(0, $calculated_price);
    }

    public static function calculationStrategyProvider(): array
    {
        return array(
            array(new DiscountPriceCalculationStrategy(10))
        );
    }
}
