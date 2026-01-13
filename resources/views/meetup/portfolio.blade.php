@extends('layouts.meetup')

@section('title', __('site.portfolio.page.title') . ' - MEETUP Event & Production')
@section('description', __('site.portfolio.page.description'))

@section('content')
    <!-- Hero Section -->
    <section class="portfolio-hero">
        <div class="portfolio-hero-content" data-aos="fade-up">
            <span class="section-subtitle">{{ __('site.portfolio.page.hero_subtitle') }}</span>
            <h1 class="portfolio-hero-title hero-title--lines">{{ __('site.portfolio.page.hero_title') }}</h1>
            <p class="portfolio-hero-text">{{ __('site.portfolio.page.hero_text') }}</p>
        </div>
        <div class="portfolio-stats">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number">500+</div>
                <div class="stat-label">{{ __('site.portfolio.page.stat_events') }}</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number">150+</div>
                <div class="stat-label">{{ __('site.portfolio.page.stat_clients') }}</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number">15</div>
                <div class="stat-label">{{ __('site.portfolio.page.stat_years') }}</div>
            </div>
            <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-number">98%</div>
                <div class="stat-label">{{ __('site.portfolio.page.stat_satisfaction') }}</div>
            </div>
        </div>
    </section>

    <!-- Clients Section (Portfolio Items) -->
    @if($portfolios->count() > 0)
    <section class="clients-section">
        <div class="clients-container">
            <div class="clients-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.portfolio.page.clients_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.portfolio.page.clients_title') }}</h2>
            </div>
            <div class="clients-grid">
                @foreach($portfolios as $index => $portfolio)
                <a href="{{ route('portfolio.show', ['locale' => app()->getLocale(), 'slug' => $portfolio->slug]) }}" class="client-card" data-aos="fade-up" data-aos-delay="{{ (($index % 5) + 1) * 50 }}">
                    @if($portfolio->client_logo)
                        <img src="{{ $portfolio->client_logo }}" alt="{{ $portfolio->client_name }}" class="client-logo">
                    @else
                        <span class="client-name">{{ $portfolio->client_name }}</span>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Awards Section -->
    @if($awards->count() > 0)
    <section class="awards-section">
        <div class="awards-container">
            <div class="awards-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.portfolio.page.awards_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.portfolio.page.awards_title') }}</h2>
            </div>
            <div class="awards-grid">
                @foreach($awards as $index => $award)
                <div class="award-card" data-aos="fade-up" data-aos-delay="{{ (($index % 4) + 1) * 100 }}">
                    <div class="award-icon">
                        @if($award->icon === 'star')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        @elseif($award->icon === 'trophy')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                            <path d="M4 22h16"></path>
                            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                            <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                        </svg>
                        @elseif($award->icon === 'globe')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                        @elseif($award->icon === 'certificate')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="12" rx="2" ry="2"></rect>
                            <line x1="12" y1="16" x2="12" y2="21"></line>
                            <line x1="8" y1="21" x2="16" y2="21"></line>
                        </svg>
                        @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="6"></circle>
                            <path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"></path>
                        </svg>
                        @endif
                    </div>
                    <h3>{{ $award->title }}</h3>
                    <p>{{ $award->organization }}</p>
                    @if($award->year)
                    <span class="award-year">{{ $award->year }}</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Testimonials Section -->
    @if($testimonials->count() > 0)
    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="testimonials-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.portfolio.page.testimonials_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.portfolio.page.testimonials_title') }}</h2>
            </div>
            <div class="testimonials-grid">
                @foreach($testimonials as $index => $testimonial)
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                    <div class="testimonial-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.192 15.757c0-.88-.23-1.618-.69-2.217-.326-.412-.768-.683-1.327-.812-.55-.128-1.07-.137-1.54-.028-.16-.95.1-1.956.76-3.022.66-1.065 1.515-1.867 2.558-2.403L9.373 5c-.8.396-1.56.898-2.26 1.505-.71.607-1.34 1.305-1.9 2.094s-.98 1.68-1.25 2.69-.346 2.04-.217 3.1c.168 1.4.62 2.52 1.356 3.35.735.84 1.652 1.26 2.748 1.26.965 0 1.766-.29 2.4-.878.628-.576.94-1.365.94-2.368l.002.004zm9.124 0c0-.88-.23-1.618-.69-2.217-.326-.42-.77-.692-1.327-.817-.56-.124-1.074-.13-1.54-.022-.16-.94.09-1.95.75-3.02.66-1.06 1.514-1.86 2.557-2.4L18.49 5c-.8.396-1.555.898-2.26 1.505-.708.607-1.34 1.305-1.894 2.094-.556.79-.97 1.68-1.24 2.69-.273 1-.345 2.04-.217 3.1.168 1.4.62 2.52 1.356 3.35.735.84 1.652 1.26 2.748 1.26.965 0 1.766-.29 2.4-.878.628-.576.94-1.365.94-2.368l-.007.004z"/>
                        </svg>
                    </div>
                    <p class="testimonial-text">{{ $testimonial->text }}</p>
                    <div class="testimonial-author">
                        @if($testimonial->hasMedia('avatar'))
                            <img src="{{ $testimonial->getFirstMediaUrl('avatar', 'thumb') }}" alt="{{ $testimonial->author_name }}" class="testimonial-avatar">
                        @else
                            <div class="testimonial-avatar-placeholder">{{ substr($testimonial->author_name, 0, 1) }}</div>
                        @endif
                        <div class="testimonial-info">
                            <h4>{{ $testimonial->author_name }}</h4>
                            <p>{{ $testimonial->author_position }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container" data-aos="fade-up">
            <h2 class="cta-title">{{ __('site.portfolio.page.cta_title') }}</h2>
            <p class="cta-text">{{ __('site.portfolio.page.cta_text') }}</p>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="cta-btn">
                {{ __('site.portfolio.page.cta_btn') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>
@endsection
