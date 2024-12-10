<main class="p-4">
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label for="province" class="block text-gray-700">Province</label>
            <select id="province" wire:model.live.debounce.150ms="province_id" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select Province</option>
                @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        @if (!is_null($province_id) && !is_null($cities))
        <div class="mb-4">
            <label for="city" class="block text-gray-700">City</label>
            <select id="city" wire:model.live.debounce.150ms="city_id" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select City</option>
                @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        @error('city_id') <span class="text-red-600">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Disaster</button>
    </form>
</main>