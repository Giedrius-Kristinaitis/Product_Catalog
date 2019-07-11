<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{

    /**
     * Show the product creation page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('createProduct');
    }
}
