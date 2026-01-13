@extends('layouts.meetup')

@section('title', ($page ? $page->getTranslation('title') : __('site.nav.blog')) . ' - MEETUP Event & Production')
@section('description', $page ? $page->getTranslation('hero_text') : '')

@section('content')
    @php
        $locale = app()->getLocale();
        $labels = $page?->sections['labels'][$locale] ?? [];
    @endphp

    <!-- Hero Section -->
    <section class="blog-hero">
        <img class="blog-hero-bg" src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=1920" alt="{{ __('site.nav.blog') }}">
        <div class="blog-hero-breadcrumb">
            <a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <span>{{ __('site.nav.blog') }}</span>
        </div>
        <div class="blog-hero-content" data-aos="fade-up">
            <span class="section-subtitle">{{ $page?->getTranslation('hero_subtitle') ?? __('site.nav.blog') }}</span>
            <h1 class="blog-hero-title hero-title--lines">{{ $page?->getTranslation('hero_title') ?? __('site.nav.blog') }}</h1>
            @if($page?->getTranslation('hero_text'))
                <p class="blog-hero-text">{{ $page->getTranslation('hero_text') }}</p>
            @endif
        </div>
    </section>

    <!-- Blog Content -->
    <section class="blog-section">
        <div class="blog-container">
            <div class="blog-main">
                @if($posts->count() > 0)
                    <div class="blog-grid">
                        @foreach($posts as $index => $post)
                            <article class="blog-card" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                                <a href="{{ route('blog.show', ['locale' => $locale, 'slug' => $post->slug]) }}" class="blog-card-image">
                                    @if($post->featured_image_medium)
                                        <img src="{{ $post->featured_image_medium }}" alt="{{ $post->title }}" loading="lazy">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600" alt="{{ $post->title }}">
                                    @endif
                                    @if($post->main_category)
                                        <span class="blog-card-category">{{ $post->main_category->name }}</span>
                                    @endif
                                </a>
                                <div class="blog-card-content">
                                    <div class="blog-card-meta">
                                        <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                                            {{ $post->published_at->translatedFormat('d M Y') }}
                                        </time>
                                        @if($post->read_time)
                                            <span>{{ $post->read_time }} min</span>
                                        @endif
                                    </div>
                                    <h3 class="blog-card-title">
                                        <a href="{{ route('blog.show', ['locale' => $locale, 'slug' => $post->slug]) }}">
                                            {{ Str::limit($post->title, 80) }}
                                        </a>
                                    </h3>
                                    @if($post->excerpt)
                                        <p class="blog-card-excerpt">{{ Str::limit(strip_tags($post->excerpt), 120) }}</p>
                                    @endif
                                    <a href="{{ route('blog.show', ['locale' => $locale, 'slug' => $post->slug]) }}" class="blog-card-link">
                                        {{ $labels['read_more'] ?? 'Read more' }}
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($posts->hasPages())
                        <div class="blog-pagination" data-aos="fade-up">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @else
                    <div class="blog-empty" data-aos="fade-up">
                        <p>{{ $labels['no_posts'] ?? 'No posts found' }}</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="blog-sidebar">
                <!-- Categories -->
                @if($categories->count() > 0)
                    <div class="blog-widget" data-aos="fade-up">
                        <h3 class="blog-widget-title">{{ $labels['categories'] ?? 'Categories' }}</h3>
                        <ul class="blog-categories">
                            @foreach($categories as $category)
                                @if($category->posts_count > 0)
                                    <li>
                                        <a href="#">
                                            {{ $category->name }}
                                            <span>({{ $category->posts_count }})</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Recent Posts -->
                @if($recentPosts->count() > 0)
                    <div class="blog-widget" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="blog-widget-title">{{ $labels['recent_posts'] ?? 'Recent Posts' }}</h3>
                        <div class="blog-recent">
                            @foreach($recentPosts as $recentPost)
                                <a href="{{ route('blog.show', ['locale' => $locale, 'slug' => $recentPost->slug]) }}" class="blog-recent-item">
                                    <div class="blog-recent-image">
                                        @if($recentPost->featured_image_thumb)
                                            <img src="{{ $recentPost->featured_image_thumb }}" alt="{{ $recentPost->title }}" loading="lazy">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=150" alt="{{ $recentPost->title }}">
                                        @endif
                                    </div>
                                    <div class="blog-recent-content">
                                        <h4>{{ Str::limit($recentPost->title, 50) }}</h4>
                                        <time>{{ $recentPost->published_at->translatedFormat('d M Y') }}</time>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </section>
@endsection
