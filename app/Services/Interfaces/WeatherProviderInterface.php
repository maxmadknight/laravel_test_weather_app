<?php

namespace App\Services\Interfaces;

use App\Data\WeatherData;

interface WeatherProviderInterface
{
    /**
     * Fetches weather data from the provider.
     * @param string $city
     * @return array
     */
    public function fetchWeatherData(string $city): array;

    /**
     * Extracts the relevant data like precipitation and UV index.
     * @param array $weatherData
     * @return WeatherData
     */
    public function extractRelevantData(array $weatherData): WeatherData;
}
