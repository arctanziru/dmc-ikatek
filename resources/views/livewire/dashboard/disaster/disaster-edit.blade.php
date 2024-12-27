<main class="p-4">
    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="w-full border-gray-300 rounded">
            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="w-full p-3 border-gray-300 rounded"></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="reporter_name" class="block text-gray-700">Reporter name</label>
            <input type="text" id="reporter_name" wire:model="reporter_name" class="w-full border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="province" class="block text-gray-700">Province</label>
            <select id="province" wire:model="selectedProvince" class="w-full p-3 border-gray-300 rounded">
                <option value="">Select Province</option>
                @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        @if (!is_null($selectedProvince))
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

        <div wire:ignore>
            <div id="map" class="w-full h-64 mb-4"></div>
            @error('latitude') <span class="text-red-600">You need to select a point from the map</span> @enderror
        </div>

        <div class="mb-4">
            <label for="time_of_disaster" class="block text-gray-700">Time of Disaster</label>
            <input type="datetime-local" id="time_of_disaster" wire:model="time_of_disaster" class="w-full border-gray-300 rounded">
            @error('time_of_disaster') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image</label>
            <input type="file" accept="image/*" id="image" wire:model="image" class="w-full">
            @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
            @if ($image)
            <img src="{{ $image->temporaryUrl() }}" class="mt-2" style="max-width: 200px;">
            @elseif ($disaster->image)
            <img src="{{ Storage::url($disaster->image) }}" class="mt-2" style="max-width: 200px;">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initialLat = @this.latitude || -5.147665; // Default to Makassar if not set
            var initialLng = @this.longitude || 119.432732; // Default to Makassar if not set

            console.log(initialLat, initialLng);

            var map = L.map('map').setView([initialLat, initialLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            var marker = L.marker([initialLat, initialLng], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function(event) {
                var latLng = event.target.getLatLng();
                console.log(latLng);
                @this.set('latitude', latLng.lat);
                @this.set('longitude', latLng.lng);
            });

            map.on('click', function(event) {
                var latLng = event.latlng;
                console.log(latLng.lat, latLng.lng);
                marker.setLatLng(latLng);
                @this.set('latitude', latLng.lat);
                @this.set('longitude', latLng.lng);
            });
        });
    </script>
</main>