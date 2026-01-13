@extends('layouts.meetup')

@section('title', __('site.team.page.title') . ' - MEETUP Event & Production')
@section('description', __('site.team.page.description'))

@section('content')
    <!-- Hero Section -->
    <section class="team-hero">
        <img class="team-hero-bg" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920" alt="{{ __('site.team.page.title') }}">
        <div class="team-hero-breadcrumb">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <span>{{ __('site.nav.team') }}</span>
        </div>
        <div class="team-hero-content" data-aos="fade-up">
            <span class="section-subtitle">{{ __('site.team.page.hero_subtitle') }}</span>
            <h1 class="team-hero-title hero-title--lines">{{ __('site.team.page.hero_title') }}</h1>
            <p class="team-hero-text">{{ __('site.team.page.hero_text') }}</p>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="team-hero-btn">
                {{ __('site.team.page.hero_btn') }}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>

    <!-- Leadership Section -->
    @if($leaders->count() > 0)
    <section class="leadership-section">
        <div class="leadership-container">
            <div class="leadership-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.team.page.leadership_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.team.page.leadership_title') }}</h2>
            </div>
            <div class="leadership-grid">
                @foreach($leaders as $index => $leader)
                <a href="{{ route('team.show', ['locale' => app()->getLocale(), 'slug' => $leader->slug]) }}" class="leader-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="leader-photo">
                        <img src="{{ $leader->avatar_medium }}" alt="{{ $leader->getTranslation('name') }}">
                    </div>
                    <h3 class="leader-name">{{ $leader->getTranslation('name') }}</h3>
                    <p class="leader-position">{{ $leader->getTranslation('position') }}</p>
                    @if($leader->getTranslation('bio'))
                    <p class="leader-bio">{{ Str::limit($leader->getTranslation('bio'), 120) }}</p>
                    @endif
                    @if($leader->social_links && count($leader->social_links) > 0)
                    <div class="leader-socials">
                        @foreach($leader->social_links as $social)
                            @if(isset($social['url']) && isset($social['platform']))
                            <span class="social-icon">
                                @if($social['platform'] === 'linkedin')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect x="2" y="9" width="4" height="12"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                                @elseif($social['platform'] === 'instagram')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                                @elseif($social['platform'] === 'facebook')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                </svg>
                                @elseif($social['platform'] === 'twitter' || $social['platform'] === 'x')
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                                @endif
                            </span>
                            @endif
                        @endforeach
                    </div>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Team Grid Section -->
    @if($teamMembers->count() > 0)
    <section class="team-section">
        <div class="team-container">
            <div class="team-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.team.page.team_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.team.page.team_title') }}</h2>
            </div>
            <div class="team-grid">
                @foreach($teamMembers as $index => $member)
                <div class="team-card" data-aos="fade-up" data-aos-delay="{{ (($index % 4) + 1) * 50 }}">
                    <div class="team-card-photo">
                        <img src="{{ $member->avatar_medium }}" alt="{{ $member->getTranslation('name') }}">
                    </div>
                    <div class="team-card-info">
                        <h3 class="team-card-name">{{ $member->getTranslation('name') }}</h3>
                        <p class="team-card-position">{{ $member->getTranslation('position') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Values Section -->
    <section class="values-section">
        <div class="values-container">
            <div class="values-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.team.page.values_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.team.page.values_title') }}</h2>
            </div>
            <div class="values-grid">
                <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="value-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </div>
                    <h3>{{ __('site.team.page.value_1_title') }}</h3>
                    <p>{{ __('site.team.page.value_1_text') }}</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="value-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <h3>{{ __('site.team.page.value_2_title') }}</h3>
                    <p>{{ __('site.team.page.value_2_text') }}</p>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="value-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3>{{ __('site.team.page.value_3_title') }}</h3>
                    <p>{{ __('site.team.page.value_3_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Section -->
    <section class="join-section">
        <div class="join-container">
            <div class="join-content" data-aos="fade-right">
                <span class="section-subtitle">{{ __('site.team.page.join_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.team.page.join_title') }}</h2>
                <p class="join-text">{{ __('site.team.page.join_text') }}</p>
                <ul class="join-benefits">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{ __('site.team.page.join_benefit_1') }}
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{ __('site.team.page.join_benefit_2') }}
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{ __('site.team.page.join_benefit_3') }}
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        {{ __('site.team.page.join_benefit_4') }}
                    </li>
                </ul>
                <a href="mailto:hr@meetup.az" class="join-btn">
                    {{ __('site.team.page.join_btn') }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            <div class="join-image" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800" alt="{{ __('site.team.page.join_title') }}">
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container" data-aos="fade-up">
            <h2 class="cta-title">{{ __('site.team.page.cta_title') }}</h2>
            <p class="cta-text">{{ __('site.team.page.cta_text') }}</p>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="cta-btn">
                {{ __('site.team.page.cta_btn') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>
@endsection
