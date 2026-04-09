<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiTranslationService
{
    protected string $apiKey;
    protected string $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    public function translate(string $text, string $fromLanguage, string $toLanguage): ?string
    {
        if (empty($text)) {
            return null;
        }

        $languageNames = [
            'az' => 'Azerbaijani',
            'en' => 'English',
            'ru' => 'Russian',
        ];

        $fromLang = $languageNames[$fromLanguage] ?? $fromLanguage;
        $toLang = $languageNames[$toLanguage] ?? $toLanguage;

        $prompt = "You are a professional translator. Translate the following text from {$fromLang} to {$toLang}.

CRITICAL RULES - FOLLOW EXACTLY:
1. Return ONLY the translated text, nothing else
2. PRESERVE ALL HTML TAGS EXACTLY as they appear (<p>, <strong>, <em>, <h1>, <h2>, <h3>, <ul>, <li>, <a>, <br>, etc.)
3. Only translate the TEXT CONTENT inside the HTML tags, NOT the tags themselves
4. Keep all HTML attributes unchanged (href, class, style, etc.)
5. Preserve the EXACT same HTML structure and nesting
6. Do NOT add any explanations, notes, comments or markdown
7. Do NOT wrap the result in code blocks or quotes
8. Preserve line breaks and spacing

Example:
Input: <p><strong>Salam</strong> dünya!</p>
Output: <p><strong>Hello</strong> world!</p>

Text to translate:
{$text}";

        try {
            $response = Http::timeout(60)->post("{$this->apiUrl}?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.3,
                    'maxOutputTokens' => 8192,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $result = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

                if ($result) {
                    // Remove markdown code block wrappers if present
                    $result = preg_replace('/^```(?:html)?\s*\n?/i', '', $result);
                    $result = preg_replace('/\n?```\s*$/i', '', $result);

                    // Remove leading/trailing quotes if the whole text is wrapped
                    $result = preg_replace('/^["\'](.+)["\']$/s', '$1', trim($result));

                    // Trim whitespace
                    $result = trim($result);
                }

                return $result;
            }

            Log::error('Gemini API error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Gemini translation error', [
                'message' => $e->getMessage()
            ]);
            return null;
        }
    }

    public function translateToAllLanguages(array $content, string $sourceLanguage): array
    {
        $languages = ['az', 'en', 'ru'];
        $result = [];

        foreach ($languages as $lang) {
            if ($lang === $sourceLanguage) {
                $result[$lang] = $content;
                continue;
            }

            $result[$lang] = [];
            
            foreach ($content as $field => $value) {
                if (!empty($value) && is_string($value)) {
                    $translated = $this->translate($value, $sourceLanguage, $lang);
                    $result[$lang][$field] = $translated ?? $value;
                } else {
                    $result[$lang][$field] = $value;
                }
            }
        }

        return $result;
    }
}
