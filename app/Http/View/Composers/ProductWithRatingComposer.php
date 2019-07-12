<?php

namespace App\Http\View\Composers;

use App\Product;
use App\Product\Price\PriceCalculator;
use App\Repository\ProductRepositoryInterface;
use App\Utils\Url\UrlGeneratorInterface;
use Illuminate\Support\Collection;

class ProductWithRatingComposer extends ProductComposer
{
    /**
     * ProductWithRatingComposer constructor.
     *
     * @param PriceCalculator $price_calculator
     * @param ProductRepositoryInterface $product_repository
     * @param UrlGeneratorInterface $url_generator
     */
    public function __construct(PriceCalculator $price_calculator, ProductRepositoryInterface $product_repository, UrlGeneratorInterface $url_generator)
    {
        parent::__construct($price_calculator, $product_repository, $url_generator);
    }

    /**
     * Modifies the given products by adding calculated price to them, generating
     * public image url and adding rating value
     *
     * @return Collection
     */
    public function getModifiedProducts(): Collection
    {
        $modified_products = parent::getModifiedProducts();

        $this->addRatingToAllProducts($modified_products);

        return $modified_products;
    }

    /**
     * Adds rating value to all products
     *
     * @param Collection $products
     */
    private function addRatingToAllProducts(Collection $products): void
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