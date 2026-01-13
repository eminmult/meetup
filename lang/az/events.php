<?php

return [
    'resource' => [
        'label' => 'Hadisə',
        'plural_label' => 'Hadisələr',
        'navigation_label' => 'Hadisələrimiz',
        'navigation_group' => 'Kontent',
    ],

    'sections' => [
        'main' => 'Əsas',
        'gallery' => 'Qalereya',
        'widgets' => 'Video və freymler',
        'widgets_description' => 'YouTube, Telegram, Instagram və digər platformalardan video əlavə edin',
        'regular_schedule' => 'Müntəzəm cədvəl',
        'regular_schedule_description' => 'Hadisənin müntəzəm keçirildiyi həftənin günlərini və vaxtını göstərin',
        'specific_dates' => 'Konkret tarixlər',
        'specific_dates_description' => 'Yaxın bir ay üçün hadisənin konkret tarixlərini göstərin',
        'settings' => 'Parametrlər',
    ],

    'fields' => [
        'icon' => 'İkon',
        'icon_hint' => 'Emoji istifadə edin, məsələn: 🎭 🧠 🏠 🎲',
        'title' => 'Başlıq',
        'description' => 'Təsvir',
        'gallery' => 'Şəkillər',
        'gallery_helper' => 'Hadisə şəkillərini yükləyin. Maksimum 50 şəkil.',
        'day_of_week' => 'Həftənin günü',
        'date' => 'Tarix',
        'start_time' => 'Başlanğıc',
        'end_time' => 'Bitmə',
        'note' => 'Qeyd',
        'note_placeholder' => 'Xüsusi şərtlər...',
        'sort_order' => 'Sıralama',
        'is_published' => 'Dərc edilib',
        'schedules_count' => 'Cədvəl',
        'dates_count' => 'Tarixlər',
        'widget_content' => 'Link və ya kod',
        'widget_content_placeholder' => 'Video linki və ya embed kodu yapışdırın...',
        'widget_type' => 'Növ',
        'widget_type_helper' => 'Növ avtomatik müəyyən edilir',
        'widget_preview' => 'Önizləmə',
        'widget_preview_empty' => 'Önizləmə üçün kontent yapışdırın',
        // Page labels
        'about_label' => '"Hadisə haqqında" başlığı',
        'gallery_label' => '"Qalereya" başlığı',
        'videos_label' => '"Video" başlığı',
        'upcoming_dates_label' => '"Yaxın tarixlər" başlığı',
        'regular_schedule_label' => '"Cədvəl" başlığı',
        'cta_title' => 'CTA Başlıq',
        'cta_text' => 'CTA Mətn',
        'cta_btn' => 'CTA Düymə',
        'other_events_label' => '"Digər hadisələr" başlığı',
    ],

    'days' => [
        'monday' => 'Bazar ertəsi',
        'tuesday' => 'Çərşənbə axşamı',
        'wednesday' => 'Çərşənbə',
        'thursday' => 'Cümə axşamı',
        'friday' => 'Cümə',
        'saturday' => 'Şənbə',
        'sunday' => 'Bazar',
        1 => 'Bazar ertəsi',
        2 => 'Çərşənbə axşamı',
        3 => 'Çərşənbə',
        4 => 'Cümə axşamı',
        5 => 'Cümə',
        6 => 'Şənbə',
        7 => 'Bazar',
    ],

    'widget_types' => [
        'youtube' => 'YouTube',
        'telegram' => 'Telegram',
        'instagram' => 'Instagram',
        'fbvideo' => 'Facebook Video',
        'okru' => 'OK.ru',
        'x' => 'X/Twitter',
        'html' => 'HTML kodu',
    ],

    'widget_helpers' => [
        'youtube' => 'YouTube video linkini yapışdırın',
        'okru' => 'OK.ru video linkini yapışdırın',
        'instagram' => 'Instagram post və ya Reels linkini yapışdırın',
        'telegram' => 'Telegramdan embed kodu yapışdırın',
        'x' => 'X/Twitter-dən embed kodu yapışdırın',
        'fbvideo' => 'Facebook-dan embed kodu yapışdırın',
        'default' => 'Link və ya embed kodu yapışdırın',
    ],

    'widget_labels' => [
        'default' => 'Yeni widget',
    ],

    'widget_preview_not_supported' => 'Bu növ üçün önizləmə mövcud deyil',

    'actions' => [
        'add_schedule' => 'Cədvəl əlavə et',
        'add_date' => 'Tarix əlavə et',
        'add_widget' => 'Video/Freym əlavə et',
        'page_settings' => 'Səhifə Parametrləri',
        'edit_events_page' => 'Hadisələr Səhifəsi',
        'edit_event_detail' => 'Hadisə Ətraflı',
    ],
];
