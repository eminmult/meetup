<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Services Page
        Page::updateOrCreate(
            ['slug' => 'services'],
            [
                'template' => 'services-page',
                'is_published' => true,
                'show_in_menu' => true,
                'sort_order' => 30,
                'translations' => [
                    'ru' => [
                        'title' => 'Услуги',
                        'hero_subtitle' => 'Наши услуги',
                        'hero_title' => 'Создаём незабываемые события',
                        'hero_text' => 'Полный спектр услуг по организации мероприятий любой сложности.',
                        'hero_btn' => 'Заказать услугу',
                    ],
                    'en' => [
                        'title' => 'Services',
                        'hero_subtitle' => 'Our Services',
                        'hero_title' => 'Creating Unforgettable Events',
                        'hero_text' => 'Full range of event organization services of any complexity.',
                        'hero_btn' => 'Order Service',
                    ],
                    'az' => [
                        'title' => 'Xidmətlər',
                        'hero_subtitle' => 'Xidmətlərimiz',
                        'hero_title' => 'Unudulmaz Tədbirlər Yaradırıq',
                        'hero_text' => 'İstənilən mürəkkəblikdə tədbir təşkili üzrə tam xidmət spektri.',
                        'hero_btn' => 'Xidmət Sifariş Et',
                    ],
                ],
                'sections' => [
                    'overview' => [
                        'ru' => ['subtitle' => 'Что мы предлагаем', 'title' => 'Наши услуги', 'details_btn' => 'Подробнее'],
                        'en' => ['subtitle' => 'What We Offer', 'title' => 'Our Services', 'details_btn' => 'Learn More'],
                        'az' => ['subtitle' => 'Nə Təklif Edirik', 'title' => 'Xidmətlərimiz', 'details_btn' => 'Ətraflı'],
                    ],
                    'process' => [
                        'ru' => [
                            'subtitle' => 'Как мы работаем',
                            'title' => 'Процесс работы',
                            'step_1_title' => 'Консультация',
                            'step_1_text' => 'Обсуждаем ваши идеи и пожелания',
                            'step_2_title' => 'Планирование',
                            'step_2_text' => 'Разрабатываем концепцию и бюджет',
                            'step_3_title' => 'Подготовка',
                            'step_3_text' => 'Организуем все детали мероприятия',
                            'step_4_title' => 'Реализация',
                            'step_4_text' => 'Проводим мероприятие на высшем уровне',
                        ],
                        'en' => [
                            'subtitle' => 'How We Work',
                            'title' => 'Our Process',
                            'step_1_title' => 'Consultation',
                            'step_1_text' => 'We discuss your ideas and wishes',
                            'step_2_title' => 'Planning',
                            'step_2_text' => 'We develop a concept and budget',
                            'step_3_title' => 'Preparation',
                            'step_3_text' => 'We organize all event details',
                            'step_4_title' => 'Execution',
                            'step_4_text' => 'We deliver the event at the highest level',
                        ],
                        'az' => [
                            'subtitle' => 'Necə İşləyirik',
                            'title' => 'İş Prosesimiz',
                            'step_1_title' => 'Məsləhət',
                            'step_1_text' => 'İdeyalarınızı və istəklərinizi müzakirə edirik',
                            'step_2_title' => 'Planlaşdırma',
                            'step_2_text' => 'Konsepsiya və büdcə hazırlayırıq',
                            'step_3_title' => 'Hazırlıq',
                            'step_3_text' => 'Tədbirin bütün detallarını təşkil edirik',
                            'step_4_title' => 'İcra',
                            'step_4_text' => 'Tədbiri ən yüksək səviyyədə keçiririk',
                        ],
                    ],
                    'cta' => [
                        'ru' => ['title' => 'Готовы начать?', 'text' => 'Свяжитесь с нами для обсуждения вашего мероприятия', 'btn_text' => 'Связаться'],
                        'en' => ['title' => 'Ready to Start?', 'text' => 'Contact us to discuss your event', 'btn_text' => 'Contact Us'],
                        'az' => ['title' => 'Başlamağa Hazırsınız?', 'text' => 'Tədbirinizi müzakirə etmək üçün bizimlə əlaqə saxlayın', 'btn_text' => 'Əlaqə'],
                    ],
                ],
            ]
        );

        // Service Detail Page
        Page::updateOrCreate(
            ['slug' => 'service-detail'],
            [
                'template' => 'service-detail',
                'is_published' => true,
                'show_in_menu' => false,
                'sort_order' => 31,
                'translations' => [
                    'ru' => ['title' => 'Детальная услуга'],
                    'en' => ['title' => 'Service Detail'],
                    'az' => ['title' => 'Xidmət Ətraflı'],
                ],
                'sections' => [
                    'labels' => [
                        'ru' => [
                            'about_subtitle' => 'Об услуге',
                            'offers_subtitle' => 'Что входит',
                            'offers_title' => 'Что мы предлагаем',
                            'gallery_subtitle' => 'Галерея',
                            'gallery_title' => 'Наши работы',
                            'other_subtitle' => 'Также смотрите',
                            'other_title' => 'Другие услуги',
                        ],
                        'en' => [
                            'about_subtitle' => 'About Service',
                            'offers_subtitle' => 'What\'s Included',
                            'offers_title' => 'What We Offer',
                            'gallery_subtitle' => 'Gallery',
                            'gallery_title' => 'Our Work',
                            'other_subtitle' => 'Also Check',
                            'other_title' => 'Other Services',
                        ],
                        'az' => [
                            'about_subtitle' => 'Xidmət Haqqında',
                            'offers_subtitle' => 'Nə Daxildir',
                            'offers_title' => 'Nə Təklif Edirik',
                            'gallery_subtitle' => 'Qalereya',
                            'gallery_title' => 'İşlərimiz',
                            'other_subtitle' => 'Həmçinin Baxın',
                            'other_title' => 'Digər Xidmətlər',
                        ],
                    ],
                ],
            ]
        );

        // Portfolio Page
        Page::updateOrCreate(
            ['slug' => 'portfolio'],
            [
                'template' => 'portfolio-page',
                'is_published' => true,
                'show_in_menu' => true,
                'sort_order' => 40,
                'translations' => [
                    'ru' => [
                        'title' => 'Портфолио',
                        'hero_subtitle' => 'Наши проекты',
                        'hero_title' => 'Истории успеха',
                        'hero_text' => 'Посмотрите мероприятия, которые мы организовали для наших клиентов.',
                    ],
                    'en' => [
                        'title' => 'Portfolio',
                        'hero_subtitle' => 'Our Projects',
                        'hero_title' => 'Success Stories',
                        'hero_text' => 'See the events we have organized for our clients.',
                    ],
                    'az' => [
                        'title' => 'Portfel',
                        'hero_subtitle' => 'Layihələrimiz',
                        'hero_title' => 'Uğur Hekayələri',
                        'hero_text' => 'Müştərilərimiz üçün təşkil etdiyimiz tədbirlərə baxın.',
                    ],
                ],
                'sections' => [
                    'stats' => [
                        'events_number' => 500,
                        'clients_number' => 200,
                        'years_number' => 7,
                        'satisfaction_number' => '99%',
                        'ru' => ['events_label' => 'Мероприятий', 'clients_label' => 'Клиентов', 'years_label' => 'Лет опыта', 'satisfaction_label' => 'Довольных клиентов'],
                        'en' => ['events_label' => 'Events', 'clients_label' => 'Clients', 'years_label' => 'Years Experience', 'satisfaction_label' => 'Satisfied Clients'],
                        'az' => ['events_label' => 'Tədbirlər', 'clients_label' => 'Müştərilər', 'years_label' => 'İllik Təcrübə', 'satisfaction_label' => 'Məmnun Müştərilər'],
                    ],
                    'clients' => [
                        'ru' => ['subtitle' => 'Наши клиенты', 'title' => 'Нам доверяют'],
                        'en' => ['subtitle' => 'Our Clients', 'title' => 'They Trust Us'],
                        'az' => ['subtitle' => 'Müştərilərimiz', 'title' => 'Bizə Etibar Edirlər'],
                    ],
                    'cta' => [
                        'ru' => ['title' => 'Хотите такое же мероприятие?', 'text' => 'Свяжитесь с нами и обсудим детали', 'btn_text' => 'Обсудить проект'],
                        'en' => ['title' => 'Want a Similar Event?', 'text' => 'Contact us and let\'s discuss details', 'btn_text' => 'Discuss Project'],
                        'az' => ['title' => 'Oxşar Tədbir İstəyirsiniz?', 'text' => 'Bizimlə əlaqə saxlayın və detalları müzakirə edək', 'btn_text' => 'Layihəni Müzakirə Et'],
                    ],
                ],
            ]
        );

        // Portfolio Detail Page
        Page::updateOrCreate(
            ['slug' => 'portfolio-detail'],
            [
                'template' => 'portfolio-detail',
                'is_published' => true,
                'show_in_menu' => false,
                'sort_order' => 41,
                'translations' => [
                    'ru' => ['title' => 'Детальная портфолио'],
                    'en' => ['title' => 'Portfolio Detail'],
                    'az' => ['title' => 'Portfel Ətraflı'],
                ],
                'sections' => [
                    'labels' => [
                        'ru' => [
                            'view_gallery' => 'Галерея',
                            'watch_video' => 'Видео',
                            'scroll' => 'Листайте вниз',
                            'gallery_subtitle' => 'Фотогалерея',
                            'gallery_title' => 'Галерея проекта',
                            'video_subtitle' => 'Видеоотчёт',
                            'video_title' => 'Видео проекта',
                            'other_subtitle' => 'Также смотрите',
                            'other_title' => 'Другие проекты',
                            'cta_title' => 'Хотите такое же?',
                            'cta_text' => 'Свяжитесь с нами для обсуждения',
                            'cta_btn' => 'Связаться',
                        ],
                        'en' => [
                            'view_gallery' => 'Gallery',
                            'watch_video' => 'Video',
                            'scroll' => 'Scroll Down',
                            'gallery_subtitle' => 'Photo Gallery',
                            'gallery_title' => 'Project Gallery',
                            'video_subtitle' => 'Video Report',
                            'video_title' => 'Project Video',
                            'other_subtitle' => 'Also Check',
                            'other_title' => 'Other Projects',
                            'cta_title' => 'Want Something Similar?',
                            'cta_text' => 'Contact us for discussion',
                            'cta_btn' => 'Contact Us',
                        ],
                        'az' => [
                            'view_gallery' => 'Qalereya',
                            'watch_video' => 'Video',
                            'scroll' => 'Aşağı Sürüşdürün',
                            'gallery_subtitle' => 'Foto Qalereya',
                            'gallery_title' => 'Layihə Qalereyası',
                            'video_subtitle' => 'Video Hesabat',
                            'video_title' => 'Layihə Videosu',
                            'other_subtitle' => 'Həmçinin Baxın',
                            'other_title' => 'Digər Layihələr',
                            'cta_title' => 'Oxşarını İstəyirsiniz?',
                            'cta_text' => 'Müzakirə üçün bizimlə əlaqə saxlayın',
                            'cta_btn' => 'Əlaqə',
                        ],
                    ],
                ],
            ]
        );

        // Blog Page
        Page::updateOrCreate(
            ['slug' => 'blog'],
            [
                'template' => 'blog-page',
                'is_published' => true,
                'show_in_menu' => true,
                'sort_order' => 50,
                'translations' => [
                    'ru' => [
                        'title' => 'Блог',
                        'hero_subtitle' => 'Наш блог',
                        'hero_title' => 'Новости и статьи',
                        'hero_text' => 'Полезные материалы об организации мероприятий.',
                    ],
                    'en' => [
                        'title' => 'Blog',
                        'hero_subtitle' => 'Our Blog',
                        'hero_title' => 'News & Articles',
                        'hero_text' => 'Useful materials about event organization.',
                    ],
                    'az' => [
                        'title' => 'Bloq',
                        'hero_subtitle' => 'Bloqümuz',
                        'hero_title' => 'Xəbərlər və Məqalələr',
                        'hero_text' => 'Tədbir təşkilatı haqqında faydalı materiallar.',
                    ],
                ],
                'sections' => [
                    'labels' => [
                        'ru' => [
                            'all_posts' => 'Все статьи',
                            'read_more' => 'Читать далее',
                            'search_placeholder' => 'Поиск...',
                            'no_posts' => 'Статьи не найдены',
                            'categories' => 'Категории',
                            'recent_posts' => 'Последние статьи',
                        ],
                        'en' => [
                            'all_posts' => 'All Posts',
                            'read_more' => 'Read More',
                            'search_placeholder' => 'Search...',
                            'no_posts' => 'No posts found',
                            'categories' => 'Categories',
                            'recent_posts' => 'Recent Posts',
                        ],
                        'az' => [
                            'all_posts' => 'Bütün Yazılar',
                            'read_more' => 'Daha çox oxu',
                            'search_placeholder' => 'Axtarış...',
                            'no_posts' => 'Yazı tapılmadı',
                            'categories' => 'Kateqoriyalar',
                            'recent_posts' => 'Son Yazılar',
                        ],
                    ],
                ],
            ]
        );

        // Blog Detail Page
        Page::updateOrCreate(
            ['slug' => 'blog-detail'],
            [
                'template' => 'blog-detail',
                'is_published' => true,
                'show_in_menu' => false,
                'sort_order' => 51,
                'translations' => [
                    'ru' => ['title' => 'Детальная статья'],
                    'en' => ['title' => 'Article Detail'],
                    'az' => ['title' => 'Məqalə Ətraflı'],
                ],
                'sections' => [
                    'labels' => [
                        'ru' => [
                            'share' => 'Поделиться',
                            'author' => 'Автор',
                            'published' => 'Опубликовано',
                            'related_posts' => 'Похожие статьи',
                            'back_to_blog' => 'Назад к блогу',
                        ],
                        'en' => [
                            'share' => 'Share',
                            'author' => 'Author',
                            'published' => 'Published',
                            'related_posts' => 'Related Posts',
                            'back_to_blog' => 'Back to Blog',
                        ],
                        'az' => [
                            'share' => 'Paylaş',
                            'author' => 'Müəllif',
                            'published' => 'Dərc edilib',
                            'related_posts' => 'Oxşar Yazılar',
                            'back_to_blog' => 'Bloqa qayıt',
                        ],
                    ],
                ],
            ]
        );
    }

    public function down(): void
    {
        Page::whereIn('slug', [
            'services', 'service-detail',
            'portfolio', 'portfolio-detail',
            'blog', 'blog-detail'
        ])->delete();
    }
};
