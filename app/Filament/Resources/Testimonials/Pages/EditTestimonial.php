<?php

namespace App\Filament\Resources\Testimonials\Pages;

use App\Filament\Resources\Testimonials\TestimonialResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTestimonial extends EditRecord
{
    protected static string $resource = TestimonialResource::class;

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
                if (!empty($translation['author_name'])) {
                    $data['author_name'] = $translation['author_name'];
                    $data['author_position'] = $translation['author_position'] ?? $data['author_position'] ?? null;
                    $data['text'] = $translation['text'] ?? $data['text'] ?? null;
                    break;
                }
            }
        }

        return $data;
    }
}
