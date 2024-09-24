<?php

namespace App\Services\WeatherProviders;

use App\Data\WeatherData;
use App\Services\Interfaces\WeatherProviderInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class WeatherAPIProvider implements WeatherProviderInterface
{
    protected $apiUrl = 'http://api.weatherapi.com/v1/current.json';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.weatherapi.key');
    }

    public function fetchWeatherData(string $city): array
    {
        $response = Http::get($this->apiUrl, [
            'key' => $this->apiKey,
            'q' => $city,
            'aqi' => 'no'
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }

    public function extractRelevantData(array $weatherData): WeatherData
    {
        return new WeatherData(
            Arr::get($weatherData,'current.precip_mm', 0)?? 0,
                Arr::get($weatherData, 'current.uv', 0) ?? 0
        );
    }
}
