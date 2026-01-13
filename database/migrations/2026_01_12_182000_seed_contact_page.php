<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Page;

return new class extends Migration
{
    public function up(): void
    {
        Page::updateOrCreate(
            ['slug' => 'contact', 'template' => 'contact'],
            [
                'translations' => [
                    'ru' => [
                        'name' => 'Контакты',
                        'hero_subtitle' => 'Свяжитесь с нами',
                        'hero_title' => 'Давайте создадим что-то невероятное вместе',
                        'hero_text' => 'Готовы обсудить ваш проект? Мы всегда рады новым идеям и сотрудничеству.',
                    ],
                    'en' => [
                        'name' => 'Contact',
                        'hero_subtitle' => 'Contact Us',
                        'hero_title' => 'Let\'s create something incredible together',
                        'hero_text' => 'Ready to discuss your project? We are always happy to hear new ideas and collaborate.',
                    ],
                    'az' => [
                        'name' => 'Əlaqə',
                        'hero_subtitle' => 'Bizimlə əlaqə',
                        'hero_title' => 'Gəlin birlikdə inanılmaz bir şey yaradaq',
                        'hero_text' => 'Layihənizi müzakirə etməyə hazırsınız? Yeni fikirləri eşitməkdən və əməkdaşlıqdan həmişə məmnunuq.',
                    ],
                ],
                'sections' => [
                    'form' => [
                        'ru' => [
                            'title' => 'Отправить сообщение',
                            'text' => 'Заполните форму и мы свяжемся с вами в ближайшее время',
                            'name_label' => 'Ваше имя',
                            'phone_label' => 'Ваш телефон',
                            'email_label' => 'Ваш email',
                            'service_label' => 'Тип мероприятия',
                            'message_label' => 'Ваше сообщение',
                            'submit_text' => 'Отправить заявку',
                        ],
                        'en' => [
                            'title' => 'Send a Message',
                            'text' => 'Fill out the form and we will get back to you soon',
                            'name_label' => 'Your name',
                            'phone_label' => 'Your phone',
                            'email_label' => 'Your email',
                            'service_label' => 'Event type',
                            'message_label' => 'Your message',
                            'submit_text' => 'Submit',
                        ],
                        'az' => [
                            'title' => 'Mesaj göndərin',
                            'text' => 'Formanı doldurun və tezliklə sizinlə əlaqə saxlayacağıq',
                            'name_label' => 'Adınız',
                            'phone_label' => 'Telefonunuz',
                            'email_label' => 'Emailiniz',
                            'service_label' => 'Tədbir növü',
                            'message_label' => 'Mesajınız',
                            'submit_text' => 'Göndər',
                        ],
                    ],
                    'info' => [
                        'phone_1' => '+994 12 555 55 55',
                        'phone_2' => '+994 50 555 55 55',
                        'email_1' => 'info@meetup.az',
                        'email_2' => 'events@meetup.az',
                        'ru' => [
                            'title' => 'Контактная информация',
                            'address' => 'ул. Низами, 123, офис 45, Баку, Азербайджан',
                            'hours' => "Пн-Пт: 09:00 - 18:00\nСб: 10:00 - 15:00",
                        ],
                        'en' => [
                            'title' => 'Contact Information',
                            'address' => '123 Nizami St., Office 45, Baku, Azerbaijan',
                            'hours' => "Mon-Fri: 09:00 - 18:00\nSat: 10:00 - 15:00",
                        ],
                        'az' => [
                            'title' => 'Əlaqə məlumatları',
                            'address' => 'Nizami küç. 123, ofis 45, Bakı, Azərbaycan',
                            'hours' => "B.e-Cümə: 09:00 - 18:00\nŞənbə: 10:00 - 15:00",
                        ],
                    ],
                    'social' => [
                        'instagram' => 'https://instagram.com/meetup.az',
                        'facebook' => 'https://facebook.com/meetup.az',
                        'linkedin' => 'https://linkedin.com/company/meetup-az',
                        'youtube' => 'https://youtube.com/@meetup.az',
                        'whatsapp' => 'https://wa.me/994505555555',
                        'telegram' => 'https://t.me/meetup_az',
                    ],
                    'map' => [
                        'embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3039.4194744367894!2d49.8506!3d40.3775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDIyJzM5LjAiTiA0OcKwNTEnMDIuMiJF!5e0!3m2!1sen!2s!4v1234567890',
                        'google_maps_link' => 'https://goo.gl/maps/example',
                        'ru' => [
                            'office_title' => 'Главный офис',
                            'office_address' => 'ул. Низами, 123, офис 45',
                        ],
                        'en' => [
                            'office_title' => 'Main Office',
                            'office_address' => '123 Nizami St., Office 45',
                        ],
                        'az' => [
                            'office_title' => 'Baş ofis',
                            'office_address' => 'Nizami küç. 123, ofis 45',
                        ],
                    ],
                    'faq' => [
                        'ru' => [
                            'title' => 'Часто задаваемые вопросы',
                        ],
                        'en' => [
                            'title' => 'Frequently Asked Questions',
                        ],
                        'az' => [
                            'title' => 'Tez-tez verilən suallar',
                        ],
                        'items' => [
                            [
                                'question_ru' => 'Как быстро вы отвечаете на заявки?',
                                'question_en' => 'How quickly do you respond to inquiries?',
                                'question_az' => 'Müraciətlərə nə qədər tez cavab verirsiniz?',
                                'answer_ru' => 'Мы стараемся отвечать на все заявки в течение 24 часов. В срочных случаях вы можете позвонить нам напрямую.',
                                'answer_en' => 'We try to respond to all inquiries within 24 hours. In urgent cases, you can call us directly.',
                                'answer_az' => 'Bütün müraciətlərə 24 saat ərzində cavab verməyə çalışırıq. Təcili hallarda birbaşa bizə zəng edə bilərsiniz.',
                            ],
                            [
                                'question_ru' => 'За сколько времени нужно бронировать мероприятие?',
                                'question_en' => 'How far in advance should I book an event?',
                                'question_az' => 'Tədbiri nə qədər əvvəldən sifariş etməliyəm?',
                                'answer_ru' => 'Рекомендуем бронировать за 2-3 месяца для крупных мероприятий и за 2-4 недели для небольших событий.',
                                'answer_en' => 'We recommend booking 2-3 months in advance for large events and 2-4 weeks for smaller events.',
                                'answer_az' => 'Böyük tədbirlər üçün 2-3 ay, kiçik tədbirlər üçün isə 2-4 həftə əvvəl sifariş verməyi tövsiyə edirik.',
                            ],
                            [
                                'question_ru' => 'В каких городах вы работаете?',
                                'question_en' => 'In which cities do you operate?',
                                'question_az' => 'Hansı şəhərlərdə işləyirsiniz?',
                                'answer_ru' => 'Мы работаем по всему Азербайджану, с основным офисом в Баку. Также выезжаем в другие страны по запросу.',
                                'answer_en' => 'We operate throughout Azerbaijan, with our main office in Baku. We also travel to other countries upon request.',
                                'answer_az' => 'Bütün Azərbaycan ərazisində işləyirik, əsas ofisimiz Bakıdadır. Tələb əsasında digər ölkələrə də gedirik.',
                            ],
                            [
                                'question_ru' => 'Какой минимальный бюджет для мероприятия?',
                                'question_en' => 'What is the minimum budget for an event?',
                                'question_az' => 'Tədbir üçün minimum büdcə nə qədərdir?',
                                'answer_ru' => 'Бюджет зависит от типа и масштаба мероприятия. Свяжитесь с нами для обсуждения вашего проекта и получения индивидуального предложения.',
                                'answer_en' => 'The budget depends on the type and scale of the event. Contact us to discuss your project and receive a personalized offer.',
                                'answer_az' => 'Büdcə tədbirin növündən və miqyasından asılıdır. Layihənizi müzakirə etmək və fərdi təklif almaq üçün bizimlə əlaqə saxlayın.',
                            ],
                        ],
                    ],
                ],
                'seo' => [
                    'ru' => [
                        'title' => 'Контакты - MEETUP Event & Production',
                        'description' => 'Свяжитесь с нами для организации вашего мероприятия. Адрес, телефоны, email и форма обратной связи.',
                    ],
                    'en' => [
                        'title' => 'Contact - MEETUP Event & Production',
                        'description' => 'Contact us to organize your event. Address, phones, email and contact form.',
                    ],
                    'az' => [
                        'title' => 'Əlaqə - MEETUP Event & Production',
                        'description' => 'Tədbirinizi təşkil etmək üçün bizimlə əlaqə saxlayın. Ünvan, telefonlar, email və əlaqə forması.',
                    ],
                ],
                'is_published' => true,
                'show_in_menu' => true,
                'sort_order' => 20,
            ]
        );
    }

    public function down(): void
    {
        Page::where('slug', 'contact')
            ->where('template', 'contact')
            ->delete();
    }
};
