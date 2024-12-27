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

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="w-full p-3 border-gray-300 rounded"></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image</label>
            <input type="file" accept="image/*" id="image" wire:model="image" class="w-full">
            @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
            @if ($image)
            <img src="{{ $image->temporaryUrl() }}" class="mt-2" style="max-width: 200px;">
            @elseif ($coveredArea->image)
            <img src="{{ Storage::url($coveredArea->image) }}" class="mt-2" style="max-width: 200px;">
            @endif
        </div>

        <!-- Image Galleries -->
        <div class="mb-4">
            <label for="image_galleries" class="block text-gray-700">Image Galleries</label>
            <input type="file" accept="image/*" id="image_galleries" wire:model="image_galleries" class="w-full" multiple>
            @error('image_galleries.*') <span class="text-red-600">{{ $message }}</span> @enderror

            @if ($existing_image_galleries)
            <div class="mt-2 flex flex-wrap gap-4">
                @foreach ($existing_image_galleries as $key => $existing_image)
                <div class="relative">
                    <img src="{{ Storage::url($existing_image) }}" class="inline-block mt-2" style="max-width: 160px;">
                    <div class="absolute top-0 right-0" wire:click="deleteGalleryImage({{ $key }})">
                        <x-bladewind::button.circle icon="trash" />
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @if ($image_galleries)
            <div class="mt-2 flex flex-wrap gap-4">
                @foreach ($image_galleries as $image_gallery)
                <img src="{{ $image_gallery->temporaryUrl() }}" class="inline-block mt-2" style="max-width: 160px;">
                @endforeach
            </div>
            @endif
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Disaster</button>
    </form>
</main>