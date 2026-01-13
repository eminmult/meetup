<?php

return [
    'resource' => [
        'label' => 'Page',
        'plural_label' => 'Pages',
        'navigation_label' => 'Pages',
        'navigation_group' => 'Content',
    ],

    'sections' => [
        'content' => 'Content by language',
        'gallery' => 'Gallery',
        'settings' => 'Settings',
    ],

    'fields' => [
        'title' => 'Title',
        'slug' => 'Slug (URL)',
        'slug_helper' => 'Page URL, e.g.: about, contacts',
        'content' => 'Content',
        'template' => 'Template',
        'template_helper' => 'Select page display template',
        'is_published' => 'Published',
        'is_published_helper' => 'Page will be visible on the site',
        'show_in_menu' => 'Show in menu',
        'show_in_menu_helper' => 'Page will appear in site menu',
        'sort_order' => 'Sort order',
        'sort_order_helper' => 'Lower number = higher in list',
        'gallery' => 'Images',
        'gallery_helper' => 'Page gallery photos',
    ],

    'templates' => [
        'default' => 'Default',
        'home' => 'Home Page',
        'contact' => 'Contact',
        'about' => 'About',
        'team-page' => 'Team Page',
        'team-detail' => 'Team Detail',
        'services-page' => 'Services Page',
        'service-detail' => 'Service Detail',
        'portfolio-page' => 'Portfolio Page',
        'portfolio-detail' => 'Portfolio Detail',
        'blog-page' => 'Blog Page',
        'blog-detail' => 'Article Detail',
        'events-page' => 'Events Page',
        'event-detail' => 'Event Detail',
        'full-width' => 'Full width',
    ],

    'table' => [
        'columns' => [
            'title' => 'Title',
            'slug' => 'URL',
            'template' => 'Template',
            'is_published' => 'Published',
            'show_in_menu' => 'In menu',
            'updated_at' => 'Updated',
        ],
        'actions' => [
            'edit' => 'Edit',
            'delete' => 'Delete',
            'delete_confirm' => 'Delete page',
            'delete_description' => 'Are you sure you want to delete this page?',
            'deleted_notification_title' => 'Page deleted',
        ],
    ],
];
