<?php

namespace App\Http\View\Composers;

use App\Product;
use App\Product\Price\PriceCalculator;
use App\Repository\ProductRepositoryInterface;
use App\Utils\Url\UrlGeneratorInterface;
use Illuminate\Support\Collection;

class CardProductComposer extends ProductComposer
{
    /**
     * CardProductComposer constructor.
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
        $this->addNonDiscountCalculatedPriceToAllProducts($modified_products);

        return $modified_products;
    }

    /**
     * Adds calculated price to products without including discount
     * @param Collection $products
     */
    private function addNonDiscountCalculatedPriceToAllProducts(Collection $products): void
    {
        foreach ($products as $product)
        {
            $this->addNonDiscountCalculatedPriceToProduct($product);
        }
    }

    /**
     * Adds calculated price to a single product without including discount
     * @param Product $product
     */
    private function addNonDiscountCalculatedPriceToProduct(Product $product): void
    {
        $calculated_price_no_discount = $this->price_calculator->calculateProductPriceWithoutDiscount($product);

        if ($calculated_price_no_discount > $product->calculated_price)
        {
            $product->calculated_price_no_discount = $calculated_price_no_discount;
            $product->display_no_discount_price = true;
        }
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