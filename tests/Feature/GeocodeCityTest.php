<?php

namespace Tests\Feature;

use App\Livewire\GeocodeCity;
use Livewire\Livewire;
use Tests\TestCase;

class GeocodeCityTest extends TestCase
{
    /** @test */
    public function it_can_geocode_city_and_save_weather_preference()
    {
        Livewire::test(GeocodeCity::class, ['userId' => 1])
            ->set('city', 'New York')
            ->call('geocodeCity')
            ->assertHasNoErrors()
            ->assertSee('Weather preference saved successfully!');
    }
}
