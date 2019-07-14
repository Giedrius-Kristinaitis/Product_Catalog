<?php

namespace App\Product\Price;

use App\Product;
use App\Settings\SettingProvider;

class StrategyProductPriceCalculator implements PriceCalculator
{
    /**
     * @var SettingProvider App's settings
     */
    private $settings;

    /**
     * @var DiscountProviderInterface Provides discount values for products
     */
    private $discount_provider;

    /**
     * StrategyProductPriceCalculator constructor.
     * @param SettingProvider $settings
     * @param DiscountProviderInterface $discount_provider
     */
    public function __construct(SettingProvider $settings, DiscountProviderInterface $discount_provider)
    {
        $this->settings = $settings;
        $this->discount_provider = $discount_provider;
    }

    /**
     * Calculates product's price without it's discount
     *
     * @param Product $product
     * @return float
     */
    public function calculateProductPriceWithoutDiscount(Product $product): float
    {
        $calculation_strategy = $this->getPriceCalculationStrategy(0);

        return $calculation_strategy->calculatePrice($product->base_price);
    }

    /**
     * Calculates product's price
     *
     * @param Product $product
     * @return float
     */
    public function calculateProductPrice(Product $product): float
    {
        $calculation_strategy = $this->getPriceCalculationStrategy($this->discount_provider->getAppliedDiscount($product));

        return $calculation_strategy->calculatePrice($product->base_price);
    }

    /**
     * Gets the correct price calculation strategy based on app's settings
     *
     * @param float $discount
     * @return PriceCalculationStrategy
     */
    private function getPriceCalculationStrategy(float $discount): PriceCalculationStrategy
    {
        if ($this->settings->getSetting('include_tax'))
        {
            return new TaxedDiscountPriceCalculationStrategy($discount, $this->settings->getSetting('tax_rate'));
        }
        else
        {
            return new DiscountPriceCalculationStrategy($discount);
        }
    }
}