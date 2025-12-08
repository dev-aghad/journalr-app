<?php

namespace App\Services;

interface QuoteService
{
    public function getDailyQuote(): string;
}