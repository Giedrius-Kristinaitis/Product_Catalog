<?php

namespace App\Http\View\Composers\Product;

use App\Product;
use App\Product\Price\DiscountProviderInterface;

class AppliedDiscountDecorator extends ProductComposerDecorator
{
    /**
     * @var DiscountProviderInterface
     */
    private $discount_provider;

    /**
     * AppliedDiscountDecorator constructor.
     * @param ProductComposerInterface $product_composer
     * @param DiscountProviderInterface $discount_provider
     */
    public function __construct(ProductComposerInterface $product_composer, DiscountProviderInterface $discount_provider)
    {
        parent::__construct($product_composer);

        $this->discount_provider = $discount_provider;
    }

    /**
     * Composes a product by adding applied discount value to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void
    {
        parent::compose($product);

        $this->addAppliedDiscountToProduct($product);
    }

    /**
     * Adds applied discount field to a product
     *
     * @param Product $product
     */
    private function addAppliedDiscountToProduct(Product $product): void
    {
        $product->applied_discount = $this->discount_provider->getAppliedDiscount($product);
    }
}