<?php

namespace Tests\Unit\Http\View\Composers\Product\Decorator;

use App\Http\View\Composers\Product\Decorator\ImageUrlDecorator;
use App\Http\View\Composers\Product\Decorator\ProductComposer;
use App\Product;
use App\Utils\Url\UrlGenerator;
use Tests\TestCase;

class ImageUrlDecoratorTest extends TestCase
{
    public function testComposeShouldAddImageUrlToProduct()
    {
        $mock_url_generator = $this->mock(UrlGenerator::class, function ($mock) {
            $mock->shouldReceive('generatePublicUrl')->andReturn('some valid url');
        });

        $product = new Product();

        $decorator = new ImageUrlDecorator(new ProductComposer(), $mock_url_generator);

        $decorator->compose($product);

        $this->assertEquals('some valid url', $product->image);
    }
}
