<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\WeatherPreference;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class ManageWeatherPreferences extends Component
{
    public Collection $preferences;
    public ?int $editId;
    public string $city;
    public float $latitude;
    public float $longitude;

    protected $rules = [
        'city' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ];

    protected $listeners = ['preferenceAdded' => 'reloadPreferences'];

    public function mount($userId)
    {
        $this->loadPreferences($userId);
    }

    public function loadPreferences()
    {
        /** @var User $user */
        $user = auth()->user();
        $this->preferences = $user->weatherPreferences;
    }

    public function deletePreference($id)
    {
        /** @var User $user */
        $user = auth()->user();
        $user->weatherPreferences()->find($id)->delete();
        session()->flash('message', 'Weather preference deleted successfully!');
        $this->loadPreferences();
    }

    public function editPreference($id)
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var WeatherPreference $preference */
        $preference = $user->weatherPreferences()->find($id);
        $this->editId = $id;
        $this->city = $preference->city;
        $this->latitude = $preference->latitude;
        $this->longitude = $preference->longitude;
    }

    public function updatePreference()
    {
        $this->validate();

        /** @var User $user */
        $user = auth()->user();
        $user->weatherPreferences->find($this->editId)->update([
            'city' => $this->city,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->resetInputFields();
        $this->loadPreferences();

        session()->flash('message', 'Weather preference updated successfully!');
    }

    public function resetInputFields()
    {
        $this->editId = null;
        $this->city = '';
        $this->latitude = 0;
        $this->longitude = 0;
    }

    public function render()
    {
        return view('livewire.manage-weather-preferences');
    }

    public function reloadPreferences()
    {
        $this->loadPreferences();
    }
}
