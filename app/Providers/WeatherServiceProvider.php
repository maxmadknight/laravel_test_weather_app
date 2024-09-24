<?php

namespace App\Providers;

use App\Services\WeatherProviders\OpenWeatherMapProvider;
use App\Services\WeatherProviders\WeatherAPIProvider;
use App\Services\WeatherService;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WeatherService::class, function ($app) {
            // Register multiple weather providers
            return new WeatherService([
                $app->make(OpenWeatherMapProvider::class),
                $app->make(WeatherAPIProvider::class),
            ]);
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
