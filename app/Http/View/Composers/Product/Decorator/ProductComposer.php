<?php

namespace App\Http\View\Composers\Product;

use App\Product;

class ProductComposer implements ProductComposerInterface
{
    /**
     * Composes a product by adding additional data to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void
    {
        // non-decorated product composer does nothing now,
        // but some logic might be implemented later
    }
}