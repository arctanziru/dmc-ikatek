<main class="p-4">
    <form wire:submit.prevent="save" id="programForm">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="w-full border-gray-300 rounded">
            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description (Optional)</label>
            <textarea id="description" wire:model="description" class="w-full border-gray-300 rounded"></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Category</label>
            <select id="category_id" wire:model="category_id" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="province" class="block text-gray-700">Province</label>
            <select id="province" wire:model.live.debounce.150ms="selectedProvince" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select Province</option>
                @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        @if (!is_null($selectedProvince) && !is_null($cities))
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


        <div class="mb-4">
            <label for="disaster_id" class="block text-gray-700">Disaster (Optional)</label>
            <select id="disaster_id" wire:model="disaster_id" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select Disaster</option>
                @foreach ($disasters as $disaster)
                <option value="{{ $disaster->id }}">{{ $disaster->name }}</option>
                @endforeach
            </select>
            @error('disaster_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image</label>
            <input type="file" accept="image/*" id="image" wire:model="image" class="w-fit border-gray-300 rounded">
            @error('image') <span class="text-red-600">{{ $message }}</span> @enderror

            @if ($image)
            <div class="mt-2">
                <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="w-32 h-32 object-cover">
            </div>
            @endif
        </div>


        <div class="mb-4">
            <label for="tor_link" class="block text-gray-700">TOR Link (Optional)</label>
            <input type="url" id="tor_link" wire:model="tor_link" class="w-full border-gray-300 rounded">
            @error('tor_link') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="target_donation" class="block text-gray-700">Target Donation in IDR (Optional)</label>
            <input type="number" id="target_donation" wire:model="target_donation" class="w-full border-gray-300 rounded" min="0" step="0.01">
            @error('target_donation') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Program</button>
    </form>
</main>