<?php

namespace App\Http\Controllers;

use App\Repository\ProductRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Forms\Product\CreateForm;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use FormBuilderTrait;

    /**
     * @var ProductRepositoryInterface
     */
    private $product_repository;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $product_repository
     */
    public function __construct(ProductRepositoryInterface $product_repository)
    {
        $this->product_repository = $product_repository;
    }

    /**
     * Show the product creation page
     *
     * @param FormBuilder $form_builder
     *
     * @return Renderable
     */
    public function create(FormBuilder $form_builder): Renderable
    {
        $form = $form_builder->create('App\Forms\Product\CreateForm', [
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
        $this->redirectIfInvalidForm();

        $this->product_repository->create($request->all());

        return redirect()->route('products');
    }

    /**
     * Validates product form and if it is bad, creates a redirect
     */
    private function redirectIfInvalidForm(): void
    {
        $form = $this->form(CreateForm::class);
        $form->redirectIfNotValid();
    }
}
