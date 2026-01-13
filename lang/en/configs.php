<?php

return [
    'resource' => [
        'label' => 'Setting',
        'plural_label' => 'Settings',
        'navigation_label' => 'Settings',
        'navigation_group' => 'System',
    ],

    'fields' => [
        'key' => 'Key',
        'label' => 'Label',
        'value' => 'Value',
        'type' => 'Type',
        'description' => 'Description',
    ],

    'types' => [
        'text' => 'Text',
        'url' => 'URL',
        'email' => 'Email',
        'phone' => 'Phone',
        'textarea' => 'Multiline text',
        'ad' => 'Advertisement',
    ],

    'table' => [
        'columns' => [
            'key' => 'Key',
            'label' => 'Label',
            'value' => 'Value',
            'type' => 'Type',
            'updated_at' => 'Updated',
        ],
    ],
];
