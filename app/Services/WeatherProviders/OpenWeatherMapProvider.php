<?php

namespace App\Services\WeatherProviders;

namespace App\Services\WeatherProviders;

use App\Data\WeatherData;
use App\Services\Interfaces\WeatherProviderInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapProvider implements WeatherProviderInterface
{
    protected $apiUrl = 'https://api.openweathermap.org/data/2.5/weather';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openweathermap.key');
    }

    public function fetchWeatherData(string $city): array
    {
        $response = Http::get($this->apiUrl, [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric'
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function extractRelevantData(array $weatherData): WeatherData
    {
        return new WeatherData(
            Arr::get($weatherData, 'rain.1h', 0) ?? 0,
            Arr::get($weatherData, 'main.uvi', 0) ?? 0
        );
    }
}
