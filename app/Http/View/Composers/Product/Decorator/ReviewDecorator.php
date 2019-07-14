<?php

namespace App\Http\View\Composers\Product\Decorator;

use App\Product;
use App\Repository\ReviewRepositoryInterface;

class ReviewDecorator extends ProductComposerDecorator
{
    /**
     * @var ReviewRepositoryInterface
     */
    private $review_repo;

    /**
     * ReviewDecorator constructor.
     * @param ProductComposerInterface $product_composer
     * @param ReviewRepositoryInterface $review_repo
     */
    public function __construct(ProductComposerInterface $product_composer, ReviewRepositoryInterface $review_repo)
    {
        parent::__construct($product_composer);

        $this->review_repo = $review_repo;
    }

    /**
     * Composes the product by adding reviews to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void
    {
        parent::compose($product);

        $this->addReviewsToProduct($product);
    }

    /**
     * Adds reviews to the given product
     *
     * @param Product $product
     */
    private function addReviewsToProduct(Product $product): void
    {
        $product->product_reviews = $this->review_repo->getAllByProductId($product->id);
    }
}