<?php

namespace App\Providers;

use App\Utils\Url\UrlGenerator;
use App\Utils\Url\UrlGeneratorInterface;
use Illuminate\Support\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UrlGeneratorInterface::class,
            UrlGenerator::class
        );
    }
}
