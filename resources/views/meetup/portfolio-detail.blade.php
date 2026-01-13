@extends('layouts.meetup')

@section('title', $portfolio->client_name . ' - ' . __('site.portfolio.page.title') . ' | MEETUP')
@section('description', Str::limit(strip_tags($portfolio->description), 160))

@section('content')
    <!-- Hero Section -->
    <section class="case-hero">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.home') }}</a>
            <span>/</span>
            <a href="{{ route('portfolio', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.portfolio') }}</a>
            <span>/</span>
            <span class="breadcrumb-current">{{ $portfolio->client_name }}</span>
        </div>

        <div class="case-hero-container">
            <div class="client-logo-block" data-aos="fade-right">
                <div class="client-logo-wrapper">
                    @if($portfolio->client_logo)
                        <img src="{{ $portfolio->client_logo }}" alt="{{ $portfolio->client_name }}" class="client-logo-large">
                    @else
                        <span class="client-name-large">{{ $portfolio->client_name }}</span>
                    @endif
                </div>
                @if($portfolio->social_links && count($portfolio->social_links) > 0)
                <div class="client-socials">
                    @if($portfolio->website_url)
                    <a href="{{ $portfolio->website_url }}" target="_blank" title="Website">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                    </a>
                    @endif
                    @foreach($portfolio->social_links as $social)
                        @if(isset($social['url']) && isset($social['type']))
                        <a href="{{ $social['url'] }}" target="_blank" title="{{ ucfirst($social['type']) }}">
                            @if($social['type'] === 'instagram')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <circle cx="12" cy="12" r="4"></circle>
                                <circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"></circle>
                            </svg>
                            @elseif($social['type'] === 'facebook')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                            @elseif($social['type'] === 'youtube')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="4" width="20" height="16" rx="4"/>
                                <polygon points="10 8 16 12 10 16 10 8" fill="currentColor"/>
                            </svg>
                            @elseif($social['type'] === 'twitter' || $social['type'] === 'x')
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                            @elseif($social['type'] === 'linkedin')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                            @endif
                        </a>
                        @endif
                    @endforeach
                </div>
                @endif
            </div>
            <div class="case-hero-content" data-aos="fade-left">
                <h1 class="case-title">{!! nl2br(e($portfolio->title)) !!}</h1>
                @if($portfolio->description)
                <p class="case-description">{{ $portfolio->description }}</p>
                @endif
                <div class="case-links">
                    @if($portfolio->getMedia('portfolio-gallery')->count() > 0)
                    <a href="#gallery" class="case-link primary">
                        {{ __('site.portfolio_detail.view_gallery') }}
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    </a>
                    @endif
                    @if($portfolio->video_url)
                    <a href="#video" class="case-link outline">
                        {{ __('site.portfolio_detail.watch_video') }}
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="case-hero-scroll">
            <span>{{ __('site.portfolio_detail.scroll') }}</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
    </section>

    <!-- Gallery Section -->
    @php
        $galleryImages = $portfolio->getMedia('portfolio-gallery');
    @endphp
    @if($galleryImages->count() > 0)
    <section class="gallery-section" id="gallery">
        <div class="gallery-container">
            <div class="gallery-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.portfolio_detail.gallery_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.portfolio_detail.gallery_title') }}</h2>
            </div>
            <div class="gallery-grid">
                @foreach($galleryImages as $index => $image)
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="{{ ($index % 5) * 50 }}" data-index="{{ $index }}">
                    <img src="{{ $image->getUrl('medium') }}" alt="{{ $portfolio->title }}" data-large="{{ $image->getUrl('large') }}">
                    <div class="gallery-item-overlay">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            <line x1="11" y1="8" x2="11" y2="14"></line>
                            <line x1="8" y1="11" x2="14" y2="11"></line>
                        </svg>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-content">
            <button class="lightbox-close">&times;</button>
            <button class="lightbox-nav prev">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <img src="" alt="Gallery Image" id="lightbox-img">
            <button class="lightbox-nav next">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>
    @endif

    <!-- Video Section -->
    @if($portfolio->video_embed_url)
    <section class="video-section" id="video">
        <div class="video-container">
            <div class="video-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.portfolio_detail.video_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.portfolio_detail.video_title') }}</h2>
            </div>
            <div class="video-grid">
                <div class="video-main" data-aos="fade-up" data-aos-delay="100">
                    <div class="video-wrapper">
                        <iframe src="{{ $portfolio->video_embed_url }}" title="{{ $portfolio->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Content Section -->
    @if($portfolio->content)
    <section class="content-section">
        <div class="content-container" data-aos="fade-up">
            <div class="content-body">
                {!! $portfolio->content !!}
            </div>
        </div>
    </section>
    @endif

    <!-- Other Projects -->
    @if($otherPortfolios->count() > 0)
    <section class="other-projects">
        <div class="other-projects-container">
            <div class="other-projects-header" data-aos="fade-up">
                <span class="section-subtitle">{{ __('site.portfolio_detail.other_subtitle') }}</span>
                <h2 class="section-title">{{ __('site.portfolio_detail.other_title') }}</h2>
            </div>
            <div class="other-projects-grid">
                @foreach($otherPortfolios as $index => $otherPortfolio)
                <a href="{{ route('portfolio.show', ['locale' => app()->getLocale(), 'slug' => $otherPortfolio->slug]) }}" class="other-project-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 50 }}">
                    @if($otherPortfolio->client_logo)
                        <img src="{{ $otherPortfolio->client_logo }}" alt="{{ $otherPortfolio->client_name }}" class="other-project-logo">
                    @else
                        <span class="other-project-name">{{ $otherPortfolio->client_name }}</span>
                    @endif
                    <h3 class="other-project-title">{{ $otherPortfolio->client_name }}</h3>
                    <span class="other-project-type">{{ $otherPortfolio->title }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-container" data-aos="fade-up">
            <h2 class="cta-title">{{ __('site.portfolio_detail.cta_title') }}</h2>
            <p class="cta-text">{{ __('site.portfolio_detail.cta_text') }}</p>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="cta-btn">
                {{ __('site.portfolio_detail.cta_btn') }}
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const closeBtn = document.querySelector('.lightbox-close');
    const prevBtn = document.querySelector('.lightbox-nav.prev');
    const nextBtn = document.querySelector('.lightbox-nav.next');
    let currentIndex = 0;
    const images = [];

    galleryItems.forEach((item, index) => {
        const img = item.querySelector('img');
        images.push(img.dataset.large || img.src);

        item.addEventListener('click', function() {
            currentIndex = index;
            openLightbox(images[currentIndex]);
        });
    });

    function openLightbox(src) {
        lightboxImg.src = src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function showPrev() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        lightboxImg.src = images[currentIndex];
    }

    function showNext() {
        currentIndex = (currentIndex + 1) % images.length;
        lightboxImg.src = images[currentIndex];
    }

    if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
    if (prevBtn) prevBtn.addEventListener('click', showPrev);
    if (nextBtn) nextBtn.addEventListener('click', showNext);

    lightbox?.addEventListener('click', function(e) {
        if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', function(e) {
        if (!lightbox?.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') showPrev();
        if (e.key === 'ArrowRight') showNext();
    });
});
</script>
@endpush
