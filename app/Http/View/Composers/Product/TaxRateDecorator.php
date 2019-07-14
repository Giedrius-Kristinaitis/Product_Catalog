<?php

namespace App\Http\View\Composers\Product;

use App\Product;
use App\Settings\SettingProvider;

class TaxRateDecorator extends ProductComposerDecorator
{
    /**
     * @var SettingProvider
     */
    private $settings;

    /**
     * TaxRateDecorator constructor.
     * @param ProductComposerInterface $product_composer
     * @param SettingProvider $settings
     */
    public function __construct(ProductComposerInterface $product_composer, SettingProvider $settings)
    {
        parent::__construct($product_composer);

        $this->settings = $settings;
    }

    /**
     * Composes a product by adding tax rate to it
     *
     * @param Product $product
     */
    public function compose(Product $product): void
    {
        parent::compose($product);

        $this->addTaxRateToProduct($product);
    }

    /**
     * Adds tax rate value to a product
     *
     * @param Product $product
     */
    private function addTaxRateToProduct(Product $product): void
    {
        $product->tax_rate = $this->settings->getSetting('tax_rate');
    }
}