<?php

namespace App\Providers;

use App\Repository\GeminiPro;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class GeminiProServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function provides()
    {
        return [GeminiPro::class];
    }

    public function register(): void
    {
        $this->app->singleton(GeminiPro::class, function (Application $app) {
            return new GeminiPro();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
