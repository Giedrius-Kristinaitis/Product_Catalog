<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'ProductController@viewAll')->name('products');

Route::middleware(['auth', 'verify.admin'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/product/create', 'ProductController@create')->name('product.create');

    Route::middleware(['ensure.product.status', 'verify.image'])->group(function () {
        Route::post('/product', 'ProductController@store')->name('product.store');

        Route::put('/product', 'ProductController@update')->name('product.update');
    });

    Route::delete('/product/multiple', 'ProductController@deleteMultiple');

    Route::delete('/product/{id}', 'ProductController@delete')->name('product.delete');

    Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
});

Route::get('/product/{id}', 'ProductController@viewSingle')->name('product');

Route::post('/review', 'ReviewController@store');

Route::get('/product/rating/{id}', 'ProductController@getProductRating');