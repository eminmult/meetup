<?php

return [
    'resource' => [
        'label' => 'Səhifə',
        'plural_label' => 'Səhifələr',
        'navigation_label' => 'Səhifələr',
        'navigation_group' => 'Kontent',
    ],

    'sections' => [
        'content' => 'Dillərə görə kontent',
        'gallery' => 'Qalereya',
        'settings' => 'Parametrlər',
    ],

    'fields' => [
        'title' => 'Ad',
        'slug' => 'Slug (URL)',
        'slug_helper' => 'Səhifənin URL-i, məsələn: about, contacts',
        'content' => 'Kontent',
        'template' => 'Şablon',
        'template_helper' => 'Səhifənin görüntülənmə şablonunu seçin',
        'is_published' => 'Dərc edilib',
        'is_published_helper' => 'Səhifə saytda görünəcək',
        'show_in_menu' => 'Menyuda göstər',
        'show_in_menu_helper' => 'Səhifə sayt menyusunda görünəcək',
        'sort_order' => 'Sıralama',
        'sort_order_helper' => 'Rəqəm nə qədər kiçikdirsə, siyahıda bir o qədər yuxarıdır',
        'gallery' => 'Şəkillər',
        'gallery_helper' => 'Səhifə qalereyası üçün fotolar',
    ],

    'templates' => [
        'default' => 'Defolt',
        'home' => 'Əsas Səhifə',
        'contact' => 'Əlaqə',
        'about' => 'Haqqımızda',
        'team-page' => 'Komanda Səhifəsi',
        'team-detail' => 'Komanda Ətraflı',
        'services-page' => 'Xidmətlər Səhifəsi',
        'service-detail' => 'Xidmət Ətraflı',
        'portfolio-page' => 'Portfel Səhifəsi',
        'portfolio-detail' => 'Portfel Ətraflı',
        'blog-page' => 'Bloq Səhifəsi',
        'blog-detail' => 'Məqalə Ətraflı',
        'events-page' => 'Hadisələr Səhifəsi',
        'event-detail' => 'Hadisə Ətraflı',
        'full-width' => 'Tam genişlik',
    ],

    'table' => [
        'columns' => [
            'title' => 'Ad',
            'slug' => 'URL',
            'template' => 'Şablon',
            'is_published' => 'Dərc edilib',
            'show_in_menu' => 'Menyuda',
            'updated_at' => 'Yenilənib',
        ],
        'actions' => [
            'edit' => 'Redaktə et',
            'delete' => 'Sil',
            'delete_confirm' => 'Səhifənin silinməsi',
            'delete_description' => 'Bu səhifəni silmək istədiyinizə əminsiniz?',
            'deleted_notification_title' => 'Səhifə silindi',
        ],
    ],
];
