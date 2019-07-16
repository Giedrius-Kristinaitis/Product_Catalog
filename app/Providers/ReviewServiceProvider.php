<?php

namespace App\Providers;

use App\Repository\ReviewRepository;
use App\Repository\ReviewRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ReviewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ReviewRepositoryInterface::class,
            ReviewRepository::class
        );
    }
}
