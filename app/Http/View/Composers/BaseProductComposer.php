<?php

namespace App\Http\View\Composers;

use App\Http\View\Composers\Product\ProductComposerInterface;
use App\Product\Price\PriceCalculator;
use App\Repository\ProductRepositoryInterface;
use App\Utils\Url\UrlGeneratorInterface;
use Illuminate\Support\Collection;
use Illuminate\View\View;

abstract class BaseProductComposer
{
    /**
     * @var PriceCalculator Calculates product prices
     */
    protected $price_calculator;

    /**
     * @var ProductRepositoryInterface
     */
    protected $product_repository;

    /**
     * @var UrlGeneratorInterface
     */
    protected $url_generator;

    /**
     * Create a new profile composer.
     *
     * @param PriceCalculator $price_calculator
     * @param ProductRepositoryInterface $product_repository
     * @param UrlGeneratorInterface $url_generator
     */
    public function __construct(PriceCalculator $price_calculator, ProductRepositoryInterface $product_repository, UrlGeneratorInterface $url_generator)
    {
        $this->price_calculator = $price_calculator;
        $this->product_repository = $product_repository;
        $this->url_generator = $url_generator;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public final function compose(View $view): void
    {
        $products = $this->product_repository->all();

        $this->applyComposerToProducts($this->getComposer(), $products);

        $view->with('products', $products);
    }

    /**
     * Gets the composer that will be applied to composed products
     * @return ProductComposerInterface
     */
    protected abstract function getComposer(): ProductComposerInterface;

    /**
     * Applies the given product composer to the given products
     *
     * @param ProductComposerInterface $composer
     * @param Collection $products
     */
    private function applyComposerToProducts(ProductComposerInterface $composer, Collection $products): void
    {
        foreach ($products as $product)
        {
            $composer->compose($product);
        }
    }
}