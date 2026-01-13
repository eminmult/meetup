<?php

return [
    'resource' => [
        'label' => 'Страница',
        'plural_label' => 'Страницы',
        'navigation_label' => 'Страницы',
        'navigation_group' => 'Контент',
    ],

    'sections' => [
        'content' => 'Контент по языкам',
        'gallery' => 'Галерея',
        'settings' => 'Настройки',
    ],

    'fields' => [
        'title' => 'Название',
        'slug' => 'Slug (URL)',
        'slug_helper' => 'URL страницы, например: about, contacts',
        'content' => 'Контент',
        'template' => 'Шаблон',
        'template_helper' => 'Выберите шаблон отображения страницы',
        'is_published' => 'Опубликована',
        'is_published_helper' => 'Страница будет видна на сайте',
        'show_in_menu' => 'Показывать в меню',
        'show_in_menu_helper' => 'Страница будет отображаться в меню сайта',
        'sort_order' => 'Порядок сортировки',
        'sort_order_helper' => 'Чем меньше число, тем выше в списке',
        'gallery' => 'Изображения',
        'gallery_helper' => 'Фото для галереи страницы',
    ],

    'templates' => [
        'default' => 'По умолчанию',
        'home' => 'Главная страница',
        'contact' => 'Контакты',
        'about' => 'О компании',
        'team-page' => 'Страница Команда',
        'team-detail' => 'Детальная Команда',
        'services-page' => 'Страница Услуги',
        'service-detail' => 'Детальная Услуга',
        'portfolio-page' => 'Страница Портфолио',
        'portfolio-detail' => 'Детальная Портфолио',
        'blog-page' => 'Страница Блог',
        'blog-detail' => 'Детальная Статья',
        'events-page' => 'Страница События',
        'event-detail' => 'Детальная Событие',
        'full-width' => 'Полная ширина',
    ],

    'table' => [
        'columns' => [
            'title' => 'Название',
            'slug' => 'URL',
            'template' => 'Шаблон',
            'is_published' => 'Опубликована',
            'show_in_menu' => 'В меню',
            'updated_at' => 'Обновлена',
        ],
        'actions' => [
            'edit' => 'Редактировать',
            'delete' => 'Удалить',
            'delete_confirm' => 'Удаление страницы',
            'delete_description' => 'Вы уверены, что хотите удалить эту страницу?',
            'deleted_notification_title' => 'Страница удалена',
        ],
    ],
];
