<?php

namespace App\Filament\Resources\Awards\Pages;

use App\Filament\Resources\Awards\AwardResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAward extends CreateRecord
{
    protected static string $resource = AwardResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['translations'])) {
            $translations = [];
            foreach ($data['translations'] as $locale => $fields) {
                $translations[$locale] = array_filter($fields);
            }
            $data['translations'] = array_filter($translations);
        }

        return $data;
    }
}
