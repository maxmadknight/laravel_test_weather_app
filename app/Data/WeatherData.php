<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class WeatherData extends Data
{
    public function __construct(
        public $precipitation,
        public $uvIndex
    ) {}
}
