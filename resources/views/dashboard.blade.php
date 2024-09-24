<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <h2 class="text-2xl font-semibold mb-4">Weather Preferences</h2>

        <!-- Geocode City Component -->
        @livewire('geocode-city', ['userId' => auth()->id()])

        <!-- Manage Preferences Component -->
        <div class="mt-8">
            @livewire('manage-weather-preferences', ['userId' => auth()->id()])
        </div>
    </div>
</x-app-layout>
