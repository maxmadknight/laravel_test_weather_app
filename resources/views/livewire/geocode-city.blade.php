<div class="container mx-auto p-6">
    <form wire:submit.prevent="geocodeCity" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label for="city" class="block text-gray-700 text-sm font-bold mb-2">Enter City</label>
            <input type="text" wire:model="city" id="city" placeholder="Enter city" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Get Coordinates</button>
        </div>
    </form>

    @if ($latitude && $longitude)
        <div class="mt-4 bg-green-100 p-4 rounded">
            <h4 class="text-green-800 font-bold mb-2">Geolocation for {{ $city }}</h4>
            <p>Latitude: {{ $latitude }}</p>
            <p>Longitude: {{ $longitude }}</p>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mt-4">{{ session('message') }}</div>
    @endif
</div>
