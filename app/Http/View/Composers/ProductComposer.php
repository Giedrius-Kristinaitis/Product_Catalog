<?php

namespace App\Http\View\Composers;

use App\Product;
use App\Product\Price\PriceCalculator;
use App\Repository\ProductRepositoryInterface;
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
     * Create a new profile composer.
     *
     * @param PriceCalculator $price_calculator
     * @param ProductRepositoryInterface $product_repository
     * @return void
     */
    public function __construct(PriceCalculator $price_calculator, ProductRepositoryInterface $product_repository)
    {
        $this->price_calculator = $price_calculator;
        $this->product_repository = $product_repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        $products = $this->product_repository->all();

        $this->addCalculatedPriceToAllProducts($products);

        $view->with('products', $products);
    }

    /**
     * Calculates price for each product and adds it to the model
     *
     * @param Collection $products
     */
    private function addCalculatedPriceToAllProducts(Collection $products): void
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
        $product->calculated_price = $this->price_calculator->calculateProductPrice($product->base_price);
    }
}