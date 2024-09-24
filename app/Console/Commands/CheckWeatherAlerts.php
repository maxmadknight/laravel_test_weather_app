<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WeatherAlertNotification;
use App\Services\WeatherService;
use Illuminate\Console\Command;
use Ramsey\Collection\Collection;

class CheckWeatherAlerts extends Command
{
    protected $signature = 'app:weather_check';
    protected $description = 'Check weather and notify users if thresholds are met';

    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        parent::__construct();
        $this->weatherService = $weatherService;
    }

    public function handle()
    {
        /** @var Collection<User> $users */
        $users = User::whereHas('weatherPreferences')->get();

        foreach ($users as $user) {
            foreach ($user->weatherPreferences as $preference) {
                $averageWeather = $this->weatherService->getWeatherData($preference->city);
dump($averageWeather);
                if ($averageWeather['precipitation'] >= $preference->precipitation_threshold ||
                    $averageWeather['uv_index'] >= $preference->uv_index_threshold) {
                    $user->notify(new WeatherAlertNotification($preference->city, $averageWeather));
                }
            }
        }

        return Command::SUCCESS;
    }
}
