<?php

namespace App\Http\View\Composers\Product;

use App\Product;

interface ProductComposerInterface
{
    /**
     * Composes a product by adding additional data to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void;
}