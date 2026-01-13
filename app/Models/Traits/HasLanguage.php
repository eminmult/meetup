<?php

namespace App\Models\Traits;

use App\Models\Language;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasLanguage
{
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function scopeForLanguage($query, ?int $languageId = null)
    {
        if ($languageId) {
            return $query->where('language_id', $languageId);
        }
        return $query;
    }

    public function scopeForCurrentLanguage($query)
    {
        $languageId = session('filament_language_id');
        if ($languageId) {
            return $query->where('language_id', $languageId);
        }
        return $query;
    }
}
