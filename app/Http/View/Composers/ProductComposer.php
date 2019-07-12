<?php

namespace App\Http\View\Composers;

use App\Product;
use App\Product\Price\PriceCalculator;
use App\Repository\ProductRepositoryInterface;
use App\Utils\Url\UrlGeneratorInterface;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ProductComposer
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
    public function compose(View $view): void
    {
        $view->with('products', $this->getModifiedProducts());
    }

    /**
     * Modifies the given products by adding calculated price to them and generating
     * public image url
     *
     * @return Collection
     */
    protected function getModifiedProducts(): Collection
    {
        $products = $this->product_repository->all();

        $this->addCalculatedPriceToAllProducts($products);
        $this->createImageUrlForAllProducts($products);

        return $products;
    }

    /**
     * Creates image urls for the specified products
     *
     * @param Collection $products
     */
    protected function createImageUrlForAllProducts(Collection $products): void
    {
        foreach ($products as $product)
        {
            $this->createImageUrlForProduct($product);
        }
    }

    /**
     * Creates image url for a product
     *
     * @param Product $product
     */
    private function createImageUrlForProduct(Product $product): void
    {
        $product->image = $this->url_generator->generatePublicUrl($product->image);
    }

    /**
     * Calculates price for each product and adds it to the model
     *
     * @param Collection $products
     */
    protected function addCalculatedPriceToAllProducts(Collection $products): void
    {
        foreach ($products as $product)
        {
            $this->addCalculatedPriceToProduct($product);
        }
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