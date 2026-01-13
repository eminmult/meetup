<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pages')->insert([
            'slug' => 'about',
            'template' => 'about',
            'translations' => json_encode([
                'ru' => [
                    'title' => 'О нас',
                    'hero_subtitle' => 'О компании',
                    'hero_title' => 'Мы создаём<br>незабываемые моменты',
                    'hero_text' => 'MEETUP — это команда профессионалов, влюблённых в своё дело. Мы превращаем ваши идеи в яркие события, которые запоминаются на всю жизнь.',
                    'video_btn' => 'Смотреть презентацию',
                    'scroll_text' => 'Листайте вниз',
                ],
                'en' => [
                    'title' => 'About Us',
                    'hero_subtitle' => 'About Company',
                    'hero_title' => 'We create<br>unforgettable moments',
                    'hero_text' => 'MEETUP is a team of professionals who love what they do. We turn your ideas into bright events that are remembered for a lifetime.',
                    'video_btn' => 'Watch presentation',
                    'scroll_text' => 'Scroll down',
                ],
                'az' => [
                    'title' => 'Haqqımızda',
                    'hero_subtitle' => 'Şirkət haqqında',
                    'hero_title' => 'Unudulmaz anlar<br>yaradırıq',
                    'hero_text' => 'MEETUP işini sevən peşəkarlar komandasıdır. İdeyalarınızı ömür boyu yadda qalan parlaq tədbirlərə çeviririk.',
                    'video_btn' => 'Təqdimatı izlə',
                    'scroll_text' => 'Aşağı sürüşdürün',
                ],
            ]),
            'sections' => json_encode([
                'hero' => [
                    'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                ],
                'story' => [
                    'year' => '2018',
                    'ru' => [
                        'subtitle' => 'Наша история',
                        'title' => 'От идеи до успешного агентства',
                        'text_1' => 'Всё началось с простой идеи — создавать мероприятия, которые люди будут помнить годами. В 2018 году мы организовали свой первый корпоратив, и с тех пор не останавливаемся.',
                        'text_2' => 'Сегодня MEETUP — это полноценное event-агентство с командой из 25+ специалистов. Мы провели более 500 мероприятий и сделали счастливыми тысячи гостей по всему Азербайджану.',
                    ],
                    'en' => [
                        'subtitle' => 'Our Story',
                        'title' => 'From idea to successful agency',
                        'text_1' => 'It all started with a simple idea — to create events that people would remember for years. In 2018, we organized our first corporate event, and we have not stopped since.',
                        'text_2' => 'Today MEETUP is a full-fledged event agency with a team of 25+ specialists. We have held more than 500 events and made thousands of guests happy across Azerbaijan.',
                    ],
                    'az' => [
                        'subtitle' => 'Bizim hekayə',
                        'title' => 'İdeyadan uğurlu agentliyə',
                        'text_1' => 'Hər şey sadə bir fikirləntdi başladı — insanların illər boyu xatırlayacağı tədbirlər yaratmaq. 2018-ci ildə ilk korporativ tədbirimizi təşkil etdik və o vaxtdan bəri dayanmırıq.',
                        'text_2' => 'Bu gün MEETUP 25+ mütəxəssisdən ibarət komanda ilə tam hüquqlu event agentliyidir. 500-dən çox tədbir keçirdik və Azərbaycan üzrə minlərlə qonağı xoşbəxt etdik.',
                    ],
                    'highlights' => [
                        ['icon' => 'users', 'number' => '25+', 'label_ru' => 'специалистов', 'label_en' => 'specialists', 'label_az' => 'mütəxəssis', 'sublabel_ru' => 'Команда профессионалов', 'sublabel_en' => 'Team of professionals', 'sublabel_az' => 'Peşəkarlar komandası'],
                        ['icon' => 'layers', 'number' => '500+', 'label_ru' => 'мероприятий', 'label_en' => 'events', 'label_az' => 'tədbir', 'sublabel_ru' => 'Успешно проведённых', 'sublabel_en' => 'Successfully held', 'sublabel_az' => 'Uğurla keçirilmiş'],
                        ['icon' => 'award', 'number' => '7', 'label_ru' => 'лет опыта', 'label_en' => 'years of experience', 'label_az' => 'il təcrübə', 'sublabel_ru' => 'На рынке событий', 'sublabel_en' => 'In the event market', 'sublabel_az' => 'Tədbir bazarında'],
                        ['icon' => 'heart', 'number' => '98%', 'label_ru' => 'довольных', 'label_en' => 'satisfied', 'label_az' => 'məmnun', 'sublabel_ru' => 'Клиентов возвращаются', 'sublabel_en' => 'Clients return', 'sublabel_az' => 'Müştərilər qayıdır'],
                    ],
                ],
                'mission' => [
                    'ru' => [
                        'subtitle' => 'Философия',
                        'title' => 'Миссия, видение, цель',
                        'mission_title' => 'Миссия',
                        'mission_text' => 'Создавать пространства для значимых встреч и эмоций, объединяя людей через незабываемые события.',
                        'vision_title' => 'Видение',
                        'vision_text' => 'Стать ведущим event-агентством в регионе, задающим стандарты качества и креативности в индустрии.',
                        'goal_title' => 'Цель',
                        'goal_text' => 'Превосходить ожидания клиентов на каждом этапе, делая процесс организации таким же приятным, как само событие.',
                    ],
                    'en' => [
                        'subtitle' => 'Philosophy',
                        'title' => 'Mission, Vision, Goal',
                        'mission_title' => 'Mission',
                        'mission_text' => 'Create spaces for meaningful meetings and emotions, uniting people through unforgettable events.',
                        'vision_title' => 'Vision',
                        'vision_text' => 'Become the leading event agency in the region, setting standards of quality and creativity in the industry.',
                        'goal_title' => 'Goal',
                        'goal_text' => 'Exceed client expectations at every stage, making the organization process as pleasant as the event itself.',
                    ],
                    'az' => [
                        'subtitle' => 'Fəlsəfə',
                        'title' => 'Missiya, Vizyon, Məqsəd',
                        'mission_title' => 'Missiya',
                        'mission_text' => 'Unudulmaz tədbirlər vasitəsilə insanları birləşdirərək, mənalı görüşlər və emosiyalar üçün məkanlar yaratmaq.',
                        'vision_title' => 'Vizyon',
                        'vision_text' => 'Sənayedə keyfiyyət və yaradıcılıq standartlarını müəyyən edərək, regionda aparıcı tədbir agentliyinə çevrilmək.',
                        'goal_title' => 'Məqsəd',
                        'goal_text' => 'Hər mərhələdə müştəri gözləntilərini aşaraq, təşkilat prosesini tədbirin özü qədər xoş etmək.',
                    ],
                ],
                'values' => [
                    'ru' => ['subtitle' => 'Принципы работы', 'title' => 'Наши ценности'],
                    'en' => ['subtitle' => 'Work Principles', 'title' => 'Our Values'],
                    'az' => ['subtitle' => 'İş prinsipləri', 'title' => 'Dəyərlərimiz'],
                    'items' => [
                        ['title_ru' => 'Внимание к деталям', 'title_en' => 'Attention to Detail', 'title_az' => 'Detallara diqqət', 'text_ru' => 'Каждая мелочь имеет значение. Мы продумываем всё до последнего штриха.', 'text_en' => 'Every little thing matters. We think through everything to the last detail.', 'text_az' => 'Hər kiçik şeyin əhəmiyyəti var. Hər şeyi son detala qədər düşünürük.'],
                        ['title_ru' => 'Креативность', 'title_en' => 'Creativity', 'title_az' => 'Kreativlik', 'text_ru' => 'Уникальные идеи и нестандартные решения — наша визитная карточка.', 'text_en' => 'Unique ideas and non-standard solutions are our calling card.', 'text_az' => 'Unikal ideyalar və qeyri-standart həllər bizim vizit kartımızdır.'],
                        ['title_ru' => 'Ответственность', 'title_en' => 'Responsibility', 'title_az' => 'Məsuliyyət', 'text_ru' => 'Берём на себя полную ответственность за результат каждого проекта.', 'text_en' => 'We take full responsibility for the result of each project.', 'text_az' => 'Hər layihənin nəticəsinə görə tam məsuliyyət daşıyırıq.'],
                        ['title_ru' => 'Партнёрство', 'title_en' => 'Partnership', 'title_az' => 'Tərəfdaşlıq', 'text_ru' => 'Строим долгосрочные отношения с клиентами и подрядчиками.', 'text_en' => 'We build long-term relationships with clients and contractors.', 'text_az' => 'Müştərilər və podratçılarla uzunmüddətli əlaqələr qururuq.'],
                    ],
                ],
                'gallery' => [
                    'ru' => ['subtitle' => 'Галерея', 'title' => 'Моменты из жизни MEETUP'],
                    'en' => ['subtitle' => 'Gallery', 'title' => 'Moments from MEETUP life'],
                    'az' => ['subtitle' => 'Qalereya', 'title' => 'MEETUP həyatından anlar'],
                    'items' => [
                        ['image_url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800', 'caption_ru' => 'Корпоративная конференция', 'caption_en' => 'Corporate Conference', 'caption_az' => 'Korporativ konfrans'],
                        ['image_url' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=600', 'caption_ru' => 'Бизнес нетворкинг', 'caption_en' => 'Business Networking', 'caption_az' => 'Biznes şəbəkələşmə'],
                        ['image_url' => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?w=600', 'caption_ru' => 'Праздничная вечеринка', 'caption_en' => 'Celebration Party', 'caption_az' => 'Bayram ziyafəti'],
                        ['image_url' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=600', 'caption_ru' => 'Свадебное торжество', 'caption_en' => 'Wedding Celebration', 'caption_az' => 'Toy mərasimi'],
                        ['image_url' => 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?w=600', 'caption_ru' => 'Музыкальный фестиваль', 'caption_en' => 'Music Festival', 'caption_az' => 'Musiqi festivalı'],
                        ['image_url' => 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=600', 'caption_ru' => 'Корпоратив на природе', 'caption_en' => 'Outdoor Corporate Event', 'caption_az' => 'Açıq havada korporativ'],
                    ],
                ],
                'timeline' => [
                    'ru' => ['subtitle' => 'Путь развития', 'title' => 'Наша история'],
                    'en' => ['subtitle' => 'Development Path', 'title' => 'Our History'],
                    'az' => ['subtitle' => 'İnkişaf yolu', 'title' => 'Tariximiz'],
                    'items' => [
                        ['year' => '2018', 'title_ru' => 'Начало пути', 'title_en' => 'The Beginning', 'title_az' => 'Başlanğıc', 'text_ru' => 'Основание компании. Первый корпоратив на 50 человек. Команда из 3 энтузиастов.', 'text_en' => 'Company founding. First corporate event for 50 people. Team of 3 enthusiasts.', 'text_az' => 'Şirkətin təsisi. 50 nəfərlik ilk korporativ tədbir. 3 həvəskardan ibarət komanda.'],
                        ['year' => '2019', 'title_ru' => 'Рост и развитие', 'title_en' => 'Growth and Development', 'title_az' => 'Böyümə və inkişaf', 'text_ru' => 'Расширение услуг. Первая крупная свадьба на 300 гостей. Открытие собственного офиса.', 'text_en' => 'Service expansion. First large wedding for 300 guests. Opening our own office.', 'text_az' => 'Xidmətlərin genişlənməsi. 300 qonaq üçün ilk böyük toy. Öz ofisimizin açılışı.'],
                        ['year' => '2021', 'title_ru' => 'Новые горизонты', 'title_en' => 'New Horizons', 'title_az' => 'Yeni üfüqlər', 'text_ru' => 'Запуск онлайн-мероприятий. Партнёрство с крупными брендами. Команда выросла до 15 человек.', 'text_en' => 'Launch of online events. Partnership with major brands. Team grew to 15 people.', 'text_az' => 'Onlayn tədbirlərin başlaması. Böyük brendlərlə tərəfdaşlıq. Komanda 15 nəfərə çatdı.'],
                        ['year' => '2023', 'title_ru' => 'Признание рынка', 'title_en' => 'Market Recognition', 'title_az' => 'Bazarın tanınması', 'text_ru' => '500+ успешных мероприятий. Награда «Лучшее event-агентство года». Команда из 25+ специалистов.', 'text_en' => '500+ successful events. "Best Event Agency of the Year" award. Team of 25+ specialists.', 'text_az' => '500+ uğurlu tədbir. "İlin ən yaxşı tədbir agentliyi" mükafatı. 25+ mütəxəssisdən ibarət komanda.'],
                        ['year' => '2025', 'title_ru' => 'Сегодня', 'title_en' => 'Today', 'title_az' => 'Bu gün', 'text_ru' => 'Лидер рынка event-услуг в Азербайджане. Международные проекты. Инновационные форматы мероприятий.', 'text_en' => 'Leader of the event services market in Azerbaijan. International projects. Innovative event formats.', 'text_az' => 'Azərbaycanda tədbir xidmətləri bazarının lideri. Beynəlxalq layihələr. İnnovativ tədbir formatları.'],
                    ],
                ],
                'cta' => [
                    'ru' => ['title' => 'Готовы создать что-то особенное?', 'text' => 'Давайте обсудим ваше мероприятие и сделаем его незабываемым вместе', 'btn_text' => 'Связаться с нами'],
                    'en' => ['title' => 'Ready to create something special?', 'text' => 'Let\'s discuss your event and make it unforgettable together', 'btn_text' => 'Contact us'],
                    'az' => ['title' => 'Xüsusi bir şey yaratmağa hazırsınız?', 'text' => 'Tədbirinizi müzakirə edək və birlikdə unudulmaz edək', 'btn_text' => 'Bizimlə əlaqə'],
                ],
            ]),
            'seo' => json_encode([
                'ru' => ['title' => 'О нас - MEETUP Event & Production | Баку', 'description' => 'MEETUP — команда профессионалов, влюблённых в своё дело. Мы превращаем ваши идеи в яркие события, которые запоминаются на всю жизнь.'],
                'en' => ['title' => 'About Us - MEETUP Event & Production | Baku', 'description' => 'MEETUP is a team of professionals who love what they do. We turn your ideas into bright events that are remembered for a lifetime.'],
                'az' => ['title' => 'Haqqımızda - MEETUP Event & Production | Bakı', 'description' => 'MEETUP işini sevən peşəkarlar komandasıdır. İdeyalarınızı ömür boyu yadda qalan parlaq tədbirlərə çeviririk.'],
            ]),
            'is_published' => true,
            'show_in_menu' => true,
            'sort_order' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('pages')->where('slug', 'about')->delete();
    }
};
