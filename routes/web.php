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

Route::get('/', function () {
    return view('products');
})->name('products');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/product/create', 'ProductController@create')->middleware(['auth', 'verify.admin'])->name('product.create');

Route::post('/product/store', 'ProductController@store')->middleware(['auth', 'verify.admin'])->name('product.store');
