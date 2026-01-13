@extends('layouts.meetup')

@php
    $locale = app()->getLocale();
    $t = $page ? $page->getTranslation($locale) : [];
    $sections = $page ? $page->sections : [];
@endphp

@section('title', $page && isset($page->seo[$locale]['title']) ? $page->seo[$locale]['title'] : 'MEETUP - Event & Production | Baku')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="swiper hero-slider">
            <div class="swiper-wrapper">
                @if($portfolios->count() > 0)
                    @foreach($portfolios->take(3) as $portfolio)
                    <div class="swiper-slide hero-slide">
                        <div class="hero-slide-bg" style="background-image: url('{{ $portfolio->getFirstMediaUrl('portfolio-gallery') ?: 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1920' }}')"></div>
                    </div>
                    @endforeach
                @else
                    <div class="swiper-slide hero-slide">
                        <div class="hero-slide-bg" style="background-image: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1920')"></div>
                    </div>
                    <div class="swiper-slide hero-slide">
                        <div class="hero-slide-bg" style="background-image: url('https://images.unsplash.com/photo-1511578314322-379afb476865?w=1920')"></div>
                    </div>
                    <div class="swiper-slide hero-slide">
                        <div class="hero-slide-bg" style="background-image: url('https://images.unsplash.com/photo-1505236858219-8359eb29e329?w=1920')"></div>
                    </div>
                @endif
            </div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title hero-title--lines">{{ $t['hero_title'] ?? __('site.hero.title_1') . ' ' . __('site.hero.title_2') . ' ' . __('site.hero.title_3') }}</h1>
            <p class="hero-description">{{ $t['hero_description'] ?? __('site.hero.description') }}</p>
            <div class="hero-buttons">
                <a href="#contact" class="btn-primary">
                    {{ $t['hero_cta_primary'] ?? __('site.hero.cta_primary') }}
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="#portfolio" class="btn-secondary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="5 3 19 12 5 21 5 3"/>
                    </svg>
                    {{ $t['hero_cta_secondary'] ?? __('site.hero.cta_secondary') }}
                </a>
            </div>
        </div>
        <div class="hero-scroll">
            <span>{{ $t['hero_scroll'] ?? __('site.hero.scroll') }}</span>
            <div class="hero-scroll-line"></div>
        </div>
    </section>

    @php
        $about = $sections['about'] ?? [];
        $aboutT = $about[$locale] ?? [];
    @endphp
    <!-- About Section -->
    <section class="about" id="about">
        <div class="about-container">
            <div class="about-images" data-aos="fade-right">
                <div class="about-img about-img-1">
                    <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?w=600" alt="Event">
                </div>
                <div class="about-img about-img-2">
                    <img src="https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=600" alt="Event">
                </div>
                <div class="about-experience">
                    <div class="about-experience-number">{{ $about['years_number'] ?? 7 }}+</div>
                    <div class="about-experience-text">{{ $aboutT['years_label'] ?? __('site.about.years') }}</div>
                </div>
            </div>
            <div class="about-content" data-aos="fade-left">
                <span class="section-subtitle">{{ $aboutT['subtitle'] ?? __('site.about.subtitle') }}</span>
                <h2 class="section-title">{{ $aboutT['title'] ?? __('site.about.title') }}</h2>
                <p class="about-text">{{ $aboutT['text'] ?? __('site.about.text') }}</p>
                <div class="about-features">
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>
                        <span class="about-feature-text">{{ $aboutT['feature_1'] ?? __('site.about.feature_1') }}</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        </div>
                        <span class="about-feature-text">{{ $aboutT['feature_2'] ?? __('site.about.feature_2') }}</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <span class="about-feature-text">{{ $aboutT['feature_3'] ?? __('site.about.feature_3') }}</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                        <span class="about-feature-text">{{ $aboutT['feature_4'] ?? __('site.about.feature_4') }}</span>
                    </div>
                </div>
                <a href="#contact" class="btn-primary">
                    {{ $aboutT['learn_more'] ?? __('site.about.learn_more') }}
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    @php
        $partnersSection = $sections['partners'] ?? [];
        $partnersT = $partnersSection[$locale] ?? [];
    @endphp
    <!-- Partners Section -->
    @if($partners->count() > 0)
    <section class="partners">
        <div class="partners-title">{{ $partnersT['title'] ?? __('site.partners.title') }}</div>
        <div class="partners-marquee">
            <div class="partners-track">
                @foreach($partners as $partner)
                <div class="partner-logo">
                    @if($partner->website_url)
                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                    </a>
                    @else
                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                    @endif
                </div>
                @endforeach
                {{-- Duplicated for seamless marquee animation --}}
                @foreach($partners as $partner)
                <div class="partner-logo">
                    @if($partner->website_url)
                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                    </a>
                    @else
                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}">
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @php
        $teamSection = $sections['team'] ?? [];
        $teamT = $teamSection[$locale] ?? [];
    @endphp
    <!-- Team Section -->
    @if($teamMembers->count() > 0)
    <section class="team" id="team">
        <div class="team-header">
            <span class="section-subtitle">{{ $teamT['subtitle'] ?? __('site.team.subtitle') }}</span>
            <h2 class="section-title">{{ $teamT['title'] ?? __('site.team.title') }}</h2>
            <p style="color: var(--brown);">{{ $teamT['description'] ?? __('site.team.description') }}</p>
        </div>
        <div class="swiper team-slider">
            <div class="swiper-wrapper">
                @foreach($teamMembers as $member)
                <div class="swiper-slide team-slide">
                    <div class="team-card">
                        <div class="team-card-image">
                            <img src="{{ $member->avatar_url }}" alt="{{ $member->name }}">
                            <div class="team-card-overlay"></div>
                            @if($member->social_links)
                            <div class="team-card-social">
                                @foreach($member->social_links as $link)
                                    @if($link['platform'] == 'instagram')
                                    <a href="{{ $link['url'] }}" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
                                    @elseif($link['platform'] == 'linkedin')
                                    <a href="{{ $link['url'] }}" target="_blank"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a>
                                    @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="team-card-info">
                            <h3>{{ $member->name }}</h3>
                            <span>{{ $member->position }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="team-nav">
            <button class="team-nav-btn team-prev">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="team-nav-btn team-next">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </section>
    @endif

    @php
        $servicesSection = $sections['services'] ?? [];
        $servicesT = $servicesSection[$locale] ?? [];
    @endphp
    <!-- Services Section -->
    @if($services->count() > 0)
    <section class="services" id="services">
        <div class="services-header">
            <span class="section-subtitle">{{ $servicesT['subtitle'] ?? __('site.services.subtitle') }}</span>
            <h2 class="section-title">{{ $servicesT['title'] ?? __('site.services.title') }}</h2>
            <p style="opacity: 0.7;">{{ $servicesT['description'] ?? __('site.services.description') }}</p>
        </div>
        <div class="services-grid">
            @foreach($services as $index => $service)
            <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="service-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="service-icon">
                    @if($service->getFirstMediaUrl('service-gallery'))
                    <img src="{{ $service->getFirstMediaUrl('service-gallery', 'thumb') }}" alt="{{ $service->title }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px;">
                    @else
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    @endif
                </div>
                <h3 class="service-title">{{ $service->title }}</h3>
                <p class="service-description">{{ Str::limit(strip_tags($service->description), 100) }}</p>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    @php
        $portfolioSection = $sections['portfolio'] ?? [];
        $portfolioT = $portfolioSection[$locale] ?? [];
    @endphp
    <!-- Portfolio Section -->
    @if($portfolios->count() > 0)
    <section class="portfolio" id="portfolio">
        <div class="portfolio-header">
            <div>
                <span class="section-subtitle">{{ $portfolioT['subtitle'] ?? __('site.portfolio.subtitle') }}</span>
                <h2 class="section-title">{{ $portfolioT['title'] ?? __('site.portfolio.title') }}</h2>
            </div>
            <div class="portfolio-nav">
                <button class="portfolio-nav-btn portfolio-prev">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="portfolio-nav-btn portfolio-next">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="swiper portfolio-slider">
            <div class="swiper-wrapper">
                @foreach($portfolios as $portfolio)
                <div class="swiper-slide portfolio-slide">
                    <img src="{{ $portfolio->getFirstMediaUrl('portfolio-gallery') ?: 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=800' }}" alt="{{ $portfolio->title }}">
                    <div class="portfolio-slide-overlay">
                        @if($portfolio->category)
                        <div class="portfolio-slide-category">{{ $portfolio->category->name }}</div>
                        @endif
                        <h3 class="portfolio-slide-title">{{ $portfolio->title }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @php
        $statsSection = $sections['stats'] ?? [];
        $statsT = $statsSection[$locale] ?? [];
    @endphp
    <!-- Stats Section -->
    <section class="stats">
        <div class="stats-container">
            <div class="stat-item" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-number"><span class="counter" data-target="{{ $statsSection['events_number'] ?? 500 }}">0</span>+</div>
                <div class="stat-label">{{ $statsT['events_label'] ?? __('site.stats.events') }}</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number"><span class="counter" data-target="{{ $statsSection['guests_number'] ?? 50 }}">0</span>K+</div>
                <div class="stat-label">{{ $statsT['guests_label'] ?? __('site.stats.guests') }}</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number"><span class="counter" data-target="{{ $statsSection['years_number'] ?? 7 }}">0</span>+</div>
                <div class="stat-label">{{ $statsT['years_label'] ?? __('site.stats.years') }}</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number"><span class="counter" data-target="{{ $statsSection['team_number'] ?? 25 }}">0</span>+</div>
                <div class="stat-label">{{ $statsT['team_label'] ?? __('site.stats.team') }}</div>
            </div>
        </div>
    </section>

    @php
        $communitySection = $sections['community'] ?? [];
        $communityT = $communitySection[$locale] ?? [];
    @endphp
    <!-- Events Section (Home) -->
    @if($events->count() > 0)
    <section class="events-home" id="community">
        <div class="events-home-header">
            <span class="section-subtitle">{{ $communityT['subtitle'] ?? __('site.community.subtitle') }}</span>
            <h2 class="section-title">{{ $communityT['title'] ?? __('site.community.title') }}</h2>
            <p class="events-home-desc">{{ $communityT['description'] ?? __('site.community.description') }}</p>
        </div>
        <div class="events-home-grid">
            @foreach($events->take(4) as $index => $event)
                @php
                    $featuredImage = $event->getFirstMediaUrl('event-gallery', 'thumb');
                    $nextDate = $event->upcomingDates->first();
                @endphp
                <a href="{{ route('event.show', ['locale' => $locale, 'slug' => $event->slug]) }}"
                   class="event-home-card"
                   data-aos="fade-up"
                   data-aos-delay="{{ $index * 100 }}">

                    <!-- Card Image/Icon -->
                    <div class="event-home-visual">
                        @if($featuredImage)
                            <img src="{{ $featuredImage }}" alt="{{ $event->title }}" loading="lazy">
                        @endif
                        <div class="event-home-icon">{{ $event->icon ?: '📅' }}</div>
                        @if($nextDate)
                            <div class="event-home-date-badge">
                                <span class="date-num">{{ $nextDate->date->translatedFormat('d') }}</span>
                                <span class="date-month">{{ $nextDate->date->translatedFormat('M') }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Card Content -->
                    <div class="event-home-content">
                        <h3 class="event-home-title">{{ $event->title }}</h3>

                        @if($event->schedules->count() > 0)
                            <div class="event-home-schedule">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                <span>{{ __('events.days.' . $event->schedules->first()->day_of_week) }}, {{ $event->schedules->first()->formatted_time }}</span>
                            </div>
                        @elseif($nextDate)
                            <div class="event-home-schedule event-home-schedule--date">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                <span>{{ $nextDate->date->translatedFormat('d M') }}@if($nextDate->start_time), {{ $nextDate->formatted_time }}@endif</span>
                            </div>
                        @endif

                        <span class="event-home-link">
                            {{ __('site.events.details') }}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        @if($events->count() > 4)
            <div class="events-home-more" data-aos="fade-up">
                <a href="{{ route('events', ['locale' => $locale]) }}" class="events-home-btn">
                    {{ __('site.nav.events') }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        @endif
    </section>
    @endif

    @php
        $testimonialsSection = $sections['testimonials'] ?? [];
        $testimonialsT = $testimonialsSection[$locale] ?? [];
    @endphp
    <!-- Testimonials Section -->
    @if($testimonials->count() > 0)
    <section class="testimonials" id="testimonials">
        <div class="testimonials-header">
            <span class="section-subtitle">{{ $testimonialsT['subtitle'] ?? __('site.testimonials.subtitle') }}</span>
            <h2 class="section-title">{{ $testimonialsT['title'] ?? __('site.testimonials.title') }}</h2>
        </div>
        <div class="swiper testimonials-slider">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">"</div>
                        <p class="testimonial-text">{{ $testimonial->text }}</p>
                        <div class="testimonial-author">
                            <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->author_name }}" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h4>{{ $testimonial->author_name }}</h4>
                                <span>{{ $testimonial->author_position }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="testimonials-pagination"></div>
        </div>
    </section>
    @endif

    @php
        $ctaSection = $sections['cta'] ?? [];
        $ctaT = $ctaSection[$locale] ?? [];
    @endphp
    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-content">
            <span class="section-subtitle">{{ $ctaT['subtitle'] ?? __('site.cta.subtitle') }}</span>
            <h2 class="cta-title">{{ $ctaT['title'] ?? __('site.cta.title') }}</h2>
            <p class="cta-text">{{ $ctaT['description'] ?? __('site.cta.description') }}</p>
            <a href="#contact" class="btn-primary">
                {{ $ctaT['button'] ?? __('site.cta.button') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </section>

    @php
        $contactSection = $sections['contact'] ?? [];
        $contactT = $contactSection[$locale] ?? [];
    @endphp
    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="contact-container">
            <div class="contact-info" data-aos="fade-right">
                <span class="section-subtitle">{{ $contactT['subtitle'] ?? __('site.contact.subtitle') }}</span>
                <h2 class="section-title">{{ $contactT['title'] ?? __('site.contact.title') }}</h2>
                <p>{{ $contactT['description'] ?? __('site.contact.description') }}</p>
                <div class="contact-details">
                    <div class="contact-detail">
                        <div class="contact-detail-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="contact-detail-text">
                            <strong>{{ $contactT['address_label'] ?? __('site.contact.address_label') }}</strong>
                            {{ $contactT['address'] ?? __('site.contact.address') }}
                        </div>
                    </div>
                    <div class="contact-detail">
                        <div class="contact-detail-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact-detail-text">
                            <strong>{{ $contactT['phone_label'] ?? __('site.contact.phone_label') }}</strong>
                            {{ $contactSection['phone'] ?? '+994 50 123 45 67' }}
                        </div>
                    </div>
                    <div class="contact-detail">
                        <div class="contact-detail-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div class="contact-detail-text">
                            <strong>{{ $contactT['email_label'] ?? __('site.contact.email_label') }}</strong>
                            {{ $contactSection['email'] ?? 'info@meetup.az' }}
                        </div>
                    </div>
                </div>
                <div class="contact-social">
                    @if(!empty($contactSection['instagram']))
                    <a href="{{ $contactSection['instagram'] }}" aria-label="Instagram" target="_blank">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </a>
                    @endif
                    @if(!empty($contactSection['facebook']))
                    <a href="{{ $contactSection['facebook'] }}" aria-label="Facebook" target="_blank">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    @endif
                    @if(!empty($contactSection['linkedin']))
                    <a href="{{ $contactSection['linkedin'] }}" aria-label="LinkedIn" target="_blank">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                            <rect x="2" y="9" width="4" height="12"/>
                            <circle cx="4" cy="4" r="2"/>
                        </svg>
                    </a>
                    @endif
                    @if(!empty($contactSection['whatsapp']))
                    <a href="{{ $contactSection['whatsapp'] }}" aria-label="WhatsApp" target="_blank">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            <div class="contact-form" data-aos="fade-left">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">{{ $contactT['form_name'] ?? __('site.contact.form.name') }}</label>
                            <input type="text" id="name" placeholder="{{ $contactT['form_name_placeholder'] ?? __('site.contact.form.name_placeholder') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ $contactT['form_phone'] ?? __('site.contact.form.phone') }}</label>
                            <input type="tel" id="phone" placeholder="+994">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ $contactT['form_email'] ?? __('site.contact.form.email') }}</label>
                        <input type="email" id="email" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                        <label for="event-type">{{ $contactT['form_event_type'] ?? __('site.contact.form.event_type') }}</label>
                        <select id="event-type">
                            <option value="">{{ $contactT['form_event_placeholder'] ?? __('site.contact.form.event_type_placeholder') }}</option>
                            <option value="corporate">{{ $contactT['form_event_corporate'] ?? __('site.contact.form.event_corporate') }}</option>
                            <option value="wedding">{{ $contactT['form_event_wedding'] ?? __('site.contact.form.event_wedding') }}</option>
                            <option value="birthday">{{ $contactT['form_event_birthday'] ?? __('site.contact.form.event_birthday') }}</option>
                            <option value="conference">{{ $contactT['form_event_conference'] ?? __('site.contact.form.event_conference') }}</option>
                            <option value="networking">{{ $contactT['form_event_networking'] ?? __('site.contact.form.event_networking') }}</option>
                            <option value="other">{{ $contactT['form_event_other'] ?? __('site.contact.form.event_other') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">{{ $contactT['form_message'] ?? __('site.contact.form.message') }}</label>
                        <textarea id="message" placeholder="{{ $contactT['form_message_placeholder'] ?? __('site.contact.form.message_placeholder') }}"></textarea>
                    </div>
                    <button type="submit" class="form-submit">{{ $contactT['form_submit'] ?? __('site.contact.form.submit') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
