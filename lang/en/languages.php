<?php

return [
    'resource' => [
        'label' => 'Language',
        'plural_label' => 'Languages',
        'navigation_label' => 'Languages',
        'navigation_group' => 'Settings',
    ],

    'sections' => [
        'select_language' => 'Select language',
        'language_data' => 'Language data',
        'settings' => 'Settings',
    ],

    'fields' => [
        'language' => 'Language',
        'code' => 'Code',
        'name' => 'Name (English)',
        'native_name' => 'Native name',
        'flag' => 'Flag',
        'is_active' => 'Active',
        'is_default' => 'Default',
        'is_default_helper' => 'Only one language can be default',
        'sort_order' => 'Sort order',
    ],

    'table' => [
        'columns' => [
            'flag' => '',
            'code' => 'Code',
            'name' => 'Name',
            'native_name' => 'Native name',
            'is_active' => 'Active',
            'is_default' => 'Default',
            'sort_order' => 'Sort order',
        ],
    ],
];
