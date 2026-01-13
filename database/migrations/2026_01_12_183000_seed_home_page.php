<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Page;

return new class extends Migration
{
    public function up(): void
    {
        Page::updateOrCreate(
            ['slug' => 'home', 'template' => 'home'],
            [
                'translations' => [
                    'ru' => [
                        'title' => 'Главная',
                        'hero_title' => 'Создаём незабываемые события',
                        'hero_description' => 'Профессиональная организация мероприятий любого масштаба в Баку. От идеи до реализации — мы создаём впечатления.',
                        'hero_cta_primary' => 'Обсудить проект',
                        'hero_cta_secondary' => 'Смотреть работы',
                        'hero_scroll' => 'Scroll',
                    ],
                    'en' => [
                        'title' => 'Home',
                        'hero_title' => 'We create unforgettable events',
                        'hero_description' => 'Professional event organization of any scale in Baku. From idea to implementation — we create impressions.',
                        'hero_cta_primary' => 'Discuss project',
                        'hero_cta_secondary' => 'View works',
                        'hero_scroll' => 'Scroll',
                    ],
                    'az' => [
                        'title' => 'Əsas',
                        'hero_title' => 'Unudulmaz tədbirlər yaradırıq',
                        'hero_description' => 'Bakıda istənilən miqyaslı tədbirlərin peşəkar təşkili. İdeyadan reallaşdırmaya qədər — biz təəssüratlar yaradırıq.',
                        'hero_cta_primary' => 'Layihəni müzakirə et',
                        'hero_cta_secondary' => 'İşlərə bax',
                        'hero_scroll' => 'Sürüşdür',
                    ],
                ],
                'sections' => [
                    'about' => [
                        'years_number' => 7,
                        'ru' => [
                            'subtitle' => 'Почему мы?',
                            'title' => 'Мы создаём события, которые запоминаются',
                            'text' => 'MEETUP — это команда профессионалов в сфере организации мероприятий. Мы берём на себя все этапы: от разработки концепции до полной реализации. Каждый проект для нас — это возможность создать что-то уникальное.',
                            'years_label' => 'лет опыта',
                            'feature_1' => 'Полный цикл услуг',
                            'feature_2' => 'Точно в срок',
                            'feature_3' => 'Опытная команда',
                            'feature_4' => 'Премиум качество',
                            'learn_more' => 'Узнать больше',
                        ],
                        'en' => [
                            'subtitle' => 'Why Us?',
                            'title' => 'We create events that are remembered',
                            'text' => 'MEETUP is a team of professionals in event organization. We take on all stages: from concept development to full implementation. Each project is an opportunity to create something unique.',
                            'years_label' => 'years of experience',
                            'feature_1' => 'Full cycle of services',
                            'feature_2' => 'On time',
                            'feature_3' => 'Experienced team',
                            'feature_4' => 'Premium quality',
                            'learn_more' => 'Learn more',
                        ],
                        'az' => [
                            'subtitle' => 'Niyə biz?',
                            'title' => 'Yadda qalan tədbirlər yaradırıq',
                            'text' => 'MEETUP — tədbir təşkili sahəsində peşəkarlar komandası. Konsepsiyanın hazırlanmasından tam reallaşdırmaya qədər bütün mərhələləri öhdəmizə götürürük.',
                            'years_label' => 'illik təcrübə',
                            'feature_1' => 'Tam xidmət dövrü',
                            'feature_2' => 'Vaxtında',
                            'feature_3' => 'Təcrübəli komanda',
                            'feature_4' => 'Premium keyfiyyət',
                            'learn_more' => 'Ətraflı',
                        ],
                    ],
                    'partners' => [
                        'ru' => ['title' => 'Наши партнёры'],
                        'en' => ['title' => 'Our Partners'],
                        'az' => ['title' => 'Tərəfdaşlarımız'],
                    ],
                    'team' => [
                        'ru' => [
                            'subtitle' => 'Знакомьтесь',
                            'title' => 'Наша команда',
                            'description' => 'Профессионалы, которые делают ваши мероприятия незабываемыми',
                        ],
                        'en' => [
                            'subtitle' => 'Meet',
                            'title' => 'Our Team',
                            'description' => 'Professionals who make your events unforgettable',
                        ],
                        'az' => [
                            'subtitle' => 'Tanış olun',
                            'title' => 'Komandamız',
                            'description' => 'Tədbirlərinizi unudulmaz edən peşəkarlar',
                        ],
                    ],
                    'services' => [
                        'ru' => [
                            'subtitle' => 'Наши услуги',
                            'title' => 'Что мы предлагаем',
                            'description' => 'Комплексные решения для организации мероприятий любого формата и масштаба',
                        ],
                        'en' => [
                            'subtitle' => 'Our Services',
                            'title' => 'What We Offer',
                            'description' => 'Comprehensive solutions for organizing events of any format and scale',
                        ],
                        'az' => [
                            'subtitle' => 'Xidmətlərimiz',
                            'title' => 'Nə təklif edirik',
                            'description' => 'İstənilən format və miqyaslı tədbirlərin təşkili üçün hərtərəfli həllər',
                        ],
                    ],
                    'portfolio' => [
                        'ru' => [
                            'subtitle' => 'Портфолио',
                            'title' => 'Наши работы',
                        ],
                        'en' => [
                            'subtitle' => 'Portfolio',
                            'title' => 'Our Works',
                        ],
                        'az' => [
                            'subtitle' => 'Portfolio',
                            'title' => 'İşlərimiz',
                        ],
                    ],
                    'stats' => [
                        'events_number' => 500,
                        'guests_number' => 50,
                        'years_number' => 7,
                        'team_number' => 25,
                        'ru' => [
                            'events_label' => 'Проведённых мероприятий',
                            'guests_label' => 'Счастливых гостей',
                            'years_label' => 'Лет на рынке',
                            'team_label' => 'Профессионалов в команде',
                        ],
                        'en' => [
                            'events_label' => 'Events Completed',
                            'guests_label' => 'Happy Guests',
                            'years_label' => 'Years in Business',
                            'team_label' => 'Team Members',
                        ],
                        'az' => [
                            'events_label' => 'Keçirilmiş tədbirlər',
                            'guests_label' => 'Xoşbəxt qonaqlar',
                            'years_label' => 'Bazarda illər',
                            'team_label' => 'Komanda üzvləri',
                        ],
                    ],
                    'community' => [
                        'ru' => [
                            'subtitle' => 'Присоединяйтесь',
                            'title' => 'MeetUp Комьюнити',
                            'description' => 'Регулярные ивенты для нетворкинга и отличного времяпровождения',
                        ],
                        'en' => [
                            'subtitle' => 'Join Us',
                            'title' => 'MeetUp Community',
                            'description' => 'Regular events for networking and great time',
                        ],
                        'az' => [
                            'subtitle' => 'Qoşulun',
                            'title' => 'MeetUp İcması',
                            'description' => 'Networking və əla vaxt keçirmək üçün müntəzəm tədbirlər',
                        ],
                    ],
                    'testimonials' => [
                        'ru' => [
                            'subtitle' => 'Отзывы',
                            'title' => 'Что говорят клиенты',
                        ],
                        'en' => [
                            'subtitle' => 'Testimonials',
                            'title' => 'What Clients Say',
                        ],
                        'az' => [
                            'subtitle' => 'Rəylər',
                            'title' => 'Müştərilər nə deyir',
                        ],
                    ],
                    'cta' => [
                        'ru' => [
                            'subtitle' => 'Готовы начать?',
                            'title' => 'Давайте создадим ваше идеальное мероприятие',
                            'description' => 'Свяжитесь с нами сегодня, и мы поможем воплотить ваши идеи в реальность',
                            'button' => 'Обсудить проект',
                        ],
                        'en' => [
                            'subtitle' => 'Ready to Start?',
                            'title' => 'Let\'s create your perfect event',
                            'description' => 'Contact us today and we will help bring your ideas to life',
                            'button' => 'Discuss Project',
                        ],
                        'az' => [
                            'subtitle' => 'Başlamağa hazırsınız?',
                            'title' => 'İdeal tədbirinizi yaradaq',
                            'description' => 'Bu gün bizimlə əlaqə saxlayın, ideyalarınızı həyata keçirməyə kömək edəcəyik',
                            'button' => 'Layihəni müzakirə et',
                        ],
                    ],
                    'contact' => [
                        'phone' => '+994 50 123 45 67',
                        'email' => 'info@meetup.az',
                        'instagram' => 'https://instagram.com/meetup.az',
                        'facebook' => 'https://facebook.com/meetup.az',
                        'linkedin' => 'https://linkedin.com/company/meetup-az',
                        'whatsapp' => 'https://wa.me/994501234567',
                        'ru' => [
                            'subtitle' => 'Контакты',
                            'title' => 'Свяжитесь с нами',
                            'description' => 'Расскажите о вашем мероприятии, и мы подготовим индивидуальное предложение',
                            'address_label' => 'Адрес',
                            'address' => 'Баку, Азербайджан',
                            'phone_label' => 'Телефон',
                            'email_label' => 'Email',
                            'form_name' => 'Имя',
                            'form_name_placeholder' => 'Ваше имя',
                            'form_phone' => 'Телефон',
                            'form_email' => 'Email',
                            'form_event_type' => 'Тип мероприятия',
                            'form_event_placeholder' => 'Выберите тип',
                            'form_event_corporate' => 'Корпоративное мероприятие',
                            'form_event_wedding' => 'Свадьба',
                            'form_event_birthday' => 'День рождения / Юбилей',
                            'form_event_conference' => 'Конференция',
                            'form_event_networking' => 'Нетворкинг',
                            'form_event_other' => 'Другое',
                            'form_message' => 'Сообщение',
                            'form_message_placeholder' => 'Расскажите о вашем мероприятии...',
                            'form_submit' => 'Отправить заявку',
                        ],
                        'en' => [
                            'subtitle' => 'Contact',
                            'title' => 'Get in Touch',
                            'description' => 'Tell us about your event and we will prepare a personalized offer',
                            'address_label' => 'Address',
                            'address' => 'Baku, Azerbaijan',
                            'phone_label' => 'Phone',
                            'email_label' => 'Email',
                            'form_name' => 'Name',
                            'form_name_placeholder' => 'Your name',
                            'form_phone' => 'Phone',
                            'form_email' => 'Email',
                            'form_event_type' => 'Event Type',
                            'form_event_placeholder' => 'Select type',
                            'form_event_corporate' => 'Corporate Event',
                            'form_event_wedding' => 'Wedding',
                            'form_event_birthday' => 'Birthday / Anniversary',
                            'form_event_conference' => 'Conference',
                            'form_event_networking' => 'Networking',
                            'form_event_other' => 'Other',
                            'form_message' => 'Message',
                            'form_message_placeholder' => 'Tell us about your event...',
                            'form_submit' => 'Submit',
                        ],
                        'az' => [
                            'subtitle' => 'Əlaqə',
                            'title' => 'Bizimlə əlaqə',
                            'description' => 'Tədbiriniz haqqında danışın, fərdi təklif hazırlayacağıq',
                            'address_label' => 'Ünvan',
                            'address' => 'Bakı, Azərbaycan',
                            'phone_label' => 'Telefon',
                            'email_label' => 'Email',
                            'form_name' => 'Ad',
                            'form_name_placeholder' => 'Adınız',
                            'form_phone' => 'Telefon',
                            'form_email' => 'Email',
                            'form_event_type' => 'Tədbir növü',
                            'form_event_placeholder' => 'Növü seçin',
                            'form_event_corporate' => 'Korporativ tədbir',
                            'form_event_wedding' => 'Toy',
                            'form_event_birthday' => 'Ad günü / Yubiley',
                            'form_event_conference' => 'Konfrans',
                            'form_event_networking' => 'Networking',
                            'form_event_other' => 'Digər',
                            'form_message' => 'Mesaj',
                            'form_message_placeholder' => 'Tədbiriniz haqqında danışın...',
                            'form_submit' => 'Göndər',
                        ],
                    ],
                ],
                'seo' => [
                    'ru' => [
                        'title' => 'MEETUP - Event & Production | Баку',
                        'description' => 'Профессиональная организация мероприятий любого масштаба в Баку. От идеи до реализации — мы создаём впечатления.',
                    ],
                    'en' => [
                        'title' => 'MEETUP - Event & Production | Baku',
                        'description' => 'Professional event organization of any scale in Baku. From idea to implementation — we create impressions.',
                    ],
                    'az' => [
                        'title' => 'MEETUP - Event & Production | Bakı',
                        'description' => 'Bakıda istənilən miqyaslı tədbirlərin peşəkar təşkili. İdeyadan reallaşdırmaya qədər — biz təəssüratlar yaradırıq.',
                    ],
                ],
                'is_published' => true,
                'show_in_menu' => false,
                'sort_order' => 0,
            ]
        );
    }

    public function down(): void
    {
        Page::where('slug', 'home')
            ->where('template', 'home')
            ->delete();
    }
};
