<?php

namespace App\Filament\Resources\TeamMembers\Pages;

use App\Filament\Resources\TeamMembers\TeamMemberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTeamMember extends EditRecord
{
    protected static string $resource = TeamMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Sync main fields from first available translation
        if (!empty($data['translations'])) {
            foreach ($data['translations'] as $locale => $translation) {
                if (!empty($translation['name'])) {
                    $data['name'] = $translation['name'];
                    $data['position'] = $translation['position'] ?? $data['position'] ?? null;
                    $data['bio'] = $translation['bio'] ?? $data['bio'] ?? null;
                    break;
                }
            }
        }

        return $data;
    }
}
