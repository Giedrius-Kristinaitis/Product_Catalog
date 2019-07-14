<?php

namespace App\Http\View\Composers\Product;

use App\Product;
use App\Utils\Url\UrlGeneratorInterface;

class ImageUrlDecorator extends ProductComposerDecorator
{
    /**
     * @var UrlGeneratorInterface
     */
    private $url_generator;

    /**
     * ImageUrlDecorator constructor.
     * @param ProductComposerInterface $product_composer
     * @param UrlGeneratorInterface $url_generator
     */
    public function __construct(ProductComposerInterface $product_composer, UrlGeneratorInterface $url_generator)
    {
        parent::__construct($product_composer);

        $this->url_generator = $url_generator;
    }

    /**
     * Composes a product by adding public image url to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void
    {
        parent::compose($product);

        $this->addImageUrlForProduct($product);
    }

    /**
     * Adds image url to a product
     *
     * @param Product $product
     */
    private function addImageUrlForProduct(Product $product): void
    {
        $product->image = $this->url_generator->generatePublicUrl($product->image);
    }
}