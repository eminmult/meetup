<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Filament\Resources\TeamMembers\TeamMemberResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateTeamMember extends CreateRecord
{
    protected static string $resource = TeamMemberResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Get name from first available translation for slug
        if (empty($data['slug']) && !empty($data['translations'])) {
            foreach ($data['translations'] as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $data['slug'] = Str::slug($translation['name']);
                    $data['name'] = $translation['name'];
                    $data['position'] = $translation['position'] ?? null;
                    $data['bio'] = $translation['bio'] ?? null;
                    break;
                }
            }
        }

        return $data;
    }
}
