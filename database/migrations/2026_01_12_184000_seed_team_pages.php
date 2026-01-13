<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Page;

return new class extends Migration
{
    public function up(): void
    {
        // Team Page
        Page::updateOrCreate(
            ['slug' => 'team-page', 'template' => 'team-page'],
            [
                'translations' => [
                    'ru' => [
                        'title' => 'Страница Команда',
                        'hero_subtitle' => 'Наша команда',
                        'hero_title' => 'Люди, создающие события',
                        'hero_text' => 'Профессионалы своего дела, которые превращают ваши идеи в незабываемые мероприятия',
                        'hero_btn' => 'Связаться с нами',
                    ],
                    'en' => [
                        'title' => 'Team Page',
                        'hero_subtitle' => 'Our Team',
                        'hero_title' => 'People Creating Events',
                        'hero_text' => 'Professionals who turn your ideas into unforgettable events',
                        'hero_btn' => 'Contact Us',
                    ],
                    'az' => [
                        'title' => 'Komanda Səhifəsi',
                        'hero_subtitle' => 'Komandamız',
                        'hero_title' => 'Tədbirlər Yaradan İnsanlar',
                        'hero_text' => 'Fikirlərinizi unudulmaz tədbirlərə çevirən peşəkarlar',
                        'hero_btn' => 'Bizimlə əlaqə',
                    ],
                ],
                'sections' => [
                    'leadership' => [
                        'ru' => ['subtitle' => 'Руководство', 'title' => 'Наши лидеры'],
                        'en' => ['subtitle' => 'Leadership', 'title' => 'Our Leaders'],
                        'az' => ['subtitle' => 'Rəhbərlik', 'title' => 'Liderlərimiz'],
                    ],
                    'team' => [
                        'ru' => ['subtitle' => 'Специалисты', 'title' => 'Наша команда'],
                        'en' => ['subtitle' => 'Specialists', 'title' => 'Our Team'],
                        'az' => ['subtitle' => 'Mütəxəssislər', 'title' => 'Komandamız'],
                    ],
                    'values' => [
                        'ru' => [
                            'subtitle' => 'Наши ценности',
                            'title' => 'Что нас объединяет',
                            'value_1_title' => 'Страсть',
                            'value_1_text' => 'Мы любим то, что делаем. Каждое мероприятие — это возможность создать что-то особенное.',
                            'value_2_title' => 'Качество',
                            'value_2_text' => 'Мы не идём на компромиссы. Каждая деталь должна быть безупречной.',
                            'value_3_title' => 'Команда',
                            'value_3_text' => 'Вместе мы сильнее. Успех каждого проекта — результат слаженной работы.',
                        ],
                        'en' => [
                            'subtitle' => 'Our Values',
                            'title' => 'What Unites Us',
                            'value_1_title' => 'Passion',
                            'value_1_text' => 'We love what we do. Every event is an opportunity to create something special.',
                            'value_2_title' => 'Quality',
                            'value_2_text' => 'We don\'t compromise. Every detail must be flawless.',
                            'value_3_title' => 'Teamwork',
                            'value_3_text' => 'Together we are stronger. The success of each project is the result of coordinated work.',
                        ],
                        'az' => [
                            'subtitle' => 'Dəyərlərimiz',
                            'title' => 'Bizi Birləşdirən',
                            'value_1_title' => 'Həvəs',
                            'value_1_text' => 'İşimizi sevirik. Hər tədbir xüsusi bir şey yaratmaq fürsətidir.',
                            'value_2_title' => 'Keyfiyyət',
                            'value_2_text' => 'Güzəştə getmirik. Hər detal qüsursuz olmalıdır.',
                            'value_3_title' => 'Komanda',
                            'value_3_text' => 'Birlikdə daha güclüyük. Hər layihənin uğuru əlaqələndirilmiş işin nəticəsidir.',
                        ],
                    ],
                    'join' => [
                        'email' => 'hr@meetup.az',
                        'ru' => [
                            'subtitle' => 'Карьера',
                            'title' => 'Присоединяйтесь к нам',
                            'text' => 'Мы всегда в поиске талантливых людей, которые разделяют нашу страсть к созданию незабываемых событий.',
                            'benefit_1' => 'Работа над уникальными проектами',
                            'benefit_2' => 'Профессиональное развитие',
                            'benefit_3' => 'Дружная команда единомышленников',
                            'benefit_4' => 'Конкурентная оплата труда',
                            'btn_text' => 'Отправить резюме',
                        ],
                        'en' => [
                            'subtitle' => 'Career',
                            'title' => 'Join Us',
                            'text' => 'We are always looking for talented people who share our passion for creating unforgettable events.',
                            'benefit_1' => 'Work on unique projects',
                            'benefit_2' => 'Professional development',
                            'benefit_3' => 'Friendly team of like-minded people',
                            'benefit_4' => 'Competitive salary',
                            'btn_text' => 'Send Resume',
                        ],
                        'az' => [
                            'subtitle' => 'Karyera',
                            'title' => 'Bizə Qoşulun',
                            'text' => 'Unudulmaz tədbirlər yaratmaq həvəsimizi bölüşən istedadlı insanları həmişə axtarırıq.',
                            'benefit_1' => 'Unikal layihələr üzərində iş',
                            'benefit_2' => 'Peşəkar inkişaf',
                            'benefit_3' => 'Həmfikir dostlar komandası',
                            'benefit_4' => 'Rəqabətli əmək haqqı',
                            'btn_text' => 'CV Göndər',
                        ],
                    ],
                    'cta' => [
                        'ru' => [
                            'title' => 'Готовы создать событие вместе?',
                            'text' => 'Наша команда готова воплотить ваши идеи в реальность',
                            'btn_text' => 'Связаться с нами',
                        ],
                        'en' => [
                            'title' => 'Ready to Create an Event Together?',
                            'text' => 'Our team is ready to bring your ideas to life',
                            'btn_text' => 'Contact Us',
                        ],
                        'az' => [
                            'title' => 'Birlikdə Tədbir Yaratmağa Hazırsınız?',
                            'text' => 'Komandamız ideyalarınızı həyata keçirməyə hazırdır',
                            'btn_text' => 'Bizimlə Əlaqə',
                        ],
                    ],
                ],
                'is_published' => true,
                'show_in_menu' => false,
                'sort_order' => 10,
            ]
        );

        // Team Detail Page
        Page::updateOrCreate(
            ['slug' => 'team-detail', 'template' => 'team-detail'],
            [
                'translations' => [
                    'ru' => ['title' => 'Детальная Команда'],
                    'en' => ['title' => 'Team Detail'],
                    'az' => ['title' => 'Komanda Ətraflı'],
                ],
                'sections' => [
                    'labels' => [
                        'ru' => [
                            'expertise' => 'Экспертиза',
                            'skills_title' => 'Ключевые компетенции',
                            'other_subtitle' => 'Коллеги',
                            'other_title' => 'Другие члены команды',
                            'cta_title' => 'Обсудим ваш проект?',
                            'cta_text' => 'Свяжитесь напрямую для обсуждения проектов',
                            'cta_btn' => 'Написать',
                            'cta_btn_contact' => 'Связаться с нами',
                        ],
                        'en' => [
                            'expertise' => 'Expertise',
                            'skills_title' => 'Key Skills',
                            'other_subtitle' => 'Colleagues',
                            'other_title' => 'Other Team Members',
                            'cta_title' => 'Discuss Your Project?',
                            'cta_text' => 'Contact directly to discuss projects',
                            'cta_btn' => 'Write',
                            'cta_btn_contact' => 'Contact Us',
                        ],
                        'az' => [
                            'expertise' => 'Ekspertiza',
                            'skills_title' => 'Əsas Bacarıqlar',
                            'other_subtitle' => 'Həmkarlar',
                            'other_title' => 'Digər Komanda Üzvləri',
                            'cta_title' => 'Layihənizi Müzakirə Edək?',
                            'cta_text' => 'Layihələri müzakirə etmək üçün birbaşa əlaqə saxlayın',
                            'cta_btn' => 'Yaz',
                            'cta_btn_contact' => 'Bizimlə Əlaqə',
                        ],
                    ],
                ],
                'is_published' => true,
                'show_in_menu' => false,
                'sort_order' => 11,
            ]
        );
    }

    public function down(): void
    {
        Page::where('slug', 'team-page')->where('template', 'team-page')->delete();
        Page::where('slug', 'team-detail')->where('template', 'team-detail')->delete();
    }
};
