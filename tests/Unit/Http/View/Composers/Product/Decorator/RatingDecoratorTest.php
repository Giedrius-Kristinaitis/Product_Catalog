<?php

namespace Tests\Unit\Http\View\Composers\Product\Decorator;

use App\Http\View\Composers\Product\Decorator\ProductComposer;
use App\Http\View\Composers\Product\Decorator\RatingDecorator;
use App\Product;
use App\Repository\ProductRepository;
use Tests\TestCase;

class RatingDecoratorTest extends TestCase
{
    public function testComposeShouldAddRatingToProduct()
    {
        $mock_repo = $this->mock(ProductRepository::class, function ($mock) {
            $mock->shouldReceive('getRating')->with(1)->andReturn(5);
        });

        $product = new Product();
        $product->id = 1;

        $decorator = new RatingDecorator(new ProductComposer(), $mock_repo);

        $decorator->compose($product);

        $this->assertEquals(5, $product->rating);
    }
}
