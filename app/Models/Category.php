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

    public function getSlugAttribute($value): string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['slug'] ?? $value ?? '';
    }

    public function getRawSlug(): ?string
    {
        return $this->attributes['slug'] ?? null;
    }

    public function getDescriptionAttribute($value): ?string
    {
        $locale = app()->getLocale();
        return $this->translations[$locale]['description'] ?? $value ?? null;
    }

    public function getAllNamesAttribute(): string
    {
        $names = [];
        if (is_array($this->translations)) {
            foreach ($this->translations as $locale => $data) {
                if (isset($data['name']) && !empty($data['name'])) {
                    $names[] = $data['name'];
                }
            }
        }
        return implode(' | ', $names) ?: $this->attributes['name'] ?? '';
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }


    /**
     * Boot the model
     */
    protected static function booted(): void
    {
        // Auto-fill base columns from translations if empty
        static::saving(function (Category $category) {
            if (empty($category->name) && !empty($category->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($category->translations[$lang]['name'])) {
                        $category->name = $category->translations[$lang]['name'];
                        break;
                    }
                }
            }

            if (empty($category->slug) && !empty($category->translations)) {
                foreach (['az', 'ru', 'en'] as $lang) {
                    if (!empty($category->translations[$lang]['slug'])) {
                        $category->slug = $category->translations[$lang]['slug'];
                        break;
                    } elseif (!empty($category->translations[$lang]['name'])) {
                        $category->slug = \Illuminate\Support\Str::slug($category->translations[$lang]['name']);
                        break;
                    }
                }
            }
        });

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
