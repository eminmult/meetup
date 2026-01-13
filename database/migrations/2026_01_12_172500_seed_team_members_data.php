<?php

use App\Models\TeamMember;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Update existing members as leaders
        TeamMember::whereIn('slug', ['elvin-gasimov', 'aysel-mammadova', 'rashad-aliyev'])
            ->update(['is_leader' => true]);

        // Add bio to existing leaders
        TeamMember::where('slug', 'elvin-gasimov')->update([
            'bio' => '15 лет опыта в event-индустрии. Создал более 500 успешных мероприятий по всему Кавказу.',
        ]);

        TeamMember::where('slug', 'aysel-mammadova')->update([
            'bio' => 'Художник по образованию, визионер по призванию. Отвечает за уникальный стиль каждого мероприятия.',
        ]);

        TeamMember::where('slug', 'rashad-aliyev')->update([
            'bio' => 'Инженер с душой организатора. Обеспечивает техническое совершенство каждого проекта.',
        ]);

        // Add regular team members
        $members = [
            [
                'name' => 'Айсель Керимова',
                'slug' => 'aysel-kerimova',
                'position' => 'Event-менеджер',
                'is_published' => true,
                'is_leader' => false,
                'sort_order' => 10,
                'translations' => [
                    'ru' => ['name' => 'Айсель Керимова', 'position' => 'Event-менеджер'],
                    'en' => ['name' => 'Aysel Kerimova', 'position' => 'Event Manager'],
                    'az' => ['name' => 'Aysəl Kərimova', 'position' => 'Event Menecer'],
                ],
            ],
            [
                'name' => 'Орхан Гулиев',
                'slug' => 'orkhan-guliyev',
                'position' => 'Технический директор',
                'is_published' => true,
                'is_leader' => false,
                'sort_order' => 11,
                'translations' => [
                    'ru' => ['name' => 'Орхан Гулиев', 'position' => 'Технический директор'],
                    'en' => ['name' => 'Orkhan Guliyev', 'position' => 'Technical Director'],
                    'az' => ['name' => 'Orxan Quliyev', 'position' => 'Texniki Direktor'],
                ],
            ],
            [
                'name' => 'Нармина Сулейманова',
                'slug' => 'narmina-suleymanova',
                'position' => 'Дизайнер',
                'is_published' => true,
                'is_leader' => false,
                'sort_order' => 12,
                'translations' => [
                    'ru' => ['name' => 'Нармина Сулейманова', 'position' => 'Дизайнер'],
                    'en' => ['name' => 'Narmina Suleymanova', 'position' => 'Designer'],
                    'az' => ['name' => 'Nərminə Süleymanova', 'position' => 'Dizayner'],
                ],
            ],
            [
                'name' => 'Фарид Исмаилов',
                'slug' => 'farid-ismailov',
                'position' => 'Продюсер',
                'is_published' => true,
                'is_leader' => false,
                'sort_order' => 13,
                'translations' => [
                    'ru' => ['name' => 'Фарид Исмаилов', 'position' => 'Продюсер'],
                    'en' => ['name' => 'Farid Ismailov', 'position' => 'Producer'],
                    'az' => ['name' => 'Fərid İsmayılov', 'position' => 'Prodüser'],
                ],
            ],
            [
                'name' => 'Гюнель Багирова',
                'slug' => 'gunel-bagirova',
                'position' => 'Координатор проектов',
                'is_published' => true,
                'is_leader' => false,
                'sort_order' => 14,
                'translations' => [
                    'ru' => ['name' => 'Гюнель Багирова', 'position' => 'Координатор проектов'],
                    'en' => ['name' => 'Gunel Bagirova', 'position' => 'Project Coordinator'],
                    'az' => ['name' => 'Günəl Bağırova', 'position' => 'Layihə Koordinatoru'],
                ],
            ],
            [
                'name' => 'Эмин Гаджиев',
                'slug' => 'emin-hajiyev',
                'position' => 'Звукорежиссёр',
                'is_published' => true,
                'is_leader' => false,
                'sort_order' => 15,
                'translations' => [
                    'ru' => ['name' => 'Эмин Гаджиев', 'position' => 'Звукорежиссёр'],
                    'en' => ['name' => 'Emin Hajiyev', 'position' => 'Sound Engineer'],
                    'az' => ['name' => 'Emin Hacıyev', 'position' => 'Səs Rejissoru'],
                ],
            ],
        ];

        foreach ($members as $data) {
            TeamMember::create($data);
        }
    }

    public function down(): void
    {
        TeamMember::whereIn('slug', [
            'aysel-kerimova', 'orkhan-guliyev', 'narmina-suleymanova',
            'farid-ismailov', 'gunel-bagirova', 'emin-hajiyev'
        ])->delete();

        TeamMember::whereIn('slug', ['elvin-gasimov', 'aysel-mammadova', 'rashad-aliyev'])
            ->update(['is_leader' => false, 'bio' => null]);
    }
};
