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
        View::composer('dashboard', 'App\Http\View\Composers\TableRowProductComposer');
        View::composer('products', 'App\Http\View\Composers\CardProductComposer');
        View::composer('product.product', 'App\Http\View\Composers\DetailedProductComposer');
    }
}
