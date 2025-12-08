<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiQuoteService implements QuoteService
{
    public function getDailyQuote(): string
    {
        $response = Http::get('http://api.quotable.io/random');

        if ($response->successful()) {
            return $response->json()['content'] ?? 'Stay ready!';
        }

        return 'Stay ready!';
    }
}