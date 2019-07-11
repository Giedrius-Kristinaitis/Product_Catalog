<?php

namespace App\Forms\Product;

use Kris\LaravelFormBuilder\Form;

class CreateForm extends Form
{

    /**
     * Creates the form
     *
     * @return mixed|void
     */
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required',
                'error_messages' => [
                    'name.required' => 'The name field is required!'
                ]
            ])
            ->add('description', 'textarea', [
                'rules' => 'required',
                'error_messages' => [
                    'description.required' => 'The description field is required!'
                ]
            ])
            ->add('picture', 'file', [
                'rules' => 'required',
                'error_messages' => [
                    'picture.required' => 'You must upload an image that shows the product!'
                ]
            ])
            ->add('enabled', 'checkbox', [
                'checked' => 'checked'
            ])
            ->add('sku', 'number', [
                'min' => 0,
                'step' => '1',
                'rules' => 'required|min:0',
                'error_messages' => [
                    'sku.required' => 'The SKU field is required!'
                ]
            ])
            ->add('basePrice', 'number', [
                'min' => 0,
                'step' => 'any',
                'rules' => 'required|min:0',
                'error_messages' => [
                    'basePrice.required' => 'The base price field is required!'
                ]
            ])
            ->add('specialPrice', 'number', [
                'min' => 0,
                'step' => 'any',
                'placeholder' => 'Leave empty if the product has no special price'
            ])
            ->add('submit', 'submit', [
                'value' => 'Create'
            ]);
    }
}
