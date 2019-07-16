<?php

namespace Tests\Unit\Product\Price;

use App\Product;
use App\Product\Price\DiscountProvider;
use App\Product\Price\StrategyProductPriceCalculator;
use App\Settings\AppSettingProvider;
use Mockery;
use Tests\TestCase;

class StrategyProductPriceCalculatorTest extends TestCase
{
    /**
     * @dataProvider mockProvider
     */
    public function testCalculatePriceShouldReturnPrice(Product $mock_product, DiscountProvider $mock_discount_provider, AppSettingProvider $mock_settings): void
    {
        $calculator = new StrategyProductPriceCalculator($mock_settings, $mock_discount_provider);

        $calculated_price = $calculator->calculateProductPrice($mock_product);

        $this->assertEquals(5, $calculated_price);
    }

    /**
     * @dataProvider mockProvider
     */
    public function testCalculatePriceWithoutDiscountShouldReturnPrice(Product $mock_product, DiscountProvider $mock_discount_provider, AppSettingProvider $mock_settings): void
    {
        $calculator = new StrategyProductPriceCalculator($mock_settings, $mock_discount_provider);

        $calculated_price = $calculator->calculateProductPriceWithoutDiscount($mock_product);

        $this->assertEquals(10, $calculated_price);
    }

    public static function mockProvider(): array
    {
        $product = Mockery::mock(Product::class);
        $product->shouldReceive('getAttribute')
                ->with('base_price')
                ->andReturn(10);

        $provider = Mockery::mock(DiscountProvider::class);
        $provider->shouldReceive('getAppliedDiscount')
            ->andReturn(5);

        $settings = Mockery::mock(AppSettingProvider::class);
        $settings->shouldReceive('getSetting')
                 ->with('include_tax')
                 ->andReturn(false);

        return array(
            array($product, $provider, $settings)
        );
    }
}
