<?php

use App\Models\Portfolio;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $updates = [
            'google-developer-conference' => [
                'client_name' => 'Google',
                'description' => 'Организовали масштабную IT-конференцию для разработчиков с участием спикеров из Google, интерактивными зонами и networking-сессиями.',
            ],
            'microsoft-azure-summit' => [
                'client_name' => 'Microsoft',
                'description' => 'Провели технологический саммит по облачным решениям Azure с демонстрациями, воркшопами и экспертными сессиями.',
            ],
            'socar-annual-meeting' => [
                'client_name' => 'SOCAR',
                'description' => 'Организовали ежегодное корпоративное мероприятие с участием топ-менеджмента, награждением лучших сотрудников и гала-ужином.',
            ],
        ];

        foreach ($updates as $slug => $data) {
            Portfolio::where('slug', $slug)->update($data);
        }
    }

    public function down(): void
    {
        Portfolio::whereIn('slug', ['google-developer-conference', 'microsoft-azure-summit', 'socar-annual-meeting'])
            ->update(['client_name' => null, 'description' => null]);
    }
};
