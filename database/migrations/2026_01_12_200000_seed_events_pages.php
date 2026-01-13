<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Events Page
        Page::updateOrCreate(
            ['slug' => 'events'],
            [
                'template' => 'events-page',
                'is_published' => true,
                'show_in_menu' => true,
                'sort_order' => 60,
                'translations' => [
                    'ru' => [
                        'title' => 'События',
                        'hero_subtitle' => 'Наши события',
                        'hero_title' => 'Присоединяйтесь к нам',
                        'hero_text' => 'Откройте для себя мир увлекательных событий и мероприятий.',
                    ],
                    'en' => [
                        'title' => 'Events',
                        'hero_subtitle' => 'Our Events',
                        'hero_title' => 'Join Us',
                        'hero_text' => 'Discover a world of exciting events and activities.',
                    ],
                    'az' => [
                        'title' => 'Hadisələr',
                        'hero_subtitle' => 'Hadisələrimiz',
                        'hero_title' => 'Bizə Qoşulun',
                        'hero_text' => 'Maraqlı hadisələr və tədbirlər dünyasını kəşf edin.',
                    ],
                ],
                'sections' => [
                    'cta' => [
                        'ru' => [
                            'title' => 'Хотите участвовать?',
                            'text' => 'Свяжитесь с нами для регистрации на событие',
                            'btn_text' => 'Связаться',
                        ],
                        'en' => [
                            'title' => 'Want to Participate?',
                            'text' => 'Contact us to register for an event',
                            'btn_text' => 'Contact Us',
                        ],
                        'az' => [
                            'title' => 'İştirak Etmək İstəyirsiniz?',
                            'text' => 'Hadisəyə qeydiyyat üçün bizimlə əlaqə saxlayın',
                            'btn_text' => 'Əlaqə',
                        ],
                    ],
                ],
            ]
        );

        // Event Detail Page
        Page::updateOrCreate(
            ['slug' => 'event-detail'],
            [
                'template' => 'event-detail',
                'is_published' => true,
                'show_in_menu' => false,
                'sort_order' => 61,
                'translations' => [
                    'ru' => ['title' => 'Детальное событие'],
                    'en' => ['title' => 'Event Detail'],
                    'az' => ['title' => 'Hadisə Ətraflı'],
                ],
                'sections' => [
                    'labels' => [
                        'ru' => [
                            'about' => 'О событии',
                            'gallery' => 'Галерея',
                            'videos' => 'Видео',
                            'upcoming_dates' => 'Ближайшие даты',
                            'regular_schedule' => 'Расписание',
                            'cta_title' => 'Хотите участвовать?',
                            'cta_text' => 'Свяжитесь с нами для регистрации',
                            'cta_btn' => 'Связаться',
                            'other_events' => 'Другие события',
                        ],
                        'en' => [
                            'about' => 'About Event',
                            'gallery' => 'Gallery',
                            'videos' => 'Videos',
                            'upcoming_dates' => 'Upcoming Dates',
                            'regular_schedule' => 'Schedule',
                            'cta_title' => 'Want to Participate?',
                            'cta_text' => 'Contact us to register',
                            'cta_btn' => 'Contact Us',
                            'other_events' => 'Other Events',
                        ],
                        'az' => [
                            'about' => 'Hadisə Haqqında',
                            'gallery' => 'Qalereya',
                            'videos' => 'Videolar',
                            'upcoming_dates' => 'Yaxın Tarixlər',
                            'regular_schedule' => 'Cədvəl',
                            'cta_title' => 'İştirak Etmək İstəyirsiniz?',
                            'cta_text' => 'Qeydiyyat üçün bizimlə əlaqə saxlayın',
                            'cta_btn' => 'Əlaqə',
                            'other_events' => 'Digər Hadisələr',
                        ],
                    ],
                ],
            ]
        );
    }

    public function down(): void
    {
        Page::whereIn('slug', ['events', 'event-detail'])->delete();
    }
};
