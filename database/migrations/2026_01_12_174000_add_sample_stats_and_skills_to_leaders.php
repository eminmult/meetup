<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update Eldar Mamedov (first leader)
        DB::table('team_members')
            ->where('slug', 'eldar-mamedov')
            ->update([
                'stats' => json_encode([
                    ['number' => '15+', 'label' => 'Лет опыта'],
                    ['number' => '500+', 'label' => 'Мероприятий'],
                    ['number' => '50+', 'label' => 'Наград'],
                ]),
                'skills' => json_encode([
                    ['icon' => 'layers', 'title' => 'Стратегическое планирование', 'description' => 'Разработка комплексных стратегий для мероприятий любого масштаба'],
                    ['icon' => 'users', 'title' => 'Лидерство', 'description' => 'Построение и развитие высокоэффективных команд'],
                    ['icon' => 'globe', 'title' => 'Международный опыт', 'description' => 'Работа с клиентами и партнёрами по всему миру'],
                    ['icon' => 'star', 'title' => 'Креативное мышление', 'description' => 'Создание уникальных концепций и нестандартных решений'],
                ]),
                'translations' => json_encode([
                    'ru' => [
                        'name' => 'Эльдар Мамедов',
                        'position' => 'Основатель & CEO',
                        'bio' => 'Эльдар основал MEETUP в 2010 году с простой миссией — создавать мероприятия, которые меняют жизни. За эти годы под его руководством команда провела более 500 успешных проектов: от камерных свадеб до международных конференций на тысячи участников.

Выпускник London School of Economics, Эльдар привнёс в event-индустрию Азербайджана международные стандарты качества. Его философия проста: каждое мероприятие должно рассказывать историю и оставлять след в сердцах гостей.',
                        'tagline' => 'Превращаю идеи в незабываемые события уже 15 лет',
                    ],
                    'en' => [
                        'name' => 'Eldar Mammadov',
                        'position' => 'Founder & CEO',
                        'bio' => 'Eldar founded MEETUP in 2010 with a simple mission — to create events that change lives. Over the years, under his leadership, the team has delivered more than 500 successful projects: from intimate weddings to international conferences with thousands of attendees.

A graduate of London School of Economics, Eldar brought international quality standards to Azerbaijan\'s event industry. His philosophy is simple: every event should tell a story and leave a mark in guests\' hearts.',
                        'tagline' => 'Turning ideas into unforgettable events for 15 years',
                    ],
                    'az' => [
                        'name' => 'Eldar Məmmədov',
                        'position' => 'Təsisçi & CEO',
                        'bio' => 'Eldar 2010-cu ildə MEETUP-u sadə bir missiya ilə qurdu — həyatları dəyişdirən tədbirlər yaratmaq. Bu illər ərzində onun rəhbərliyi altında komanda 500-dən çox uğurlu layihə həyata keçirdi: intim toylardan minlərlə iştirakçı ilə beynəlxalq konfranslara qədər.

London School of Economics məzunu olan Eldar Azərbaycanın tədbir sektoruna beynəlxalq keyfiyyət standartlarını gətirdi. Onun fəlsəfəsi sadədir: hər tədbir bir hekayə danışmalı və qonaqların qəlbində iz buraxmalıdır.',
                        'tagline' => '15 ildir ideyaları unudulmaz tədbirlərə çevirirəm',
                    ],
                ]),
            ]);

        // Update Leyla Hasanova (second leader)
        DB::table('team_members')
            ->where('slug', 'leyla-hasanova')
            ->update([
                'stats' => json_encode([
                    ['number' => '12+', 'label' => 'Лет опыта'],
                    ['number' => '300+', 'label' => 'Проектов'],
                    ['number' => '30+', 'label' => 'Наград'],
                ]),
                'skills' => json_encode([
                    ['icon' => 'star', 'title' => 'Креативное видение', 'description' => 'Создание уникальных визуальных концепций'],
                    ['icon' => 'heart', 'title' => 'Внимание к деталям', 'description' => 'Безупречное исполнение каждого элемента'],
                    ['icon' => 'target', 'title' => 'Работа с брендами', 'description' => 'Интеграция корпоративной идентичности'],
                ]),
                'translations' => json_encode([
                    'ru' => [
                        'name' => 'Лейла Гасанова',
                        'position' => 'Креативный директор',
                        'bio' => 'Лейла отвечает за творческое направление MEETUP с 2012 года. Под её руководством каждое мероприятие превращается в уникальное художественное произведение.

Её подход сочетает эстетику и функциональность, создавая пространства, которые не только красивы, но и удобны для гостей.',
                        'tagline' => 'Красота в деталях, магия в целом',
                    ],
                    'en' => [
                        'name' => 'Leyla Hasanova',
                        'position' => 'Creative Director',
                        'bio' => 'Leyla has been heading the creative direction at MEETUP since 2012. Under her leadership, every event transforms into a unique work of art.

Her approach combines aesthetics and functionality, creating spaces that are not only beautiful but also comfortable for guests.',
                        'tagline' => 'Beauty in details, magic in the whole',
                    ],
                    'az' => [
                        'name' => 'Leyla Həsənova',
                        'position' => 'Kreativ Direktor',
                        'bio' => 'Leyla 2012-ci ildən MEETUP-un kreativ istiqamətinə rəhbərlik edir. Onun rəhbərliyi altında hər tədbir unikal sənət əsərinə çevrilir.

Onun yanaşması estetikanı funksionallıqla birləşdirir, yalnız gözəl deyil, həm də qonaqlar üçün rahat məkanlar yaradır.',
                        'tagline' => 'Detallarda gözəllik, bütövdə sehrlik',
                    ],
                ]),
            ]);

        // Update Rashad Aliyev (third leader)
        DB::table('team_members')
            ->where('slug', 'rashad-aliyev')
            ->update([
                'stats' => json_encode([
                    ['number' => '10+', 'label' => 'Лет опыта'],
                    ['number' => '200+', 'label' => 'Проектов'],
                ]),
                'skills' => json_encode([
                    ['icon' => 'briefcase', 'title' => 'Техническое производство', 'description' => 'Управление сложными техническими проектами'],
                    ['icon' => 'zap', 'title' => 'Решение проблем', 'description' => 'Быстрое реагирование на любые ситуации'],
                    ['icon' => 'compass', 'title' => 'Логистика', 'description' => 'Координация всех аспектов производства'],
                ]),
                'translations' => json_encode([
                    'ru' => [
                        'name' => 'Рашад Алиев',
                        'position' => 'Директор по производству',
                        'bio' => 'Рашад обеспечивает безупречную реализацию всех технических аспектов мероприятий. От света и звука до сценических конструкций — всё под его контролем.

Его опыт работы на международных концертах и фестивалях гарантирует высочайшее качество исполнения.',
                        'tagline' => 'Технологии на службе искусства',
                    ],
                    'en' => [
                        'name' => 'Rashad Aliyev',
                        'position' => 'Production Director',
                        'bio' => 'Rashad ensures flawless execution of all technical aspects of events. From lighting and sound to stage structures — everything is under his control.

His experience working on international concerts and festivals guarantees the highest quality of execution.',
                        'tagline' => 'Technology at the service of art',
                    ],
                    'az' => [
                        'name' => 'Rəşad Əliyev',
                        'position' => 'İstehsal Direktoru',
                        'bio' => 'Rəşad tədbirlərin bütün texniki aspektlərinin qüsursuz icrasını təmin edir. İşıqlandırma və səsdən səhnə konstruksiyalarına qədər — hər şey onun nəzarəti altındadır.

Beynəlxalq konsertlər və festivallarda işləmə təcrübəsi ən yüksək icra keyfiyyətinə zəmanət verir.',
                        'tagline' => 'Sənətin xidmətində texnologiyalar',
                    ],
                ]),
            ]);
    }

    public function down(): void
    {
        DB::table('team_members')
            ->whereIn('slug', ['eldar-mamedov', 'leyla-hasanova', 'rashad-aliyev'])
            ->update([
                'stats' => null,
                'skills' => null,
            ]);
    }
};
