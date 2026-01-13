@extends('layouts.meetup')

@section('title', $page->getSeoField('title') ?? $page->getTranslation('hero_title') ?? __('site.nav.contact') . ' | MEETUP')
@section('description', $page->getSeoField('description') ?? $page->getTranslation('hero_text'))

@section('content')
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="contact-hero-content" data-aos="fade-up">
            <span class="section-subtitle">{{ $page->getTranslation('hero_subtitle') ?? __('contact.page.subtitle') }}</span>
            <h1 class="contact-hero-title hero-title--lines">{{ strip_tags($page->getTranslation('hero_title') ?? __('contact.page.title')) }}</h1>
            <p class="contact-hero-text">{{ $page->getTranslation('hero_text') ?? __('contact.page.text') }}</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">
            <!-- Contact Form -->
            <div class="contact-form-wrapper" data-aos="fade-right">
                <div class="contact-form-header">
                    <h2>{{ $page->getSectionField('form', 'title') ?? __('contact.page.form_title') }}</h2>
                    <p>{{ $page->getSectionField('form', 'text') ?? __('contact.page.form_text') }}</p>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form class="contact-form" action="{{ route('contact.submit', ['locale' => app()->getLocale()]) }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">{{ $page->getSectionField('form', 'name_label') ?? __('contact.page.name_placeholder') }} *</label>
                            <input type="text" id="name" name="name" required placeholder="{{ $page->getSectionField('form', 'name_label') ?? __('contact.page.name_placeholder') }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ $page->getSectionField('form', 'phone_label') ?? __('contact.page.phone_placeholder') }} *</label>
                            <input type="tel" id="phone" name="phone" required placeholder="{{ $page->getSectionField('form', 'phone_label') ?? __('contact.page.phone_placeholder') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">{{ $page->getSectionField('form', 'email_label') ?? __('contact.page.email_placeholder') }}</label>
                            <input type="email" id="email" name="email" placeholder="{{ $page->getSectionField('form', 'email_label') ?? __('contact.page.email_placeholder') }}">
                        </div>
                        <div class="form-group">
                            <label for="service">{{ $page->getSectionField('form', 'service_label') ?? __('contact.page.service_placeholder') }}</label>
                            <select id="service" name="service">
                                <option value="">{{ $page->getSectionField('form', 'service_label') ?? __('contact.page.service_placeholder') }}</option>
                                @foreach($services ?? [] as $service)
                                <option value="{{ $service->id }}">{{ $service->getTranslation('title') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <label for="message">{{ $page->getSectionField('form', 'message_label') ?? __('contact.page.message_placeholder') }}</label>
                        <textarea id="message" name="message" rows="5" placeholder="{{ $page->getSectionField('form', 'message_label') ?? __('contact.page.message_placeholder') }}"></textarea>
                    </div>
                    <button type="submit" class="submit-btn">
                        {{ $page->getSectionField('form', 'submit_text') ?? __('contact.page.submit') }}
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info-wrapper" data-aos="fade-left">
                <div class="contact-info-card">
                    <h3>{{ $page->getSectionField('info', 'title') ?? __('contact.page.info_title') }}</h3>

                    <!-- Phones -->
                    @php
                        $phone1 = $page->sections['info']['phone_1'] ?? null;
                        $phone2 = $page->sections['info']['phone_2'] ?? null;
                    @endphp
                    @if($phone1 || $phone2)
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <span class="contact-info-label">{{ __('contact.page.phone_label') }}</span>
                            @if($phone1)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone1) }}" class="contact-info-value">{{ $phone1 }}</a>
                            @endif
                            @if($phone2)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone2) }}" class="contact-info-value">{{ $phone2 }}</a>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Emails -->
                    @php
                        $email1 = $page->sections['info']['email_1'] ?? null;
                        $email2 = $page->sections['info']['email_2'] ?? null;
                    @endphp
                    @if($email1 || $email2)
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <span class="contact-info-label">{{ __('contact.page.email_label') }}</span>
                            @if($email1)
                            <a href="mailto:{{ $email1 }}" class="contact-info-value">{{ $email1 }}</a>
                            @endif
                            @if($email2)
                            <a href="mailto:{{ $email2 }}" class="contact-info-value">{{ $email2 }}</a>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Address -->
                    @if($address = $page->getSectionField('info', 'address'))
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <span class="contact-info-label">{{ __('contact.page.address_label') }}</span>
                            <span class="contact-info-value">{{ $address }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Hours -->
                    @if($hours = $page->getSectionField('info', 'hours'))
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="contact-info-content">
                            <span class="contact-info-label">{{ __('contact.page.hours_label') }}</span>
                            <span class="contact-info-value">{!! nl2br(e($hours)) !!}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Social Links -->
                    @php
                        $social = $page->sections['social'] ?? [];
                        $hasSocial = !empty($social['instagram']) || !empty($social['facebook']) || !empty($social['linkedin']) || !empty($social['youtube']) || !empty($social['whatsapp']) || !empty($social['telegram']);
                    @endphp
                    @if($hasSocial)
                    <div class="contact-social">
                        <span class="contact-social-label">{{ __('contact.page.social_title') }}</span>
                        <div class="contact-social-links">
                            @if(!empty($social['instagram']))
                            <a href="{{ $social['instagram'] }}" target="_blank" rel="noopener" class="social-link" title="Instagram">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            @endif
                            @if(!empty($social['facebook']))
                            <a href="{{ $social['facebook'] }}" target="_blank" rel="noopener" class="social-link" title="Facebook">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            @endif
                            @if(!empty($social['linkedin']))
                            <a href="{{ $social['linkedin'] }}" target="_blank" rel="noopener" class="social-link" title="LinkedIn">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                            @endif
                            @if(!empty($social['youtube']))
                            <a href="{{ $social['youtube'] }}" target="_blank" rel="noopener" class="social-link" title="YouTube">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                            @endif
                            @if(!empty($social['whatsapp']))
                            <a href="{{ $social['whatsapp'] }}" target="_blank" rel="noopener" class="social-link" title="WhatsApp">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                            @endif
                            @if(!empty($social['telegram']))
                            <a href="{{ $social['telegram'] }}" target="_blank" rel="noopener" class="social-link" title="Telegram">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    @if($mapEmbed = $page->sections['map']['embed_url'] ?? null)
    <section class="map-section">
        <div class="map-container">
            <div class="map-header" data-aos="fade-up">
                <h2>{{ __('contact.page.map_title') }}</h2>
            </div>
            <div class="map-wrapper" data-aos="fade-up">
                <div class="map-embed">
                    <iframe
                        src="{{ $mapEmbed }}"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                @if($mapLink = $page->sections['map']['google_maps_link'] ?? null)
                <div class="map-info">
                    <div class="map-office">
                        @if($officeTitle = $page->getSectionField('map', 'office_title'))
                        <h3>{{ $officeTitle }}</h3>
                        @endif
                        @if($officeAddress = $page->getSectionField('map', 'office_address'))
                        <p>{{ $officeAddress }}</p>
                        @endif
                    </div>
                    <a href="{{ $mapLink }}" target="_blank" rel="noopener" class="map-link-btn">
                        {{ __('contact.page.open_map') }}
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- FAQ Section -->
    @if($faqItems = $page->sections['faq']['items'] ?? null)
    <section class="faq-section">
        <div class="faq-container">
            <div class="faq-header" data-aos="fade-up">
                <span class="section-subtitle">FAQ</span>
                <h2 class="section-title">{{ $page->getSectionField('faq', 'title') ?? __('contact.page.faq_title') }}</h2>
            </div>
            <div class="faq-list" data-aos="fade-up">
                @foreach($faqItems as $index => $item)
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span>{{ $item['question_' . app()->getLocale()] ?? $item['question_ru'] }}</span>
                        <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <p>{{ $item['answer_' . app()->getLocale()] ?? $item['answer_ru'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            const isOpen = item.classList.contains('active');

            faqItems.forEach(i => {
                i.classList.remove('active');
                i.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
            });

            if (!isOpen) {
                item.classList.add('active');
                question.setAttribute('aria-expanded', 'true');
            }
        });
    });
});
</script>
@endsection
