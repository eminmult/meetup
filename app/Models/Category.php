<?php

namespace App\Models;

use App\Models\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasLanguage;

    protected $fillable = [
        'language_id',
        'name',
        'slug',
        'color',
        'description',
        'translations',
        'order',
        'is_active',
        'show_in_menu',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_in_menu' => 'boolean',
        'translations' => 'array',
    ];

    public function getTranslation(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations[$locale][$field] ?? $this->{$field} ?? null;
    }

    public function getNameAttribute($value): string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['name'] ?? $value ?? '';
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }


    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Boot the model
     */
    protected static function booted(): void
    {
        // Очищаем кеш категорий при любом изменении
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('menu_categories');
            \App\Http\Controllers\SitemapController::clearCache();
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('menu_categories');
            \App\Http\Controllers\SitemapController::clearCache();
        });
    }
}
