<?php

return [
    'resource' => [
        'label' => 'Category',
        'plural_label' => 'Categories',
        'navigation_label' => 'Categories',
        'navigation_group' => 'Content',
    ],

    'fields' => [
        'name' => 'Name',
        'slug' => 'Slug',
        'color' => 'Color',
        'description' => 'Description',
        'is_active' => 'Active',
        'show_in_menu' => 'Show in menu',
    ],

    'table' => [
        'columns' => [
            'name' => 'Name',
            'slug' => 'Slug',
            'color' => 'Color',
            'is_active' => 'Active',
            'show_in_menu' => 'In menu',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ],
        'actions' => [
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
    ],
];
