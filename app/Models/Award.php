<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'title',
        'organization',
        'year',
        'icon',
        'translations',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'translations' => 'array',
    ];

    public function getTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations[$locale][$field] ?? $this->{$field} ?? null;
    }

    public function getTitleAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['title'] ?? $value ?? null;
    }

    public function getOrganizationAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['organization'] ?? $value ?? null;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
