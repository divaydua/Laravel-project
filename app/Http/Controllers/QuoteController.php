<?php

namespace App\Http\Controllers;

use App\Services\QuoteService;

class QuoteController extends Controller
{
    protected $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    // Fetch and display a random quote
    public function randomQuote()
    {
        $quote = $this->quoteService->getRandomQuote();

        return view('quotes.random', compact('quote'));
    }

    // Fetch and display quotes by a specific author
    public function quotesByAuthor($author)
    {
        $quotes = $this->quoteService->getQuotesByAuthor($author);

        return view('quotes.author', compact('quotes', 'author'));
    }
}