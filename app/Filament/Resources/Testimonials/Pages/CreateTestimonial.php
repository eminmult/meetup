<?php

namespace App\Filament\Resources\Testimonials\Pages;

use App\Filament\Resources\Testimonials\TestimonialResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTestimonial extends CreateRecord
{
    protected static string $resource = TestimonialResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Get author_name from first available translation
        if (!empty($data['translations'])) {
            foreach ($data['translations'] as $locale => $translation) {
                if (!empty($translation['author_name'])) {
                    $data['author_name'] = $translation['author_name'];
                    $data['author_position'] = $translation['author_position'] ?? null;
                    $data['text'] = $translation['text'] ?? null;
                    break;
                }
            }
        }

        return $data;
    }
}
