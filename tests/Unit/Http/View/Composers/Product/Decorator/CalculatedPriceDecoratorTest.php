<?php

namespace Tests\Unit\Http\View\Composers\Product\Decorator;

use App\Http\View\Composers\Product\Decorator\CalculatedPriceDecorator;
use App\Http\View\Composers\Product\Decorator\ProductComposer;
use App\Product;
use App\Product\Price\StrategyProductPriceCalculator;
use Tests\TestCase;

class CalculatedPriceDecoratorTest extends TestCase
{
    public function testComposeShouldAddCalculatedPriceToProduct()
    {
        $mock_calculator = $this->mock(StrategyProductPriceCalculator::class, function ($mock) {
            $mock->shouldReceive('calculateProductPrice')->andReturn(10);
        });

        $product = new Product();

        $decorator = new CalculatedPriceDecorator(new ProductComposer(), $mock_calculator);

        $decorator->compose($product);

        $this->assertEquals(10, $product->calculated_price);
    }
}
