<?php

namespace App\Providers;

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
            return new StrategyProductPriceCalculator(new AppSettingProvider());
        });

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }
}
