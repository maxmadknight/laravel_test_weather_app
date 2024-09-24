<?php

namespace Tests\Unit;

use App\Services\WeatherProviders\OpenWeatherMapProvider;
use App\Services\WeatherProviders\WeatherAPIProvider;
use App\Services\WeatherService;
use PHPUnit\Framework\TestCase;

class WeatherServiceTest extends TestCase
{
    public function testWeatherServiceAggregatesData()
    {
        $openWeatherProvider = $this->createMock(OpenWeatherMapProvider::class);
        $weatherAPIProvider = $this->createMock(WeatherAPIProvider::class);

        $openWeatherProvider->method('fetchWeatherData')->willReturn([
            'rain' => ['1h' => 1],
            'main' => ['uvi' => 6],
        ]);

        $weatherAPIProvider->method('fetchWeatherData')->willReturn([
            'current' => ['precip_mm' => 2, 'uv' => 7],
        ]);

        $service = new WeatherService([$openWeatherProvider, $weatherAPIProvider]);

        $averageData = $service->getWeatherData('London');
        $this->assertEquals(1.5, $averageData['precipitation']);
        $this->assertEquals(6.5, $averageData['uv_index']);
    }
}
