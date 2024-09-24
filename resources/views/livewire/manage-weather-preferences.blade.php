<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Manage Weather Preferences</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Edit Form -->
    @if ($editId)
        <form wire:submit.prevent="updatePreference" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="city">City</label>
                <input type="text" wire:model="city" id="city" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="latitude">Latitude</label>
                <input type="text" wire:model="latitude" id="latitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('latitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="longitude">Longitude</label>
                <input type="text" wire:model="longitude" id="longitude" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('longitude') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
                <button type="button" wire:click="resetInputFields" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancel
                </button>
            </div>
        </form>
    @endif

    <!-- Preferences List -->
    <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
        <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-3 px-6 text-left">City</th>
            <th class="py-3 px-6 text-left">Latitude</th>
            <th class="py-3 px-6 text-left">Longitude</th>
            <th class="py-3 px-6 text-right">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
        @foreach ($preferences as $preference)
            <tr>
                <td class="py-3 px-6">{{ $preference->city }}</td>
                <td class="py-3 px-6">{{ $preference->latitude }}</td>
                <td class="py-3 px-6">{{ $preference->longitude }}</td>
                <td class="py-3 px-6 text-right">
                    <button wire:click="editPreference({{ $preference->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Edit</button>
                    <button wire:click="deletePreference({{ $preference->id }})" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
