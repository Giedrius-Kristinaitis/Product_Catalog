<?php

namespace App\Http\View\Composers\Product\Decorator;

use App\Product;

abstract class ProductComposerDecorator implements ProductComposerInterface
{
    /**
     * @var ProductComposerInterface
     */
    private $product_composer;

    /**
     * ProductComposerDecorator constructor.
     * @param ProductComposerInterface $product_composer
     */
    public function __construct(ProductComposerInterface $product_composer)
    {
        $this->product_composer = $product_composer;
    }

    /**
     * Composes a product by adding additional data to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void
    {
        $this->product_composer->compose($product);
    }
}