<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Product;
use App\Forms\Product\CreateForm;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use FormBuilderTrait;

    /**
     * Show the product creation page
     *
     * @param Kris\LaravelFormBuilder\FormBuilder $formBuilder
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(FormBuilder $formBuilder): Renderable
    {
        $form = $formBuilder->create('App\Forms\Product\CreateForm', [
            'method' => 'POST',
            'url' => route('product.store')
        ]);

        return view('product.create', compact('form'));
    }

    /**
     * Stores a product in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $form = $this->form(CreateForm::class);
        $form->redirectIfNotValid();

        Product::create($form->getFieldValues());

        return redirect()->route('products');
    }
}
