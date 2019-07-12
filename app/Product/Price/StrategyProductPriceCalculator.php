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
     * StrategyProductPriceCalculator constructor.
     * @param SettingProvider $settings
     */
    public function __construct(SettingProvider $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Calculates product's price
     *
     * @param Product $product
     * @return float
     */
    public function calculateProductPrice(Product $product): float
    {
        $calculation_strategy = $this->getPriceCalculationStrategy($product);

        return $calculation_strategy->calculatePrice($product->base_price);
    }

    /**
     * Gets the correct price calculation strategy based on product's discount and app's settings
     *
     * @param Product $product
     * @return PriceCalculationStrategy
     */
    private function getPriceCalculationStrategy(Product $product): PriceCalculationStrategy
    {
        if ($this->settings->getSetting('include_tax'))
        {
            return new TaxedDiscountPriceCalculationStrategy(
                $this->getDiscount($product),
                $this->settings->getSetting('tax_rate'));
        }
        else
        {
            return new DiscountPriceCalculationStrategy($this->getDiscount($product));
        }
    }

    /**
     * Gets the discount that will be applied to the specified product based whether the
     * global discount is set or not
     *
     * @param Product $product
     * @return float
     */
    private function getDiscount(Product $product): float
    {
        $global_discount = $this->settings->getSetting('global_discount');

        if ($global_discount > 0)
        {
            return $this->calculateAppliedGlobalDiscount($global_discount, $product->base_price);
        }
        else
        {
            return $product->discount ?? 0;
        }
    }

    /**
     * Calculates the value of global discount that should be applied to a product based on
     * whether the global discount is expressed in percent or fixed value
     *
     * @param float $global_discount
     * @param float $product_price
     * @return float
     */
    private function calculateAppliedGlobalDiscount(float $global_discount, float $product_price): float
    {
        if ($this->settings->getSetting('global_discount_expressed_percent'))
        {
            return $product_price * $global_discount / 100;
        }
        else
        {
            return $global_discount;
        }
    }
}