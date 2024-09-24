<?php

namespace App\Livewire;

use App\Models\WeatherPreference;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class GeocodeCity extends Component
{
    public string $city;
    public float $latitude;
    public float $longitude;
    public int $userId;

    protected $rules = [
        'city' => 'required|string|max:255',
    ];

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function geocodeCity()
    {
        $this->validate();

        // Call to the geocoding API to get lat/lon
        $geocodedData = $this->getLatLonFromCity($this->city); // Assume this method exists

        if (!$geocodedData) {
            return;
        }

        // Set the latitude and longitude properties
        $this->latitude = $geocodedData['lat'];
        $this->longitude = $geocodedData['lng'];

        // Save weather preference
        WeatherPreference::create([
            'user_id' => auth()->id(),
            'city' => $this->city,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        session()->flash('message', 'Weather preference added successfully!');

        // Dispatch the event to notify the ManageWeatherPreferences component
        $this->dispatch('preferenceAdded');

        // Reset form fields
        $this->city = '';
        $this->latitude = 0;
        $this->longitude = 0;
    }

    public function saveWeatherPreference()
    {
        WeatherPreference::updateOrCreate(
            ['user_id' => $this->userId, 'city' => $this->city],
            [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]
        );

        session()->flash('message', 'Weather preference saved successfully!');
    }

    public function render()
    {
        return view('livewire.geocode-city');
    }

    private function getLatLonFromCity(string $city)
    {
        $apiKey = config('services.opencage.key');
        $response = Http::get('https://api.opencagedata.com/geocode/v1/json', [
            'q' => $this->city,
            'key' => $apiKey,
            'limit' => 1,
        ]);

        if ($response->successful() && !empty($response->json()['results'][0])) {
            return $response->json()['results'][0]['geometry'];
        } else {
            $this->addError('city', 'Unable to fetch geolocation for the given city.');
        }
        return false;
    }
}
