<?php

namespace App\Filament\Traits;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;

trait HasContentLanguageFilter
{
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $languageId = session('filament_language_id');

        if ($languageId) {
            $query->where('language_id', $languageId);
        }

        return $query;
    }

    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        $languageId = session('filament_language_id');

        if ($languageId && !isset($data['language_id'])) {
            $data['language_id'] = $languageId;
        }

        return $data;
    }

    public static function getCurrentLanguage(): ?Language
    {
        $languageId = session('filament_language_id');

        if ($languageId) {
            return Language::find($languageId);
        }

        return Language::getDefault();
    }

    public static function getCurrentLanguageId(): ?int
    {
        return session('filament_language_id');
    }
}
