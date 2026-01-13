<?php

namespace App\Models;

use App\Services\LanguageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $fillable = [
        'code',
        'name',
        'native_name',
        'flag',
        'is_active',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Language $language) {
            // Если этот язык устанавливается как дефолтный - снять флаг с других
            if ($language->is_default) {
                static::where('id', '!=', $language->id ?? 0)
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }
        });

        // Clear language cache on any change
        static::saved(fn () => LanguageService::clearCache());
        static::deleted(fn () => LanguageService::clearCache());
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public static function getDefault(): ?self
    {
        return static::where('is_default', true)->first()
            ?? static::where('is_active', true)->orderBy('sort_order')->first();
    }

    public static function getActive()
    {
        return static::where('is_active', true)->orderBy('sort_order')->get();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
