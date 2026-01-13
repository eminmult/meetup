<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'MEETUP - Event & Production | Baku')</title>
    <meta name="description" content="@yield('description', __('site.meta_description'))">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('android-chrome-512x512.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('mstile-150x150.png') }}">
    <meta name="msapplication-TileColor" content="#a9070d">
    <meta name="theme-color" content="#a9070d">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=IBM+Plex+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/meetup.css') }}?v={{ time() }}">

    @yield('styles')
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <img class="preloader-logo" src="https://file.gasimov.az/logomain.svg" alt="MEETUP Logo">
    </div>

    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="cursor-dot"></div>

    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-pom" style="top: 20%; left: 10%; animation-delay: 0s;">
            <svg viewBox="0 0 100 120"><ellipse cx="50" cy="65" rx="40" ry="45"/></svg>
        </div>
        <div class="floating-pom" style="top: 60%; left: 85%; animation-delay: 5s;">
            <svg viewBox="0 0 100 120"><ellipse cx="50" cy="65" rx="40" ry="45"/></svg>
        </div>
        <div class="floating-pom" style="top: 80%; left: 20%; animation-delay: 10s;">
            <svg viewBox="0 0 100 120"><ellipse cx="50" cy="65" rx="40" ry="45"/></svg>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="logo">
            <img src="https://file.gasimov.az/logomain.svg" alt="MEETUP Logo" class="logo-light">
            <img src="https://file.gasimov.az/logoonwhite.svg" alt="MEETUP Logo" class="logo-dark">
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('site.nav.home') }}</a></li>
            <li><a href="{{ route('services', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">{{ __('site.nav.services') }}</a></li>
            <li><a href="{{ route('portfolio', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">{{ __('site.nav.portfolio') }}</a></li>
            <li><a href="{{ route('team', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('team') ? 'active' : '' }}">{{ __('site.nav.team') }}</a></li>
            <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ __('site.nav.about') }}</a></li>
            <li><a href="{{ route('blog', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">{{ __('site.nav.blog') }}</a></li>
            <li><a href="{{ route('events', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('events*') ? 'active' : '' }}">{{ __('site.nav.events') }}</a></li>
        </ul>
        <div class="nav-right">
            <div class="lang-switcher">
                <button class="lang-current">
                    @php
                        $currentLocale = app()->getLocale();
                        $languages = \App\Services\LanguageService::getActiveLanguages();
                        $currentLanguage = $languages->firstWhere('code', $currentLocale);
                        // Get current path without locale prefix
                        $currentPath = request()->path();
                        $localePattern = \App\Services\LanguageService::getLocalePattern();
                        $pathWithoutLocale = preg_replace('#^(' . $localePattern . ')/?#', '', $currentPath);
                    @endphp
                    <span class="lang-flag">{{ $currentLanguage->flag ?? '🌐' }}</span>
                    {{ strtoupper($currentLocale) }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div class="lang-dropdown">
                    @foreach($languages as $language)
                    <a href="/{{ $language->code }}/{{ $pathWithoutLocale }}" class="lang-option {{ $currentLocale == $language->code ? 'active' : '' }}">
                        <span class="lang-flag">{{ $language->flag }}</span>
                        {{ $language->native_name }}
                    </a>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="nav-cta">{{ __('site.nav.contact_btn') }}</a>
        </div>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <ul class="mobile-menu-links">
            <li><a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('site.nav.home') }}</a></li>
            <li><a href="{{ route('services', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">{{ __('site.nav.services') }}</a></li>
            <li><a href="{{ route('portfolio', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">{{ __('site.nav.portfolio') }}</a></li>
            <li><a href="{{ route('team', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('team') ? 'active' : '' }}">{{ __('site.nav.team') }}</a></li>
            <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{ __('site.nav.about') }}</a></li>
            <li><a href="{{ route('blog', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">{{ __('site.nav.blog') }}</a></li>
            <li><a href="{{ route('events', ['locale' => app()->getLocale()]) }}" class="{{ request()->routeIs('events*') ? 'active' : '' }}">{{ __('site.nav.events') }}</a></li>
        </ul>
        <div class="mobile-menu-cta">
            <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="btn-primary">{{ __('site.nav.contact_btn') }}</a>
        </div>
    </div>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="logo">
                    <img src="https://file.gasimov.az/logoonwhite.svg" alt="MEETUP Logo">
                </a>
                <p>{{ __('site.footer.description') }}</p>
            </div>
            <div>
                <h4 class="footer-title">{{ __('site.footer.services') }}</h4>
                <ul class="footer-links">
                    @foreach(\App\Models\Service::published()->ordered()->take(5)->get() as $service)
                    <li><a href="{{ route('services', ['locale' => app()->getLocale()]) }}">{{ $service->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="footer-title">{{ __('site.footer.company') }}</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.about') }}</a></li>
                    <li><a href="{{ route('portfolio', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.portfolio') }}</a></li>
                    <li><a href="{{ route('team', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.team') }}</a></li>
                    <li><a href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('site.nav.contact') }}</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">{{ __('site.footer.contacts') }}</h4>
                <ul class="footer-links">
                    <li><a href="tel:+994501234567">+994 50 123 45 67</a></li>
                    <li><a href="mailto:info@meetup.az">info@meetup.az</a></li>
                    <li><a href="#">{{ __('site.footer.address') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} MEETUP Event & Production. {{ __('site.footer.rights') }}</p>
            <p>{{ __('site.footer.made_with') }}</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/meetup.js') }}?v={{ time() }}"></script>

    @yield('scripts')
</body>
</html>
