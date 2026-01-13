<?php

return [
    'resource' => [
        'label' => 'Event',
        'plural_label' => 'Events',
        'navigation_label' => 'Our Events',
        'navigation_group' => 'Content',
    ],

    'sections' => [
        'main' => 'Main',
        'gallery' => 'Gallery',
        'widgets' => 'Videos & Frames',
        'widgets_description' => 'Add videos from YouTube, Telegram, Instagram and other platforms',
        'regular_schedule' => 'Regular Schedule',
        'regular_schedule_description' => 'Specify days of the week and times when the event is held regularly',
        'specific_dates' => 'Specific Dates',
        'specific_dates_description' => 'Specify specific dates for the event in the coming month',
        'settings' => 'Settings',
    ],

    'fields' => [
        'icon' => 'Icon',
        'icon_hint' => 'Use emoji, for example: 🎭 🧠 🏠 🎲',
        'title' => 'Title',
        'description' => 'Description',
        'gallery' => 'Photos',
        'gallery_helper' => 'Upload event photos. Maximum 50 images.',
        'day_of_week' => 'Day of Week',
        'date' => 'Date',
        'start_time' => 'Start Time',
        'end_time' => 'End Time',
        'note' => 'Note',
        'note_placeholder' => 'Special conditions...',
        'sort_order' => 'Sort Order',
        'is_published' => 'Published',
        'schedules_count' => 'Schedules',
        'dates_count' => 'Dates',
        'widget_content' => 'Link or Code',
        'widget_content_placeholder' => 'Paste video link or embed code...',
        'widget_type' => 'Type',
        'widget_type_helper' => 'Type is detected automatically',
        'widget_preview' => 'Preview',
        'widget_preview_empty' => 'Paste content to preview',
        // Page labels
        'about_label' => '"About Event" Title',
        'gallery_label' => '"Gallery" Title',
        'videos_label' => '"Videos" Title',
        'upcoming_dates_label' => '"Upcoming Dates" Title',
        'regular_schedule_label' => '"Schedule" Title',
        'cta_title' => 'CTA Title',
        'cta_text' => 'CTA Text',
        'cta_btn' => 'CTA Button',
        'other_events_label' => '"Other Events" Title',
    ],

    'days' => [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday',
    ],

    'widget_types' => [
        'youtube' => 'YouTube',
        'telegram' => 'Telegram',
        'instagram' => 'Instagram',
        'fbvideo' => 'Facebook Video',
        'okru' => 'OK.ru',
        'x' => 'X/Twitter',
        'html' => 'HTML Code',
    ],

    'widget_helpers' => [
        'youtube' => 'Paste YouTube video link',
        'okru' => 'Paste OK.ru video link',
        'instagram' => 'Paste Instagram post or Reels link',
        'telegram' => 'Paste embed code from Telegram',
        'x' => 'Paste embed code from X/Twitter',
        'fbvideo' => 'Paste embed code from Facebook',
        'default' => 'Paste link or embed code',
    ],

    'widget_labels' => [
        'default' => 'New widget',
    ],

    'widget_preview_not_supported' => 'Preview not available for this type',

    'actions' => [
        'add_schedule' => 'Add Schedule',
        'add_date' => 'Add Date',
        'add_widget' => 'Add Video/Frame',
        'page_settings' => 'Page Settings',
        'edit_events_page' => 'Events Page',
        'edit_event_detail' => 'Event Detail',
    ],
];
