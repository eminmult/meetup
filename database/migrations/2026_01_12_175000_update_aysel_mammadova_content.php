<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('team_members')
            ->where('slug', 'aysel-mammadova')
            ->update([
                'stats' => json_encode([
                    ['number' => '12+', 'label' => 'Лет в индустрии'],
                    ['number' => '350+', 'label' => 'Проектов'],
                    ['number' => '25+', 'label' => 'Наград'],
                    ['number' => '50+', 'label' => 'Брендов'],
                ]),
                'skills' => json_encode([
                    ['icon' => 'star', 'title' => 'Визуальный дизайн', 'description' => 'Создание уникальных визуальных концепций и эстетики мероприятий'],
                    ['icon' => 'layers', 'title' => 'Арт-дирекшн', 'description' => 'Управление творческим процессом от идеи до реализации'],
                    ['icon' => 'heart', 'title' => 'Декор и стилистика', 'description' => 'Продуманные до мелочей декорации и флористика'],
                    ['icon' => 'compass', 'title' => 'Тренды и инновации', 'description' => 'Интеграция мировых трендов в локальные проекты'],
                ]),
                'translations' => json_encode([
                    'ru' => [
                        'name' => 'Айсель Мамедова',
                        'position' => 'Креативный Директор',
                        'tagline' => 'Превращаю пространства в произведения искусства',
                        'bio' => 'Айсель — сердце творческого отдела MEETUP. Выпускница Академии Художеств с дипломом в области дизайна интерьера, она привносит в каждый проект уникальное видение и безупречный вкус.

За 12 лет в event-индустрии Айсель создала визуальные концепции для более чем 350 мероприятий — от роскошных свадеб в бакинских дворцах до корпоративных событий международных брендов. Её работы отличает внимание к деталям и способность создавать атмосферу, которая полностью погружает гостей в задуманную историю.

Айсель постоянно следит за мировыми трендами в дизайне и декоре, регулярно посещает международные выставки и мастер-классы. Её философия проста: каждое мероприятие — это холст, а каждый элемент декора — мазок кисти, создающий общую картину.

Среди её работ — оформление свадеб для известных азербайджанских семей, корпоративные мероприятия для SOCAR, BP, и Visa, а также уникальные концептуальные проекты, получившие признание на международных конкурсах event-дизайна.',
                    ],
                    'en' => [
                        'name' => 'Aysel Mammadova',
                        'position' => 'Creative Director',
                        'tagline' => 'Transforming spaces into works of art',
                        'bio' => 'Aysel is the heart of MEETUP\'s creative department. A graduate of the Academy of Arts with a degree in interior design, she brings a unique vision and impeccable taste to every project.

Over 12 years in the event industry, Aysel has created visual concepts for more than 350 events — from luxurious weddings in Baku palaces to corporate events for international brands. Her work is distinguished by attention to detail and the ability to create an atmosphere that fully immerses guests in the intended story.

Aysel constantly follows global trends in design and décor, regularly attending international exhibitions and masterclasses. Her philosophy is simple: every event is a canvas, and every décor element is a brushstroke creating the overall picture.

Among her works are wedding designs for prominent Azerbaijani families, corporate events for SOCAR, BP, and Visa, as well as unique conceptual projects that have received recognition at international event design competitions.',
                    ],
                    'az' => [
                        'name' => 'Aysel Məmmədova',
                        'position' => 'Kreativ Direktor',
                        'tagline' => 'Məkanları sənət əsərlərinə çevirirəm',
                        'bio' => 'Aysel MEETUP-un yaradıcı şöbəsinin ürəyidir. İnteryer dizaynı üzrə diplomu olan Rəssamlıq Akademiyasının məzunu olaraq, hər layihəyə unikal baxış və qüsursuz zövq gətirir.

Event sektorunda 12 ildən artıq təcrübəsi ilə Aysel 350-dən çox tədbir üçün vizual konsepsiyalar yaradıb — Bakı saraylarında dəbdəbəli toylardan beynəlxalq brendlər üçün korporativ tədbirlərə qədər. Onun işləri detallara diqqət və qonaqları nəzərdə tutulan hekayəyə tam şəkildə cəlb edən atmosfer yaratmaq bacarığı ilə seçilir.

Aysel daim dizayn və dekorda qlobal trendləri izləyir, mütəmadi olaraq beynəlxalq sərgilərə və master-klaslara qatılır. Onun fəlsəfəsi sadədir: hər tədbir bir kətandır və hər dekor elementi ümumi mənzərəni yaradan fırça vuruşudur.

Onun işləri arasında tanınmış Azərbaycan ailələri üçün toy dizaynları, SOCAR, BP və Visa üçün korporativ tədbirlər, eləcə də beynəlxalq tədbir dizaynı müsabiqələrində tanınma qazanmış unikal konseptual layihələr var.',
                    ],
                ]),
                'social_links' => json_encode([
                    ['platform' => 'instagram', 'url' => 'https://instagram.com/aysel.mammadova.design'],
                    ['platform' => 'linkedin', 'url' => 'https://linkedin.com/in/ayselmammadova'],
                    ['platform' => 'facebook', 'url' => 'https://facebook.com/ayselmammadova.meetup'],
                ]),
            ]);
    }

    public function down(): void
    {
        // Revert to original short bio
        DB::table('team_members')
            ->where('slug', 'aysel-mammadova')
            ->update([
                'stats' => null,
                'skills' => null,
            ]);
    }
};
