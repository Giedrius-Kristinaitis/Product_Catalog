<?php

return [

    // All the sections for the settings page
    'sections' => [
        'app' => [
            'title' => 'General Settings',
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'tax_rate', // unique key for setting
                    'type' => 'text',
                    'label' => 'Tax rate (%)', // label for input
                    // optional properties
                    'min' => 0,
                    'max' => 100,
                    'placeholder' => 'Tax rate (%)', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:0|max:100', // validation rules for this input
                    'value' => '21', // any default value
                    'hint' => 'You can set the product tax rate here' // help block text for input
                ],

                [
                    'name' => 'include_tax', // unique key for setting
                    'type' => 'checkbox',
                    'label' => 'Include tax into displayed prices', // label for input
                    // optional properties
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'value' => '1', // any default value
                ],

                [
                    'name' => 'global_discount', // unique key for setting
                    'type' => 'text',
                    'label' => 'Global discount for all products', // label for input
                    // optional properties
                    'min' => 0,
                    'placeholder' => 'Global discount for all products', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:0', // validation rules for this input
                    'value' => '0', // any default value
                    'hint' => 'You can set the global product discount here' // help block text for input
                ],

                [
                    'name' => 'global_discount_expressed_percent', // unique key for setting
                    'type' => 'checkbox', 
                    'label' => 'Global discount expressed in percent', // label for input
                    // optional properties
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'value' => '0', // any default value
                    'hint' => 'If unchecked, then the global discount value is a currency value'
                ]
            ]
        ]
    ],

    // Setting page url, will be used for get and post request
    'url' => 'settings',

    // Any middleware you want to run on above route
    'middleware' => ['auth'],

    // View settings
    'setting_page_view' => 'app_settings::settings_page',
    'flash_partial' => 'app_settings::_flash',

    // Setting section class setting
    'section_class' => 'card mb-3',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Save Settings',
    'submit_success_message' => 'Settings have been saved.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting
    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',
];
