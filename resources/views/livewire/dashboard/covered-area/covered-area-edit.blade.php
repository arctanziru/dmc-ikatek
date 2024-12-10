<main class="p-4">
    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label for="province" class="block text-gray-700">Province</label>
            <select id="province" wire:model="province_id" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select Province</option>
                @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        @if (!is_null($province_id))
        <div class="mb-4">
            <label for="city" class="block text-gray-700">City</label>
            <select id="city" wire:model="city_id" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select City</option>
                @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Disaster</button>
    </form>
</main>