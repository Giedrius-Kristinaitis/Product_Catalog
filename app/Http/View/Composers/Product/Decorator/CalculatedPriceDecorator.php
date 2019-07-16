<?php

namespace App\Http\View\Composers\Product\Decorator;

use App\Product;
use App\Product\Price\PriceCalculator;

class CalculatedPriceDecorator extends ProductComposerDecorator
{
    /**
     * @var PriceCalculator
     */
    private $price_calculator;

    /**
     * CalculatedPriceDecorator constructor.
     * @param ProductComposerInterface $product_composer
     * @param PriceCalculator $price_calculator
     */
    public function __construct(ProductComposerInterface $product_composer, PriceCalculator $price_calculator)
    {
        parent::__construct($product_composer);

        $this->price_calculator = $price_calculator;
    }

    /**
     * Composes a product by adding additional calculated price to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void
    {
        parent::compose($product);

        $this->addCalculatedPriceToProduct($product);
    }

    /**
     * Calculates price for a single product and adds it to it's model
     *
     * @param Product $product
     */
    private function addCalculatedPriceToProduct(Product $product): void
    {
        $product->calculated_price = $this->price_calculator->calculateProductPrice($product);
    }
}