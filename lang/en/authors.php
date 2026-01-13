<?php

return [
    'resource' => [
        'label' => 'Author',
        'plural_label' => 'Authors',
        'navigation_label' => 'Authors',
        'navigation_group' => 'Content',
    ],

    'fields' => [
        'name' => 'Name',
        'slug' => 'Slug',
        'avatar' => 'Author photo',
        'avatar_helper' => 'A 150x150 WebP thumbnail will be created automatically',
        'bio' => 'Biography',
    ],

    'table' => [
        'columns' => [
            'avatar' => 'Photo',
            'name' => 'Name',
            'slug' => 'Slug',
            'posts_count' => 'Posts',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ],
        'actions' => [
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
    ],
];
