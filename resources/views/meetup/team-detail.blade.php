@extends('layouts.meetup')

@section('title', $member->getTranslation('name') . ' - ' . __('site.nav.team') . ' | MEETUP')
@section('description', Str::limit($member->getTranslation('bio'), 160))

@section('content')
    <!-- Profile Hero -->
    <section class="profile-hero">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <a href="{{ route('team', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.team') }}</a>
            <span>/</span>
            <span class="breadcrumb-current">{{ $member->getTranslation('name') }}</span>
        </div>
        <div class="profile-hero-container">
            <div class="profile-photo-wrapper" data-aos="fade-right">
                <div class="profile-photo">
                    <img src="{{ $member->avatar_medium }}" alt="{{ $member->getTranslation('name') }}">
                </div>
                <div class="profile-socials">
                    @if($member->social_links && count($member->social_links) > 0)
                        @foreach($member->social_links as $social)
                            @if(isset($social['url']) && isset($social['platform']))
                            <a href="{{ $social['url'] }}" target="_blank" aria-label="{{ ucfirst($social['platform']) }}">
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
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                                @elseif($social['platform'] === 'twitter' || $social['platform'] === 'x')
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                                @endif
                            </a>
                            @endif
                        @endforeach
                    @endif
                    @if($member->email)
                    <a href="mailto:{{ $member->email }}" aria-label="Email">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
            <div class="profile-content" data-aos="fade-left">
                <span class="profile-position">{{ $member->getTranslation('position') }}</span>
                <h1 class="profile-name">{{ $member->getTranslation('name') }}</h1>
                @if($member->getTranslation('tagline'))
                <p class="profile-tagline">{{ $member->getTranslation('tagline') }}</p>
                @endif
                @if($member->getTranslation('bio'))
                <div class="profile-bio">
                    {!! nl2br(e($member->getTranslation('bio'))) !!}
                </div>
                @endif
                @if($member->stats && count($member->stats) > 0)
                <div class="profile-stats">
                    @foreach($member->stats as $stat)
                    @if(isset($stat['number']) && isset($stat['label']))
                    <div class="profile-stat">
                        <div class="profile-stat-number">{{ $stat['number'] }}</div>
                        <div class="profile-stat-label">{{ $stat['label'] }}</div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    @if($member->skills && count($member->skills) > 0)
    <section class="skills-section">
        <div class="skills-container">
            <div class="skills-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.team_detail.expertise') }}</span>
                <h2 class="section-title">{{ __('site.team_detail.skills_title') }}</h2>
            </div>
            <div class="skills-grid">
                @foreach($member->skills as $index => $skill)
                @if(isset($skill['title']))
                <div class="skill-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="skill-icon">
                        @switch($skill['icon'] ?? 'star')
                            @case('layers')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                    <path d="M2 17l10 5 10-5"></path>
                                    <path d="M2 12l10 5 10-5"></path>
                                </svg>
                                @break
                            @case('users')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                @break
                            @case('globe')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                </svg>
                                @break
                            @case('star')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                @break
                            @case('target')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="6"></circle>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                                @break
                            @case('award')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="7"></circle>
                                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                                </svg>
                                @break
                            @case('briefcase')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                @break
                            @case('heart')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                                @break
                            @case('zap')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                </svg>
                                @break
                            @case('compass')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                                </svg>
                                @break
                            @default
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                        @endswitch
                    </div>
                    <h3>{{ $skill['title'] }}</h3>
                    @if(isset($skill['description']) && $skill['description'])
                    <p>{{ $skill['description'] }}</p>
                    @endif
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Other Team Members -->
    @if($otherMembers->count() > 0)
    <section class="other-team">
        <div class="other-team-container">
            <div class="other-team-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.team_detail.other_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.team_detail.other_title') }}</h2>
            </div>
            <div class="other-team-grid">
                @foreach($otherMembers as $index => $other)
                <a href="{{ route('team.show', ['locale' => app()->getLocale(), 'slug' => $other->slug]) }}" class="other-team-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="other-team-photo">
                        <img src="{{ $other->avatar_thumb }}" alt="{{ $other->getTranslation('name') }}">
                    </div>
                    <h3>{{ $other->getTranslation('name') }}</h3>
                    <p>{{ $other->getTranslation('position') }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container" data-aos="fade-up">
            <h2 class="cta-title">{{ __('site.team_detail.cta_title') }}</h2>
            <p class="cta-text">{{ __('site.team_detail.cta_text') }}</p>
            @if($member->email)
            <a href="mailto:{{ $member->email }}" class="cta-btn">
                {{ __('site.team_detail.cta_btn') }} {{ $member->getTranslation('name') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
            @else
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="cta-btn">
                {{ __('site.team_detail.cta_btn_contact') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
            @endif
        </div>
    </section>
@endsection
