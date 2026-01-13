<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Категории кешируются на 1 год (инвалидация через Observer)
        $categories = Cache::remember('all_categories', 31536000, function() {
            return Category::where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        // Последние посты - кешируем на 1 год с учетом страницы (инвалидация через Observer)
        $page = request()->get('page', 1);
        $latestPosts = Cache::remember("home_latest_posts_page_{$page}", 31536000, function() {
            return Post::published()
                ->with(['categories', 'category', 'author'])
                ->latest('published_at')
                ->paginate(Setting::get('home_posts_count', 15));
        });

        return view('home', compact('categories', 'latestPosts'));
    }

    public function category($slug)
    {
        // Кешируем категорию на 1 год (инвалидация через Observer)
        $category = Cache::remember("category_{$slug}", 31536000, function() use ($slug) {
            return Category::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        // Посты категории кешируем на 1 год с учетом страницы (инвалидация через Observer)
        $page = request()->get('page', 1);
        $posts = Cache::remember("category_{$category->id}_posts_page_{$page}", 31536000, function() use ($category) {
            return Post::published()
                ->whereHas('categories', function($q) use ($category) {
                    $q->where('categories.id', $category->id);
                })
                ->with(['category', 'author'])
                ->latest('published_at')
                ->paginate(Setting::get('category_posts_count', 12));
        });

        return view('category', compact('category', 'posts'));
    }

    public function show($category, $slug)
    {
        // Кешируем пост на 10 минут
        $post = Cache::remember("post_{$category}_{$slug}", 600, function() use ($slug, $category) {
            return Post::published()
                ->where('slug', $slug)
                ->whereHas('categories', function($q) use ($category) {
                    $q->where('categories.slug', $category);
                })
                ->with(['categories', 'author', 'widgets'])
                ->firstOrFail();
        });

        // Счетчик просмотров обновляется отдельно (не кешируется)
        $post->incrementViews();

        // Категории
        $categories = Cache::remember('all_categories', 3600, function() {
            return Category::where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        // Похожие посты из той же категории
        $relatedPosts = Cache::remember("post_{$post->id}_related", 1800, function() use ($post) {
            $categoryIds = $post->categories->pluck('id');

            return Post::published()
                ->whereHas('categories', function($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds);
                })
                ->where('id', '!=', $post->id)
                ->with(['category', 'author'])
                ->latest('published_at')
                ->take(Setting::get('related_posts_count', 6))
                ->get();
        });

        return view('post', compact('post', 'categories', 'relatedPosts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        // Записываем поисковый запрос
        if (!empty($query)) {
            \App\Models\SearchQuery::recordQuery($query);
        }

        $categories = Cache::remember('all_categories', 3600, function() {
            return Category::where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        // Используем Meilisearch через Scout для быстрого поиска
        if (!empty($query)) {
            $posts = Post::search($query)
                ->query(function($builder) {
                    $builder->with(['category', 'author']);
                })
                ->paginate(Setting::get('search_posts_count', 12));
        } else {
            $posts = Post::published()
                ->with(['category', 'author'])
                ->latest('published_at')
                ->paginate(Setting::get('search_posts_count', 12));
        }

        return view('search', compact('query', 'categories', 'posts'));
    }

    public function popularSearches()
    {
        $queries = \App\Models\SearchQuery::getTopQueries(5);
        return response()->json($queries);
    }

    public function about()
    {
        $page = Cache::remember('page_about', 604800, function() {
            return Page::published()
                ->where('slug', 'about')
                ->firstOrFail();
        });

        $categories = Cache::remember('all_categories', 3600, function() {
            return Category::where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        $authors = Cache::remember('about_page_authors', 86400, function() {
            return \App\Models\User::where('role', 'author')
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        });

        return view('about', compact('page', 'categories', 'authors'));
    }

    public function contact()
    {
        $page = Cache::remember('page_contacts', 3600, function() {
            return Page::published()
                ->where('slug', 'contacts')
                ->firstOrFail();
        });

        $categories = Cache::remember('all_categories', 3600, function() {
            return Category::where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        return view('contact', compact('page', 'categories'));
    }
}
