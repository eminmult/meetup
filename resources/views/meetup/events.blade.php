@extends('layouts.meetup')

@section('title', ($page ? $page->getTranslation('title') : __('site.nav.events')) . ' - MEETUP Event & Production')
@section('description', $page ? $page->getTranslation('hero_text') : '')

@section('content')
    @php
        $locale = app()->getLocale();
    @endphp

    <!-- Hero Section -->
    <section class="events-hero">
        <img class="events-hero-bg" src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1920" alt="{{ __('site.nav.events') }}">
        <div class="events-hero-breadcrumb">
            <a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <span>{{ __('site.nav.events') }}</span>
        </div>
        <div class="events-hero-content" data-aos="fade-up">
            <span class="section-subtitle">{{ $page?->getTranslation('hero_subtitle') ?? __('site.nav.events') }}</span>
            <h1 class="events-hero-title hero-title--lines">{{ $page?->getTranslation('hero_title') ?? __('site.nav.events') }}</h1>
            @if($page?->getTranslation('hero_text'))
                <p class="events-hero-text">{{ $page->getTranslation('hero_text') }}</p>
            @endif
        </div>
    </section>

    <!-- Events List -->
    <section class="events-section">
        <div class="events-container">
            @if($events->count() > 0)
                <div class="events-list">
                    @foreach($events as $index => $event)
                        @php
                            $featuredImage = $event->getFirstMediaUrl('event-gallery', 'medium');
                            $nextDate = $event->upcomingDates->first();
                        @endphp
                        <article class="event-card-v2" data-aos="fade-up" data-aos-delay="{{ (($index % 2) + 1) * 100 }}">
                            <!-- Image Section -->
                            <div class="event-card-image">
                                @if($featuredImage)
                                    <img src="{{ $featuredImage }}" alt="{{ $event->title }}" loading="lazy">
                                @else
                                    <div class="event-card-placeholder">
                                        <span class="event-card-emoji">{{ $event->icon ?? '🎭' }}</span>
                                    </div>
                                @endif
                                @if($nextDate)
                                    <div class="event-card-badge">
                                        <span class="badge-day">{{ $nextDate->date->translatedFormat('d') }}</span>
                                        <span class="badge-month">{{ $nextDate->date->translatedFormat('M') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Content Section -->
                            <div class="event-card-body">
                                <div class="event-card-icon">{{ $event->icon ?? '🎭' }}</div>
                                <h3 class="event-card-title">{{ $event->title }}</h3>

                                @if($event->description)
                                    <p class="event-card-desc">{{ Str::limit(strip_tags($event->description), 120) }}</p>
                                @endif

                                <!-- Schedule Info -->
                                <div class="event-card-info">
                                    @if($event->schedules->count() > 0)
                                        <div class="event-info-block">
                                            <div class="info-icon">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                                </svg>
                                            </div>
                                            <div class="info-content">
                                                <span class="info-label">{{ __('events.sections.regular_schedule') }}</span>
                                                @foreach($event->schedules->take(2) as $schedule)
                                                    <span class="info-value">{{ __('events.days.' . $schedule->day_of_week) }}, {{ $schedule->formatted_time }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if($event->upcomingDates->count() > 0)
                                        <div class="event-info-block">
                                            <div class="info-icon info-icon--highlight">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                            </div>
                                            <div class="info-content">
                                                <span class="info-label">{{ __('site.events.upcoming_dates') }}</span>
                                                @foreach($event->upcomingDates->take(2) as $date)
                                                    <span class="info-value info-value--date">
                                                        {{ $date->date->translatedFormat('d M') }}@if($date->start_time), {{ $date->formatted_time }}@endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- CTA -->
                                <a href="{{ route('event.show', ['locale' => $locale, 'slug' => $event->slug]) }}" class="event-card-btn">
                                    <span>{{ __('site.events.details') }}</span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="events-empty" data-aos="fade-up">
                    <div class="events-empty-icon">📅</div>
                    <p>{{ __('site.events.no_events') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container" data-aos="fade-up">
            <h2 class="cta-title">{{ $page?->sections['cta'][$locale]['title'] ?? __('site.cta.title') }}</h2>
            <p class="cta-text">{{ $page?->sections['cta'][$locale]['text'] ?? __('site.cta.description') }}</p>
            <a href="{{ route('contact', ['locale' => $locale]) }}" class="cta-btn">
                {{ $page?->sections['cta'][$locale]['btn_text'] ?? __('site.cta.button') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>
@endsection
