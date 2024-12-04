<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(QuoteService::class, function ($app) {
            return new QuoteService();
        });
    }

    public function boot()
    {
        //
    }
}
