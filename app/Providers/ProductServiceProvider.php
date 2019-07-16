<?php

namespace App\Providers;

use App\Product\Price\DiscountProvider;
use App\Product\Price\DiscountProviderInterface;
use App\Product\Price\PriceCalculator;
use App\Product\Price\StrategyProductPriceCalculator;
use App\Repository\ProductRepository;
use App\Repository\ProductRepositoryInterface;
use App\Settings\AppSettingProvider;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PriceCalculator::class, function()
        {
            $setting_provider = new AppSettingProvider();
            return new StrategyProductPriceCalculator($setting_provider, new DiscountProvider($setting_provider));
        });

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            DiscountProviderInterface::class,
            DiscountProvider::class
        );
    }
}
