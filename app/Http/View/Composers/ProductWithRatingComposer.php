<?php

namespace App\Http\View\Composers;

use App\Product;
use App\Product\Price\PriceCalculator;
use App\Repository\ProductRepositoryInterface;
use Illuminate\View\View;

class ProductWithRatingComposer extends ProductComposer
{
    /**
     * ProductWithRatingComposer constructor.
     *
     * @param PriceCalculator $price_calculator
     * @param ProductRepositoryInterface $product_repository
     */
    public function __construct(PriceCalculator $price_calculator, ProductRepositoryInterface $product_repository)
    {
        parent::__construct($price_calculator, $product_repository);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        parent::compose($view);

        $products = $view->gatherData();

        $this->addRatingToAllProducts($products);

        $view->with('products', $products);
    }

    /**
     * Adds rating value to all products
     *
     * @param array $products
     */
    private function addRatingToAllProducts(array $products): void
    {
        foreach ($products as $product)
        {
            $this->addRatingToProduct($product);
        }
    }

    /**
     * Adds rating value to a single product
     *
     * @param Product $product
     */
    private function addRatingToProduct(Product $product): void
    {
        $product->rating = $this->product_repository->getRating($product->id);
    }
}