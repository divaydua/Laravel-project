<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QuoteService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api.quotable.io';
    }

    // Fetch a random quote
    public function getRandomQuote()
    {
       // $response = Http::get("{$this->baseUrl}/random");

       $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/random");

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Unable to fetch a quote.'];
    }

    // Fetch quotes by a specific author
    public function getQuotesByAuthor($author)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->baseUrl}/quotes", [
            'author' => $author,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Unable to fetch quotes for this author.'];
    }
}