<?php

return [
    'resource' => [
        'label' => 'Событие',
        'plural_label' => 'События',
        'navigation_label' => 'Наши события',
        'navigation_group' => 'Контент',
    ],

    'sections' => [
        'main' => 'Основное',
        'gallery' => 'Галерея',
        'widgets' => 'Видео и фреймы',
        'widgets_description' => 'Добавьте видео с YouTube, Telegram, Instagram и других платформ',
        'regular_schedule' => 'Регулярное расписание',
        'regular_schedule_description' => 'Укажите дни недели и время, когда событие проводится регулярно',
        'specific_dates' => 'Конкретные даты',
        'specific_dates_description' => 'Укажите конкретные даты проведения события на ближайший месяц',
        'settings' => 'Настройки',
    ],

    'fields' => [
        'icon' => 'Иконка',
        'icon_hint' => 'Используйте эмодзи, например: 🎭 🧠 🏠 🎲',
        'title' => 'Название',
        'description' => 'Описание',
        'gallery' => 'Фотографии',
        'gallery_helper' => 'Загрузите фотографии события. Максимум 50 изображений.',
        'day_of_week' => 'День недели',
        'date' => 'Дата',
        'start_time' => 'Начало',
        'end_time' => 'Окончание',
        'note' => 'Примечание',
        'note_placeholder' => 'Особые условия...',
        'sort_order' => 'Сортировка',
        'is_published' => 'Опубликовано',
        'schedules_count' => 'Расписание',
        'dates_count' => 'Даты',
        'widget_content' => 'Ссылка или код',
        'widget_content_placeholder' => 'Вставьте ссылку на видео или embed-код...',
        'widget_type' => 'Тип',
        'widget_type_helper' => 'Тип определяется автоматически',
        'widget_preview' => 'Предпросмотр',
        'widget_preview_empty' => 'Вставьте контент для предпросмотра',
        // Page labels
        'about_label' => 'Заголовок "О событии"',
        'gallery_label' => 'Заголовок "Галерея"',
        'videos_label' => 'Заголовок "Видео"',
        'upcoming_dates_label' => 'Заголовок "Ближайшие даты"',
        'regular_schedule_label' => 'Заголовок "Расписание"',
        'cta_title' => 'CTA Заголовок',
        'cta_text' => 'CTA Текст',
        'cta_btn' => 'CTA Кнопка',
        'other_events_label' => 'Заголовок "Другие события"',
    ],

    'days' => [
        'monday' => 'Понедельник',
        'tuesday' => 'Вторник',
        'wednesday' => 'Среда',
        'thursday' => 'Четверг',
        'friday' => 'Пятница',
        'saturday' => 'Суббота',
        'sunday' => 'Воскресенье',
        // Numeric keys for database values
        1 => 'Понедельник',
        2 => 'Вторник',
        3 => 'Среда',
        4 => 'Четверг',
        5 => 'Пятница',
        6 => 'Суббота',
        7 => 'Воскресенье',
    ],

    'widget_types' => [
        'youtube' => 'YouTube',
        'telegram' => 'Telegram',
        'instagram' => 'Instagram',
        'fbvideo' => 'Facebook Video',
        'okru' => 'OK.ru',
        'x' => 'X/Twitter',
        'html' => 'HTML код',
    ],

    'widget_helpers' => [
        'youtube' => 'Вставьте ссылку на YouTube видео',
        'okru' => 'Вставьте ссылку на OK.ru видео',
        'instagram' => 'Вставьте ссылку на Instagram пост или Reels',
        'telegram' => 'Вставьте embed-код из Telegram',
        'x' => 'Вставьте embed-код из X/Twitter',
        'fbvideo' => 'Вставьте embed-код из Facebook',
        'default' => 'Вставьте ссылку или embed-код',
    ],

    'widget_labels' => [
        'default' => 'Новый виджет',
    ],

    'widget_preview_not_supported' => 'Предпросмотр недоступен для этого типа',

    'actions' => [
        'add_schedule' => 'Добавить расписание',
        'add_date' => 'Добавить дату',
        'add_widget' => 'Добавить видео/фрейм',
        'page_settings' => 'Настройки страниц',
        'edit_events_page' => 'Страница События',
        'edit_event_detail' => 'Детальная Событие',
    ],
];
