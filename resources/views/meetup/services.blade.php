@extends('layouts.meetup')

@section('title', __('site.nav.services') . ' - MEETUP Event & Production')
@section('description', __('site.services.description'))

@section('content')
    <!-- Hero Section -->
    <section class="services-hero">
        <div class="services-hero-breadcrumb">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <span>{{ __('site.nav.services') }}</span>
        </div>
        <div class="services-hero-content" data-aos="fade-up">
            <span class="section-subtitle">{{ __('site.services.page.hero_subtitle') }}</span>
            <h1 class="services-hero-title hero-title--lines">{{ strip_tags(__('site.services.page.hero_title')) }}</h1>
            <p class="services-hero-text">{{ __('site.services.page.hero_text') }}</p>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="services-hero-btn">
                {{ __('site.services.page.hero_btn') }}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="services-overview">
        <div class="services-overview-container">
            <div class="services-overview-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.services.page.overview_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.services.page.overview_title') }}</h2>
            </div>
            <div class="services-grid">
                @foreach($services as $index => $service)
                <div class="service-card" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                    <div class="service-card-image">
                        <a href="{{ route('service.show', ['locale' => app()->getLocale(), 'slug' => $service->slug]) }}">
                            @if($service->featured_image_medium)
                                <img src="{{ $service->featured_image_medium }}" alt="{{ $service->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600" alt="{{ $service->title }}">
                            @endif
                        </a>
                    </div>
                    <div class="service-card-content">
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description ? Str::limit(strip_tags($service->description), 120) : '' }}</p>
                        <a href="{{ route('service.show', ['locale' => app()->getLocale(), 'slug' => $service->slug]) }}" class="service-card-link">
                            {{ __('site.services.page.details_btn') }}
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section">
        <div class="process-container">
            <div class="process-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.services.page.process_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.services.page.process_title') }}</h2>
            </div>
            <div class="process-steps">
                <div class="process-step" data-aos="fade-up" data-aos-delay="100">
                    <div class="process-step-number"><span>1</span></div>
                    <h3>{{ __('site.services.page.process_1_title') }}</h3>
                    <p>{{ __('site.services.page.process_1_text') }}</p>
                </div>
                <div class="process-step" data-aos="fade-up" data-aos-delay="200">
                    <div class="process-step-number"><span>2</span></div>
                    <h3>{{ __('site.services.page.process_2_title') }}</h3>
                    <p>{{ __('site.services.page.process_2_text') }}</p>
                </div>
                <div class="process-step" data-aos="fade-up" data-aos-delay="300">
                    <div class="process-step-number"><span>3</span></div>
                    <h3>{{ __('site.services.page.process_3_title') }}</h3>
                    <p>{{ __('site.services.page.process_3_text') }}</p>
                </div>
                <div class="process-step" data-aos="fade-up" data-aos-delay="400">
                    <div class="process-step-number"><span>4</span></div>
                    <h3>{{ __('site.services.page.process_4_title') }}</h3>
                    <p>{{ __('site.services.page.process_4_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section class="packages-section">
        <div class="packages-container">
            <div class="packages-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.services.page.packages_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.services.page.packages_title') }}</h2>
            </div>
            <div class="packages-grid">
                <div class="package-card" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="package-name">{{ __('site.services.page.package_basic_name') }}</h3>
                    <p class="package-desc">{{ __('site.services.page.package_basic_desc') }}</p>
                    <div class="package-price">
                        <span>{{ __('site.services.page.package_basic_price') }}</span>
                        <small>{{ __('site.services.page.package_currency') }}</small>
                    </div>
                    <ul class="package-features">
                        @foreach(__('site.services.page.package_basic_features') as $feature)
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="package-btn">{{ __('site.services.page.package_btn') }}</a>
                </div>
                <div class="package-card featured" data-aos="fade-up" data-aos-delay="200">
                    <div class="package-badge">{{ __('site.services.page.package_standard_badge') }}</div>
                    <h3 class="package-name">{{ __('site.services.page.package_standard_name') }}</h3>
                    <p class="package-desc">{{ __('site.services.page.package_standard_desc') }}</p>
                    <div class="package-price">
                        <span>{{ __('site.services.page.package_standard_price') }}</span>
                        <small>{{ __('site.services.page.package_currency') }}</small>
                    </div>
                    <ul class="package-features">
                        @foreach(__('site.services.page.package_standard_features') as $feature)
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="package-btn">{{ __('site.services.page.package_btn') }}</a>
                </div>
                <div class="package-card" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="package-name">{{ __('site.services.page.package_premium_name') }}</h3>
                    <p class="package-desc">{{ __('site.services.page.package_premium_desc') }}</p>
                    <div class="package-price">
                        <span>{{ __('site.services.page.package_premium_price') }}</span>
                        <small>{{ __('site.services.page.package_currency') }}</small>
                    </div>
                    <ul class="package-features">
                        @foreach(__('site.services.page.package_premium_features') as $feature)
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="package-btn">{{ __('site.services.page.package_btn') }}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-container">
            <div class="faq-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.services.page.faq_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.services.page.faq_title') }}</h2>
            </div>
            @for($i = 1; $i <= 5; $i++)
            <div class="faq-item" data-aos="fade-up">
                <button class="faq-question">
                    {{ __('site.services.page.faq_' . $i . '_q') }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        {{ __('site.services.page.faq_' . $i . '_a') }}
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container" data-aos="fade-up">
            <h2 class="cta-title">{{ __('site.services.page.cta_title') }}</h2>
            <p class="cta-text">{{ __('site.services.page.cta_text') }}</p>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="cta-btn">
                {{ __('site.services.page.cta_btn') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>
@endsection
