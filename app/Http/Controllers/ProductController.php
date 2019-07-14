<?php

namespace App\Http\Controllers;

use App\Forms\Product\EditForm;
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

        return view('product.modify', compact('form'));
    }

    /**
     * Gets product's editing view
     *
     * @param int $id
     * @param FormBuilder $form_builder
     * @return Renderable
     */
    public function edit($id, FormBuilder $form_builder): Renderable
    {
        $existing_product = $this->product_repository->getById($id);

        $form = $form_builder->create('App\Forms\Product\EditForm', [
            'method' => 'PUT',
            'url' => route('product.update'),
            'model' => $existing_product
        ]);

        return view('product.modify', compact('form'));
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

        $this->product_repository->create($request->all());

        return redirect()->route('dashboard')->with('success', 'Successfully created');
    }

    /**
     * Stores a product in the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $form = $this->form(EditForm::class);

        $form->redirectIfNotValid();

        $request_data = $request->all();

        $this->product_repository->update($request_data['id'], $request_data);

        return redirect()->route('dashboard')->with('success', 'Successfully updated');
    }

    /**
     * Shows all products in a grid
     *
     * @return Renderable
     */
    public function viewAll(): Renderable
    {
        return view('products');
    }

    /**
     * Deletes a single product
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->product_repository->delete($id);

        return redirect()->route('dashboard')->with('success', 'Successfully deleted');
    }

    /**
     * Deletes multiple products at once
     *
     * @param Request $request
     */
    public function deleteMultiple(Request $request): void
    {
        $this->product_repository->deleteMultiple($this->getProductIds($request));
    }

    /**
     * Shows page with single product's information
     *
     * @return Renderable
     */
    public function viewSingle(): Renderable
    {
        // don't need to do anything with product id here because
        // view composer will take care of it
        return view('product.product');
    }

    /**
     * Gets product ids from the given request's body
     *
     * @param Request $request
     * @return array
     */
    private function getProductIds(Request $request): array
    {
        return $request->json()->all();
    }
}
