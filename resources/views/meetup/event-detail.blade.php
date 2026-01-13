@extends('layouts.meetup')

@section('title', $event->title . ' - MEETUP Event & Production')
@section('description', Str::limit(strip_tags($event->description), 160))

@section('content')
    @php
        $locale = app()->getLocale();
        $labels = $page?->sections['labels'][$locale] ?? [];
    @endphp

    <!-- Hero Section -->
    <section class="event-detail-hero">
        @php
            $heroImage = $event->getFirstMediaUrl('event-gallery', 'large');
        @endphp
        <img class="event-detail-hero-bg" src="{{ $heroImage ?: asset('images/events/mafia-bg.webp') }}" alt="{{ $event->title }}">
        <div class="event-detail-breadcrumb">
            <a href="{{ route('home', ['locale' => $locale]) }}">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <a href="{{ route('events', ['locale' => $locale]) }}">{{ __('site.nav.events') }}</a>
            <span>/</span>
            <span>{{ Str::limit($event->title, 30) }}</span>
        </div>
        <div class="event-detail-hero-content" data-aos="fade-up">
            <span class="event-detail-icon">{{ $event->icon ?? '🎭' }}</span>
            <h1 class="event-detail-title">{{ $event->title }}</h1>
            @if($event->formatted_schedule)
                <div class="event-detail-schedule">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    {{ $event->formatted_schedule }}
                </div>
            @endif
        </div>
    </section>

    <!-- Content -->
    <section class="event-detail-content">
        <div class="event-detail-container">
            <div class="event-detail-main">
                <!-- Description -->
                @if($event->description)
                    <div class="event-detail-description" data-aos="fade-up">
                        <h2>{{ $labels['about'] ?? 'О событии' }}</h2>
                        <div class="event-description-text">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>
                @endif

                <!-- Gallery -->
                @php
                    $gallery = $event->getMedia('event-gallery');
                @endphp
                @if($gallery->count() > 0)
                    <div class="event-detail-gallery" data-aos="fade-up">
                        <h2>{{ $labels['gallery'] ?? 'Галерея' }}</h2>
                        <div class="event-gallery-grid">
                            @foreach($gallery as $media)
                                <a href="{{ $media->getUrl() }}" class="event-gallery-item" data-fancybox="event-gallery">
                                    <img src="{{ $media->getUrl('medium') }}" alt="{{ $event->title }}" loading="lazy">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Widgets (Videos) -->
                @if($event->widgets && $event->widgets->count() > 0)
                    <div class="event-detail-videos" data-aos="fade-up">
                        <h2>{{ $labels['videos'] ?? 'Видео' }}</h2>
                        <div class="event-videos-grid">
                            @foreach($event->widgets as $widget)
                                <div class="event-video-item">
                                    @if($widget->type === 'youtube')
                                        @php
                                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $widget->content, $matches);
                                            $videoId = $matches[1] ?? $widget->content;
                                        @endphp
                                        <div class="embed-responsive">
                                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    @elseif($widget->type === 'html')
                                        {!! $widget->content !!}
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="event-detail-sidebar">
                <!-- Upcoming Dates -->
                @if($event->upcomingDates->count() > 0)
                    <div class="event-sidebar-widget" data-aos="fade-up">
                        <h3>{{ $labels['upcoming_dates'] ?? 'Ближайшие даты' }}</h3>
                        <div class="event-dates-list">
                            @foreach($event->upcomingDates->take(5) as $date)
                                <div class="event-date-item">
                                    <div class="event-date-calendar">
                                        <span class="day">{{ $date->date->translatedFormat('d') }}</span>
                                        <span class="month">{{ $date->date->translatedFormat('M') }}</span>
                                    </div>
                                    <div class="event-date-info">
                                        <span class="weekday">{{ $date->date->translatedFormat('l') }}</span>
                                        @if($date->start_time)
                                            <span class="time">{{ $date->start_time }}@if($date->end_time) - {{ $date->end_time }}@endif</span>
                                        @endif
                                        @if($date->note)
                                            <span class="note">{{ $date->note }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Regular Schedule -->
                @if($event->schedules->count() > 0)
                    <div class="event-sidebar-widget" data-aos="fade-up" data-aos-delay="100">
                        <h3>{{ $labels['regular_schedule'] ?? 'Расписание' }}</h3>
                        <div class="event-schedule-list">
                            @foreach($event->schedules as $schedule)
                                <div class="event-schedule-item">
                                    <span class="day">{{ __('events.days.' . $schedule->day_of_week) }}</span>
                                    <span class="time">{{ $schedule->start_time }}@if($schedule->end_time) - {{ $schedule->end_time }}@endif</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- CTA -->
                <div class="event-sidebar-cta" data-aos="fade-up" data-aos-delay="200">
                    <h3>{{ $labels['cta_title'] ?? 'Хотите участвовать?' }}</h3>
                    <p>{{ $labels['cta_text'] ?? 'Свяжитесь с нами для регистрации' }}</p>
                    <a href="{{ route('contact', ['locale' => $locale]) }}" class="event-cta-btn">
                        {{ $labels['cta_btn'] ?? 'Связаться' }}
                    </a>
                </div>
            </aside>
        </div>
    </section>

    <!-- Other Events -->
    @if($otherEvents->count() > 0)
        <section class="events-other">
            <div class="events-other-container">
                <h2 class="events-other-title" data-aos="fade-up">{{ $labels['other_events'] ?? 'Другие события' }}</h2>
                <div class="events-other-grid">
                    @foreach($otherEvents as $index => $otherEvent)
                        <a href="{{ route('event.show', ['locale' => $locale, 'slug' => $otherEvent->slug]) }}" class="event-other-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <span class="event-other-icon">{{ $otherEvent->icon ?? '🎭' }}</span>
                            <h3>{{ $otherEvent->title }}</h3>
                            @if($otherEvent->upcomingDates->first())
                                <span class="event-other-date">{{ $otherEvent->upcomingDates->first()->date->translatedFormat('d M') }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
