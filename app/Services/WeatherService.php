<?php

namespace App\Services;

use App\Services\Interfaces\WeatherProviderInterface;

class WeatherService
{
    /**
     * @var WeatherProviderInterface[]
     */
    protected $providers;

    /**
     * Constructor with multiple weather providers.
     *
     * @param array $providers
     */
    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    /**
     * Fetch weather data from all providers and calculate the average.
     *
     * @param string $city
     * @return array
     */
    public function getWeatherData(string $city): array
    {
        $dataPoints = [
            'precipitation' => [],
            'uv_index' => [],
        ];

        foreach ($this->providers as $provider) {
            $weatherData = $provider->fetchWeatherData($city);
            dump($weatherData);
            $relevantData = $provider->extractRelevantData($weatherData);

            $dataPoints['precipitation'][] = $relevantData->precipitation;
            $dataPoints['uv_index'][] = $relevantData->uvIndex;
        }

        // Calculate averages
        return [
            'precipitation' => $this->average($dataPoints['precipitation']),
            'uv_index' => $this->average($dataPoints['uv_index']),
        ];
    }

    /**
     * Helper function to calculate average.
     *
     * @param array $values
     * @return float
     */
    protected function average(array $values): float
    {
        return count($values) ? array_sum($values) / count($values) : 0;
    }
}
