<?php

namespace Tests\Unit\Http\View\Composers\Product\Decorator;

use App\Http\View\Composers\Product\Decorator\CalculatedPriceWithoutDiscountDecorator;
use App\Http\View\Composers\Product\Decorator\ProductComposer;
use App\Product;
use App\Product\Price\StrategyProductPriceCalculator;
use Tests\TestCase;

class CalculatedPriceWithoutDiscountDecoratorTest extends TestCase
{
    public function testComposeShouldAddCalculatedPriceWithoutDiscountToProduct()
    {
        $mock_calculator = $this->mock(StrategyProductPriceCalculator::class, function ($mock) {
            $mock->shouldReceive('calculateProductPriceWithoutDiscount')->andReturn(10);
        });

        $product = new Product();

        $decorator = new CalculatedPriceWithoutDiscountDecorator(new ProductComposer(), $mock_calculator);

        $decorator->compose($product);

        $this->assertEquals(10, $product->calculated_price_no_discount);
    }
}
