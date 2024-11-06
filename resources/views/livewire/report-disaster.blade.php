<main class="w-full p-4 md:p-8 lg:p-12 items-center justify-center flex flex-col">
    <main class="flex flex-col max-w-[1440px] w-full gap-2 md:gap-4 lg:gap-8">

        <p class="text-[32px] font-bold">Report A Disaster</p>
        <form wire:submit.prevent="save" class="flex flex-col gap-4">
            <div class="">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" wire:model="name" class="w-full border-gray-300 rounded">
                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea id="description" wire:model="description" class="w-full border-gray-300 rounded"></textarea>
                @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <section class="grid grid-cols-2 gap-2 max-w-[640px]">

                <div class="">
                    <label for="province" class="block text-gray-700">Province</label>
                    <select class="p-2 w-full rounded" id="province" wire:model.live.debounce.150ms="selectedProvince"
                        class="w-full border-gray-300 rounded">
                        <option value="">Select Province</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>

                @if (!is_null($selectedProvince) && !is_null($cities))
                    <div class="">
                        <label for="city" class="block text-gray-700">City</label>
                        <select class="p-2 w-full rounded" id="city" wire:model.live.debounce.150ms="city_id"
                            class="w-full border-gray-300 rounded">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </section>


            @error('city_id') <span class="text-red-600">{{ $message }}</span> @enderror

            <div id="map" class="w-full z-[10] h-96 " wire:ignore></div>

            <button type="submit" class="bg-primary w-fit text-white px-4 py-2 rounded">Create Disaster</button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Initialize the map centered at a default location
                var map = L.map('map').setView([-5.147665, 119.432732], 13); // Coordinates for Makassar, Indonesia

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                var marker = L.marker([0, 0], {
                    draggable: true
                }).addTo(map);

                marker.on('dragend', function (event) {
                    var latLng = event.target.getLatLng();
                    @this.set('latitude', latLng.lat);
                    @this.set('longitude', latLng.lng);
                });

                map.on('click', function (event) {
                    var latLng = event.latlng;
                    marker.setLatLng(latLng);
                    @this.set('latitude', latLng.lat);
                    @this.set('longitude', latLng.lng);
                });
            });
        </script>
    </main>

</main>