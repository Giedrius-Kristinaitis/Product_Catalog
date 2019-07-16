<?php

namespace Tests\Unit\Http\View\Composers\Product\Decorator;

use App\Http\View\Composers\Product\Decorator\AppliedDiscountDecorator;
use App\Http\View\Composers\Product\Decorator\ProductComposer;
use App\Product;
use App\Product\Price\DiscountProvider;
use Tests\TestCase;

class AppliedDiscountDecoratorTest extends TestCase
{
    public function testComposeShouldAddAppliedDiscount()
    {
        $mock_discount_provider = $this->mock(DiscountProvider::class, function ($mock) {
            $mock->shouldReceive('getAppliedDiscount')->andReturn(10);
        });

        $product = new Product();

        $decorator = new AppliedDiscountDecorator(new ProductComposer(), $mock_discount_provider);

        $decorator->compose($product);

        $this->assertEquals(10, $product->applied_discount);
    }
}
