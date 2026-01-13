<?php

namespace App\Filament\Resources\Portfolios\Pages;

use App\Filament\Resources\Portfolios\PortfolioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPortfolio extends EditRecord
{
    protected static string $resource = PortfolioResource::class;

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
                if (!empty($translation['title'])) {
                    $data['title'] = $translation['title'];
                    $data['description'] = $translation['description'] ?? $data['description'] ?? null;
                    $data['content'] = $translation['content'] ?? $data['content'] ?? null;
                    break;
                }
            }
        }

        return $data;
    }
}
