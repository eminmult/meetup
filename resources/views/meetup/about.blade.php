@extends('layouts.meetup')

@section('title', $page->getSeoField('title') ?? $page->getTranslation('hero_title') ?? __('site.nav.about') . ' | MEETUP')
@section('description', $page->getSeoField('description') ?? $page->getTranslation('hero_text'))

@section('content')
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content" data-aos="fade-up">
            <span class="section-subtitle">{{ $page->getTranslation('hero_subtitle') }}</span>
            <h1 class="about-hero-title hero-title--lines">{{ strip_tags($page->getTranslation('hero_title')) }}</h1>
            <p class="about-hero-text">{{ $page->getTranslation('hero_text') }}</p>
            @if($page->sections['hero']['video_url'] ?? null)
            <button class="video-play-btn" id="playVideoBtn">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                </svg>
                {{ $page->getTranslation('video_btn') ?? __('site.about.watch_video') }}
            </button>
            @endif
        </div>
        <div class="hero-scroll-indicator">
            <span>{{ $page->getTranslation('scroll_text') ?? __('site.about.scroll_down') }}</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
    </section>

    <!-- Video Modal -->
    @if($page->sections['hero']['video_url'] ?? null)
    <div class="video-modal" id="videoModal">
        <div class="video-modal-content">
            <button class="video-modal-close" id="closeVideoBtn">&times;</button>
            <iframe id="videoFrame" src="" data-src="{{ $page->sections['hero']['video_url'] }}" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
    </div>
    @endif

    <!-- Story Section -->
    <section class="story-section">
        <div class="story-container">
            <div class="story-images" data-aos="fade-right">
                @if($page->sections['story']['year'] ?? null)
                <div class="story-year">{{ $page->sections['story']['year'] }}</div>
                @endif
                @php
                    $storyMedia = $page->getMedia('page-gallery');
                @endphp
                @if($storyMedia->count() > 0)
                <div class="story-img story-img-1">
                    <img src="{{ $storyMedia[0]->getUrl('medium') }}" alt="Event">
                </div>
                @if($storyMedia->count() > 1)
                <div class="story-img story-img-2">
                    <img src="{{ $storyMedia[1]->getUrl('medium') }}" alt="Team">
                </div>
                @endif
                @else
                <div class="story-img story-img-1">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600" alt="Event">
                </div>
                <div class="story-img story-img-2">
                    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=600" alt="Team">
                </div>
                @endif
            </div>
            <div class="story-content" data-aos="fade-left">
                <span class="section-subtitle">{{ $page->getSectionField('story', 'subtitle') }}</span>
                <h2 class="section-title">{{ $page->getSectionField('story', 'title') }}</h2>
                @if($page->getSectionField('story', 'text_1'))
                <p class="story-text">{{ $page->getSectionField('story', 'text_1') }}</p>
                @endif
                @if($page->getSectionField('story', 'text_2'))
                <p class="story-text">{{ $page->getSectionField('story', 'text_2') }}</p>
                @endif
                @if($highlights = $page->sections['story']['highlights'] ?? null)
                <div class="story-highlights">
                    @foreach($highlights as $highlight)
                    <div class="highlight-item">
                        <div class="highlight-icon">
                            @switch($highlight['icon'] ?? 'star')
                                @case('users')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    @break
                                @case('layers')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                        <path d="M2 17l10 5 10-5"></path>
                                        <path d="M2 12l10 5 10-5"></path>
                                    </svg>
                                    @break
                                @case('award')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="8" r="7"></circle>
                                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                                    </svg>
                                    @break
                                @case('heart')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                    @break
                            @endswitch
                        </div>
                        <div class="highlight-text">
                            <h4>{{ $highlight['number'] }} {{ $highlight['label_' . app()->getLocale()] ?? $highlight['label_ru'] }}</h4>
                            <p>{{ $highlight['sublabel_' . app()->getLocale()] ?? $highlight['sublabel_ru'] ?? '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="mission-container">
            <div class="mission-header" data-aos="fade-up">
                <span class="section-subtitle">{{ $page->getSectionField('mission', 'subtitle') }}</span>
                <h2 class="section-title">{{ $page->getSectionField('mission', 'title') }}</h2>
            </div>
            <div class="mission-grid">
                <div class="mission-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="mission-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <h3>{{ $page->getSectionField('mission', 'mission_title') }}</h3>
                    <p>{{ $page->getSectionField('mission', 'mission_text') }}</p>
                </div>
                <div class="mission-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="mission-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </div>
                    <h3>{{ $page->getSectionField('mission', 'vision_title') }}</h3>
                    <p>{{ $page->getSectionField('mission', 'vision_text') }}</p>
                </div>
                <div class="mission-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="mission-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <h3>{{ $page->getSectionField('mission', 'goal_title') }}</h3>
                    <p>{{ $page->getSectionField('mission', 'goal_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    @if($values = $page->getSectionItems('values'))
    <section class="values-section">
        <div class="values-container">
            <div class="values-header" data-aos="fade-up">
                <span class="section-subtitle">{{ $page->getSectionField('values', 'subtitle') }}</span>
                <h2 class="section-title">{{ $page->getSectionField('values', 'title') }}</h2>
            </div>
            <div class="values-grid">
                @foreach($values as $index => $value)
                <div class="value-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="value-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3>{{ $value['title_' . app()->getLocale()] ?? $value['title_ru'] }}</h3>
                    <p>{{ $value['text_' . app()->getLocale()] ?? $value['text_ru'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Gallery Section -->
    @if($galleryItems = $page->getSectionItems('gallery'))
    <section class="gallery-section">
        <div class="gallery-container">
            <div class="gallery-header" data-aos="fade-up">
                <span class="section-subtitle">{{ $page->getSectionField('gallery', 'subtitle') }}</span>
                <h2 class="section-title">{{ $page->getSectionField('gallery', 'title') }}</h2>
            </div>
            <div class="gallery-grid">
                @foreach($galleryItems as $index => $item)
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="{{ ($index % 6 + 1) * 50 }}">
                    <img src="{{ $item['image_url'] }}" alt="{{ $item['caption_' . app()->getLocale()] ?? $item['caption_ru'] ?? '' }}">
                    @if($item['caption_' . app()->getLocale()] ?? $item['caption_ru'] ?? null)
                    <div class="gallery-overlay"><span>{{ $item['caption_' . app()->getLocale()] ?? $item['caption_ru'] }}</span></div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-content">
            <button class="lightbox-close">&times;</button>
            <button class="lightbox-nav lightbox-prev">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <img src="" alt="Gallery Image" id="lightboxImg">
            <button class="lightbox-nav lightbox-next">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>

    <!-- Timeline Section -->
    @if($timelineItems = $page->getSectionItems('timeline'))
    <section class="timeline-section">
        <div class="timeline-container">
            <div class="timeline-header" data-aos="fade-up">
                <span class="section-subtitle">{{ $page->getSectionField('timeline', 'subtitle') }}</span>
                <h2 class="section-title">{{ $page->getSectionField('timeline', 'title') }}</h2>
            </div>
            <div class="timeline">
                @foreach($timelineItems as $item)
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-dot"></div>
                    <div class="timeline-year">{{ $item['year'] }}</div>
                    <h3 class="timeline-title">{{ $item['title_' . app()->getLocale()] ?? $item['title_ru'] }}</h3>
                    <p class="timeline-text">{{ $item['text_' . app()->getLocale()] ?? $item['text_ru'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container" data-aos="fade-up">
            <h2 class="cta-title">{{ $page->getSectionField('cta', 'title') ?? __('site.cta.title') }}</h2>
            <p class="cta-text">{{ $page->getSectionField('cta', 'text') ?? __('site.cta.text') }}</p>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="cta-btn">
                {{ $page->getSectionField('cta', 'btn_text') ?? __('site.cta.btn') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>
@endsection
