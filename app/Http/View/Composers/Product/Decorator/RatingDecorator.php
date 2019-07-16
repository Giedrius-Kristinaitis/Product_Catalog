<?php

namespace App\Http\View\Composers\Product\Decorator;

use App\Product;
use App\Repository\ProductRepositoryInterface;

class RatingDecorator extends ProductComposerDecorator
{
    /**
     * @var ProductRepositoryInterface
     */
    private $product_repository;

    /**
     * RatingDecorator constructor.
     * @param ProductComposerInterface $product_composer
     * @param ProductRepositoryInterface $product_repository
     */
    public function __construct(ProductComposerInterface $product_composer, ProductRepositoryInterface $product_repository)
    {
        parent::__construct($product_composer);

        $this->product_repository = $product_repository;
    }

    /**
     * Composes a product by adding rating to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void
    {
        parent::compose($product);

        $this->addRatingToProduct($product);
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