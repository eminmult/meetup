<?php

return [
    'resource' => [
        'label' => 'Язык',
        'plural_label' => 'Языки',
        'navigation_label' => 'Языки',
        'navigation_group' => 'Настройки',
    ],

    'sections' => [
        'select_language' => 'Выберите язык',
        'language_data' => 'Данные языка',
        'settings' => 'Настройки',
    ],

    'fields' => [
        'language' => 'Язык',
        'code' => 'Код',
        'name' => 'Название (English)',
        'native_name' => 'Нативное название',
        'flag' => 'Флаг',
        'is_active' => 'Активен',
        'is_default' => 'По умолчанию',
        'is_default_helper' => 'Только один язык может быть по умолчанию',
        'sort_order' => 'Сортировка',
    ],

    'table' => [
        'columns' => [
            'flag' => '',
            'code' => 'Код',
            'name' => 'Название',
            'native_name' => 'Нативное название',
            'is_active' => 'Активен',
            'is_default' => 'По умолчанию',
            'sort_order' => 'Сортировка',
        ],
    ],
];
