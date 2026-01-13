<?php

namespace App\Filament\Resources\Portfolios\Pages;

use App\Filament\Resources\Portfolios\PortfolioResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreatePortfolio extends CreateRecord
{
    protected static string $resource = PortfolioResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Get title and slug from first available translation
        if (!empty($data['translations'])) {
            foreach ($data['translations'] as $locale => $translation) {
                if (!empty($translation['title'])) {
                    $data['title'] = $translation['title'];
                    $data['description'] = $translation['description'] ?? null;
                    $data['content'] = $translation['content'] ?? null;

                    // Use slug from translation or generate from title
                    $data['slug'] = $translation['slug'] ?? Str::slug($translation['title']);
                    break;
                }
            }
        }

        return $data;
    }
}
