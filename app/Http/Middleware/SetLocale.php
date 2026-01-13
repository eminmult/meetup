<?php

namespace App\Http\Middleware;

use App\Services\LanguageService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from URL segment
        $locale = $request->route('locale');

        if ($locale && LanguageService::isValidLocale($locale)) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        } else {
            // Fallback to session or default
            $locale = session('locale', LanguageService::getDefaultCode());
            if (LanguageService::isValidLocale($locale)) {
                app()->setLocale($locale);
            }
        }

        return $next($request);
    }
}
