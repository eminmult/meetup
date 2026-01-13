@extends('layouts.meetup')

@section('title', $service->title . ' - MEETUP Event & Production')
@section('description', $service->meta_description ?? Str::limit(strip_tags($service->description), 160))

@section('content')
    <!-- Hero Section -->
    <section class="service-hero">
        @if($service->featured_image)
            <img class="service-hero-bg" src="{{ $service->featured_image }}" alt="{{ $service->title }}">
        @else
            <img class="service-hero-bg" src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1920" alt="{{ $service->title }}">
        @endif
        <div class="service-hero-breadcrumb">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <a href="{{ route('services', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.services') }}</a>
            <span>/</span>
            <span>{{ $service->title }}</span>
        </div>
        <div class="service-hero-content" data-aos="fade-up">
            <span class="section-subtitle">{{ __('site.services.subtitle') }}</span>
            <h1 class="service-hero-title">{{ $service->title }}</h1>
            @if($service->excerpt)
                <p class="service-hero-text">{{ $service->excerpt }}</p>
            @endif
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="service-hero-btn">
                {{ __('site.services.page.hero_btn') }}
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>

    <!-- About Service -->
    @if($service->content)
    <section class="about-service">
        <div class="about-service-container">
            <div class="about-service-content" data-aos="fade-right">
                <span class="section-subtitle">{{ __('site.service_detail.about_subtitle') }}</span>
                <h2 class="section-title">{{ $service->title }}</h2>
                <div class="about-service-text prose">
                    {!! $service->content !!}
                </div>
            </div>
            @php
                $gallery = $service->getMedia('service-gallery');
            @endphp
            @if($gallery->count() > 1)
            <div class="about-service-gallery" data-aos="fade-left">
                @foreach($gallery->take(3) as $index => $media)
                <div class="about-service-gallery-item">
                    <img src="{{ $media->getUrl('medium') }}" alt="{{ $service->title }}">
                </div>
                @endforeach
            </div>
            @elseif($service->featured_image)
            <div class="about-service-gallery" data-aos="fade-left">
                <div class="about-service-gallery-item single">
                    <img src="{{ $service->featured_image }}" alt="{{ $service->title }}">
                </div>
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- Offers Section -->
    @if($service->offers && count($service->offers) > 0)
    <section class="offers-section">
        <div class="offers-container">
            <div class="offers-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.service_detail.offers_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.service_detail.offers_title') }}</h2>
            </div>
            <div class="offers-grid">
                @php
                    $locale = app()->getLocale();
                    $icons = [
                        'layers' => '<path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path>',
                        'calendar' => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>',
                        'star' => '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>',
                        'play' => '<circle cx="12" cy="12" r="10"></circle><polygon points="10 8 16 12 10 16 10 8"></polygon>',
                        'users' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>',
                        'briefcase' => '<rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>',
                        'mic' => '<path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8" y1="23" x2="16" y2="23"></line>',
                        'camera' => '<path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle>',
                        'music' => '<path d="M9 18V5l12-2v13"></path><circle cx="6" cy="18" r="3"></circle><circle cx="18" cy="16" r="3"></circle>',
                        'gift' => '<polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>',
                        'heart' => '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>',
                        'map' => '<polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line>',
                        'truck' => '<rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle>',
                        'settings' => '<circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>',
                        'zap' => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>',
                        'award' => '<circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>',
                    ];
                @endphp
                @foreach($service->offers as $index => $offer)
                <div class="offer-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="offer-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            {!! $icons[$offer['icon']] ?? $icons['star'] !!}
                        </svg>
                    </div>
                    <h3>{{ $offer['title_' . $locale] ?? $offer['title_ru'] ?? '' }}</h3>
                    <p>{{ $offer['description_' . $locale] ?? $offer['description_ru'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Gallery Slider -->
    @php
        $gallery = $service->getMedia('service-gallery');
    @endphp
    @if($gallery->count() > 1)
    <section class="portfolio-section">
        <div class="portfolio-container">
            <div class="portfolio-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.service_detail.gallery_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.service_detail.gallery_title') }}</h2>
            </div>
            <div class="swiper portfolio-slider" data-aos="fade-up">
                <div class="swiper-wrapper">
                    @foreach($gallery as $media)
                    <div class="swiper-slide portfolio-slide">
                        <img src="{{ $media->getUrl('large') }}" alt="{{ $service->title }}">
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    @endif

    <!-- Process Section -->
    @if($service->process && count($service->process) > 0)
    <section class="process-section">
        <div class="process-container">
            <div class="process-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.service_detail.process_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.service_detail.process_title') }}</h2>
            </div>
            <div class="process-timeline">
                @php $locale = app()->getLocale(); @endphp
                @foreach($service->process as $index => $step)
                <div class="process-item" data-aos="fade-up">
                    <div class="process-number">{{ $index + 1 }}</div>
                    <div class="process-item-content">
                        <h3>{{ $step['title_' . $locale] ?? $step['title_ru'] ?? '' }}</h3>
                        <p>{{ $step['description_' . $locale] ?? $step['description_ru'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Pricing Section -->
    @if($service->pricing && count($service->pricing) > 0)
    <section class="pricing-section">
        <div class="pricing-container">
            <div class="pricing-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.service_detail.pricing_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.service_detail.pricing_title') }}</h2>
            </div>
            <div class="pricing-grid">
                @php $locale = app()->getLocale(); @endphp
                @foreach($service->pricing as $index => $package)
                <div class="pricing-card{{ !empty($package['is_featured']) ? ' featured' : '' }}" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    @if(!empty($package['is_featured']))
                    <div class="pricing-badge">{{ __('site.service_detail.pricing_popular') }}</div>
                    @endif
                    <h3 class="pricing-name">{{ $package['name_' . $locale] ?? $package['name_ru'] ?? '' }}</h3>
                    @if(!empty($package['guests_' . $locale]) || !empty($package['guests_ru']))
                    <p class="pricing-guests">{{ $package['guests_' . $locale] ?? $package['guests_ru'] ?? '' }}</p>
                    @endif
                    <div class="pricing-price">
                        <span>{{ $package['price'] ?? '' }}</span>
                        <small>AZN</small>
                    </div>
                    @php
                        $features = $package['features_' . $locale] ?? $package['features_ru'] ?? '';
                        $featuresList = array_filter(array_map('trim', explode("\n", $features)));
                    @endphp
                    @if(count($featuresList) > 0)
                    <ul class="pricing-features">
                        @foreach($featuresList as $feature)
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="pricing-btn">{{ __('site.service_detail.pricing_btn') }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- FAQ Section -->
    @if($service->faq && count($service->faq) > 0)
    <section class="faq-section">
        <div class="faq-container">
            <div class="faq-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.service_detail.faq_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.service_detail.faq_title') }}</h2>
            </div>
            @php $locale = app()->getLocale(); @endphp
            @foreach($service->faq as $index => $item)
            <div class="faq-item" data-aos="fade-up">
                <button class="faq-question">
                    {{ $item['question_' . $locale] ?? $item['question_ru'] ?? '' }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        {{ $item['answer_' . $locale] ?? $item['answer_ru'] ?? '' }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Other Services -->
    @if($otherServices->count() > 0)
    <section class="services-overview other-services">
        <div class="services-overview-container">
            <div class="services-overview-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.service_detail.other_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.service_detail.other_title') }}</h2>
            </div>
            <div class="services-grid">
                @foreach($otherServices as $otherService)
                <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="service-card-image">
                        <a href="{{ route('service.show', ['locale' => app()->getLocale(), 'slug' => $otherService->slug]) }}">
                            @if($otherService->featured_image_medium)
                                <img src="{{ $otherService->featured_image_medium }}" alt="{{ $otherService->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600" alt="{{ $otherService->title }}">
                            @endif
                        </a>
                    </div>
                    <div class="service-card-content">
                        <h3>{{ $otherService->title }}</h3>
                        <p>{{ $otherService->description ? Str::limit(strip_tags($otherService->description), 100) : '' }}</p>
                        <a href="{{ route('service.show', ['locale' => app()->getLocale(), 'slug' => $otherService->slug]) }}" class="service-card-link">
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
    @endif

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
