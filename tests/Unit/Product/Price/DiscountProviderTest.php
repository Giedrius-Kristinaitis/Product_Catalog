<?php

namespace Tests\Unit\Product\Price;

use App\Product;
use App\Settings\AppSettingProvider;
use App\Product\Price\DiscountProvider;
use \Mockery;
use Tests\TestCase;

class DiscountProviderTest extends TestCase
{

    /**
     * @dataProvider mockIndividualDiscountProvider
     */
    public function testGetDiscountShouldReturnIndividualDiscount(AppSettingProvider $mock_settings, Product $mock_product): void
    {
        $mock_product->shouldReceive('getAttribute')->with('discount')->andReturn(5);
        $mock_product->shouldReceive('offsetExists')->andReturn(true);

        $discount_provider = new DiscountProvider($mock_settings);

        $discount = $discount_provider->getAppliedDiscount($mock_product);

        $this->assertEquals(5, $discount);
    }

    /**
     * @dataProvider mockIndividualDiscountProvider
     */
    public function testGetDiscountShouldReturnZeroBecauseNoGlobalOrIndividualDiscount(AppSettingProvider $mock_settings, Product $mock_product): void
    {
        $mock_product->shouldReceive('offsetExists')->andReturn(false);

        $discount_provider = new DiscountProvider($mock_settings);

        $discount = $discount_provider->getAppliedDiscount($mock_product);

        $this->assertEquals(0, $discount);
    }

    /**
     * @dataProvider mockGlobalDiscountProvider
     */
    public function testGetDiscountShouldReturnGlobalDiscountCalculatedFromFixedValue(AppSettingProvider $mock_settings, Product $mock_product): void
    {
        $mock_settings->shouldReceive('getSetting')->with('global_discount_expressed_percent')->andReturn(false);

        $discount_provider = new DiscountProvider($mock_settings);

        $discount = $discount_provider->getAppliedDiscount($mock_product);

        $this->assertEquals(10, $discount);
    }

    /**
     * @dataProvider mockGlobalDiscountProvider
     */
    public function testGetDiscountShouldReturnGlobalDiscountCalculatedFromPercentageValue(AppSettingProvider $mock_settings, Product $mock_product): void
    {
        $mock_settings->shouldReceive('getSetting')->with('global_discount_expressed_percent')->andReturn(true);

        $discount_provider = new DiscountProvider($mock_settings);

        $discount = $discount_provider->getAppliedDiscount($mock_product);

        $this->assertEquals(1, $discount);
    }

    public static function mockIndividualDiscountProvider(): array
    {
        $settings = Mockery::mock(AppSettingProvider::class);
        $settings->shouldReceive('getSetting')
                ->with('global_discount')
                ->andReturn(0);

        return array(
            array($settings, self::getMockProduct())
        );
    }

    public static function mockGlobalDiscountProvider(): array
    {
        $settings = Mockery::mock(AppSettingProvider::class);
        $settings->shouldReceive('getSetting')
            ->with('global_discount')
            ->andReturn(10);

        return array(
            array($settings, self::getMockProduct())
        );
    }

    private static function getMockProduct(): Product
    {
        $product = Mockery::mock(Product::class);
        $product->shouldReceive('getAttribute')
            ->with('base_price')
            ->andReturn(10);

        return $product;
    }
}
