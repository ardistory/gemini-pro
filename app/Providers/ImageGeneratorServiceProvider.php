<?php

namespace App\Providers;

use App\Repository\ImageGenerator;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class ImageGeneratorServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function provides()
    {
        return [ImageGenerator::class];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ImageGenerator::class, function ($app) {
            return new ImageGenerator();
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
