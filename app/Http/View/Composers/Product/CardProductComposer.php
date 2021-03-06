<?php

namespace App\Http\View\Composers\Product;

use App\Http\View\Composers\Product\Decorator\CalculatedPriceDecorator;
use App\Http\View\Composers\Product\Decorator\CalculatedPriceWithoutDiscountDecorator;
use App\Http\View\Composers\Product\Decorator\ImageUrlDecorator;
use App\Http\View\Composers\Product\Decorator\ProductComposer;
use App\Http\View\Composers\Product\Decorator\ProductComposerInterface;
use App\Http\View\Composers\Product\Decorator\RatingDecorator;
use App\Product\Price\PriceCalculator;
use App\Repository\ProductRepositoryInterface;
use App\Utils\Url\UrlGeneratorInterface;

/**
 * Class CardProductComposer
 *
 * Composes products to be displayed in a product card
 *
 * @package App\Http\View\Composers
 */
class CardProductComposer extends BaseProductComposer
{
    /**
     * CardProductComposer constructor.
     * @param PriceCalculator $price_calculator
     * @param ProductRepositoryInterface $product_repository
     * @param UrlGeneratorInterface $url_generator
     */
    public function __construct(PriceCalculator $price_calculator, ProductRepositoryInterface $product_repository, UrlGeneratorInterface $url_generator)
    {
        parent::__construct($price_calculator, $product_repository, $url_generator);
    }

    /**
     * Gets the composer that will be applied to composed products
     *
     * @return ProductComposerInterface
     */
    protected function getComposer(): ProductComposerInterface
    {
        return new ImageUrlDecorator(
            new CalculatedPriceDecorator(
                new CalculatedPriceWithoutDiscountDecorator(
                    new RatingDecorator(
                        new ProductComposer(),
                        $this->product_repository
                    ),
                    $this->price_calculator
                ),
                $this->price_calculator
            ),
            $this->url_generator
        );
    }
}