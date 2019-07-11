<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('dashboard', 'App\Http\View\Composers\ProductComposer');
        View::composer('products', 'App\Http\View\Composers\ProductWithRatingComposer');
    }
}
