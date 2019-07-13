<?php

namespace App\Forms\Product;

use Kris\LaravelFormBuilder\Form;

class EditForm extends Form
{

    /**
     * Creates the form
     *
     * @return mixed|void
     */
    public function buildForm()
    {
        $this
            ->add('id', 'number', [
                'attr' => [
                    'style' => 'display: none'
                ],
                'label_show' => false
            ])
            ->add('name', 'text', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Name'
                ]
            ])
            ->add('description', 'textarea', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description'
                ]
            ])
            ->add('image', 'file')
            ->add('enabled', 'checkbox', [
                'default_value' => 0
            ])
            ->add('sku', 'number', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Stock keeping unit',
                    'min' => 0,
                    'step' => '1',
                ]
            ])
            ->add('base_price', 'number', [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Base price',
                    'min' => 0,
                    'step' => 'any',
                ],
                'rules' => 'min:0'
            ])
            ->add('discount', 'number', [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                    'step' => 'any',
                    'placeholder' => 'Leave empty if the product has no discount'
                ]
            ])
            ->add('submit', 'submit');
    }
}
