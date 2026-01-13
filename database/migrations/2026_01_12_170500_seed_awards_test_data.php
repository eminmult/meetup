<?php

use App\Models\Award;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $awards = [
            [
                'title' => 'Best Event Agency',
                'organization' => 'Azerbaijan Business Awards',
                'year' => '2024',
                'icon' => 'award',
                'translations' => [
                    'ru' => [
                        'title' => 'Лучшее Event-агентство',
                        'organization' => 'Azerbaijan Business Awards',
                    ],
                    'en' => [
                        'title' => 'Best Event Agency',
                        'organization' => 'Azerbaijan Business Awards',
                    ],
                    'az' => [
                        'title' => 'Ən Yaxşı Event Agentliyi',
                        'organization' => 'Azerbaijan Business Awards',
                    ],
                ],
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Excellence in Events',
                'organization' => 'Caspian Event Awards',
                'year' => '2023',
                'icon' => 'star',
                'translations' => [
                    'ru' => [
                        'title' => 'Превосходство в мероприятиях',
                        'organization' => 'Caspian Event Awards',
                    ],
                    'en' => [
                        'title' => 'Excellence in Events',
                        'organization' => 'Caspian Event Awards',
                    ],
                    'az' => [
                        'title' => 'Tədbirlərdə Mükəmməllik',
                        'organization' => 'Caspian Event Awards',
                    ],
                ],
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Top Wedding Planner',
                'organization' => 'Wedding Industry Awards',
                'year' => '2023',
                'icon' => 'trophy',
                'translations' => [
                    'ru' => [
                        'title' => 'Лучший свадебный организатор',
                        'organization' => 'Wedding Industry Awards',
                    ],
                    'en' => [
                        'title' => 'Top Wedding Planner',
                        'organization' => 'Wedding Industry Awards',
                    ],
                    'az' => [
                        'title' => 'Ən Yaxşı Toy Planlaşdırıcısı',
                        'organization' => 'Wedding Industry Awards',
                    ],
                ],
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'International Recognition',
                'organization' => 'Global Event Forum',
                'year' => '2022',
                'icon' => 'globe',
                'translations' => [
                    'ru' => [
                        'title' => 'Международное признание',
                        'organization' => 'Global Event Forum',
                    ],
                    'en' => [
                        'title' => 'International Recognition',
                        'organization' => 'Global Event Forum',
                    ],
                    'az' => [
                        'title' => 'Beynəlxalq Tanınma',
                        'organization' => 'Global Event Forum',
                    ],
                ],
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($awards as $data) {
            Award::create($data);
        }
    }

    public function down(): void
    {
        Award::truncate();
    }
};
