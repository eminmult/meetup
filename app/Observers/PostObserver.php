<?php

namespace App\Observers;

use App\Http\Controllers\SitemapController;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle the Post "saving" event (before any save).
     */
    public function saving(Post $post): void
    {
        // Игнорируем обновления только счётчика просмотров
        if ($post->exists && $post->isDirty()) {
            $dirtyFields = $post->getDirty();
            unset($dirtyFields['views'], $dirtyFields['updated_at']);

            if (!empty($dirtyFields)) {
                $this->clearPostCaches($post);
            }
        }
    }

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        // Автоматически устанавливаем первую картинку галереи как главную
        if (!$post->featured_media_id) {
            $firstGalleryImage = $post->getFirstMedia('post-gallery');
            if ($firstGalleryImage) {
                $post->featured_media_id = $firstGalleryImage->id;
                $post->saveQuietly();
            }
        }

        $this->clearPostCaches($post);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // Игнорируем обновления только счётчика просмотров
        $changedFields = array_keys($post->getChanges());
        $ignoredFields = ['views', 'updated_at'];
        $significantChanges = array_diff($changedFields, $ignoredFields);

        if (empty($significantChanges)) {
            return; // Только views изменился - не очищаем кеш
        }

        // Автоматически устанавливаем первую картинку галереи как главную, если главная не установлена
        if (!$post->featured_media_id) {
            $firstGalleryImage = $post->getFirstMedia('post-gallery');
            if ($firstGalleryImage) {
                $post->featured_media_id = $firstGalleryImage->id;
                $post->saveQuietly();
            }
        }

        $this->clearPostCaches($post);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $post->loadMissing('categories');
        $this->clearPostCaches($post);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->clearPostCaches($post);
    }

    /**
     * Очистка всех кешей связанных с постом
     */
    protected function clearPostCaches(Post $post): void
    {

        // Очищаем кеш главной страницы
        Cache::forget('home_slider_posts');
        Cache::forget('home_important_posts');
        Cache::forget('home_main_featured_posts');
        Cache::forget('home_video_posts');
        Cache::forget('home_photo_posts');
        Cache::forget('home_media_posts');

        // Очищаем кеш последних постов (все страницы)
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget("home_latest_posts_page_{$i}");
        }

        // Очищаем кеш поста для всех категорий, к которым он принадлежит
        $categoriesCleared = 0;
        if ($post->slug && $post->categories) {
            foreach ($post->categories as $category) {
                $cacheKey = "post_{$category->slug}_{$post->slug}";
                Cache::forget($cacheKey);
                $categoriesCleared++;
                \Log::debug("PostObserver: Очищен кеш поста", ['cache_key' => $cacheKey]);
            }
        }

        // Очищаем кеш похожих постов
        Cache::forget("post_{$post->id}_related");

        // Очищаем кеш категорий, к которым принадлежит пост
        if ($post->categories) {
            foreach ($post->categories as $category) {
                Cache::forget("category_{$category->slug}");
                Cache::forget("category_{$category->id}_total_views");
                Cache::forget("category_{$category->id}_today_posts_count");

                // Очищаем все страницы постов в категории
                for ($i = 1; $i <= 50; $i++) {
                    Cache::forget("category_{$category->id}_posts_page_{$i}");
                }
            }
        }

        // Очищаем общие кеши
        Cache::forget('all_categories');
        Cache::forget('menu_categories');
        Cache::forget('categories_with_posts_count');

        // Очищаем Response Cache (Full Page Cache)
        if (class_exists('\Spatie\ResponseCache\Facades\ResponseCache')) {
            \Spatie\ResponseCache\Facades\ResponseCache::clear();
        }

        // Очищаем nginx fastcgi_cache через триггер
        $this->clearNginxCache();
    }

    /**
     * Очистка nginx fastcgi_cache через триггер-файл
     * Скрипт на хосте мониторит файл и очищает кеш
     */
    protected function clearNginxCache(): void
    {
        @file_put_contents(storage_path('cache-clear-trigger'), time());
    }
}
