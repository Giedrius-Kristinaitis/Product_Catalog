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
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Name'
                ],
                'rules' => 'required',
                'error_messages' => [
                    'name.required' => 'The name field is required!'
                ]
            ])
            ->add('description', 'textarea', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description'
                ],
                'rules' => 'required',
                'error_messages' => [
                    'description.required' => 'The description field is required!'
                ]
            ])
            ->add('image', 'file', [
                'rules' => 'required',
                'error_messages' => [
                    'image.required' => 'You must upload an image that shows the product!'
                ]
            ])
            ->add('enabled', 'checkbox', [
                'checked' => 'checked'
            ])
            ->add('sku', 'number', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Stock keeping unit',
                    'min' => 0,
                    'step' => '1',
                ],
                'rules' => 'required|min:0',
                'error_messages' => [
                    'sku.required' => 'The SKU field is required!'
                ]
            ])
            ->add('base_price', 'number', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Base price',
                    'min' => 0,
                    'step' => 'any',
                ],
                'rules' => 'required|min:0',
                'error_messages' => [
                    'base_price.required' => 'The base price field is required!'
                ]
            ])
            ->add('special_price', 'number', [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                    'step' => 'any',
                    'placeholder' => 'Leave empty if the product has no special price'
                ]
            ])
            ->add('submit', 'submit', [
                'value' => 'Create'
            ]);
    }
}
