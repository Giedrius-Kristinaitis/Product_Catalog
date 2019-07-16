<?php

namespace Tests\Unit\Http\View\Composers\Product\Decorator;

use App\Http\View\Composers\Product\Decorator\ProductComposer;
use App\Http\View\Composers\Product\Decorator\TaxRateDecorator;
use App\Product;
use App\Settings\AppSettingProvider;
use Tests\TestCase;

class TaxRateDecoratorTest extends TestCase
{
    public function testComposeShouldAddTaxRateToProduct()
    {
        $mock_settings = $this->mock(AppSettingProvider::class, function ($mock) {
            $mock->shouldReceive('getSetting')->with('tax_rate')->once()->andReturn(10);
        });

        $decorator = new TaxRateDecorator(new ProductComposer(), $mock_settings);

        $product = new Product();

        $decorator->compose($product);

        $this->assertEquals(10, $product->tax_rate);
    }
}
