<main class="p-4">
  <form wire:submit.prevent="save">
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Disaster Name</label>
      <input type="text" id="name" wire:model="name" class="w-full border-gray-300 rounded">
      @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="description" class="block text-gray-700">Description</label>
      <textarea id="description" wire:model="description" class="w-full p-3 border-gray-300 rounded"></textarea>
      @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="reporter_name" class="block text-gray-700">Reporter Name (Default your name)</label>
      <input type="text" id="reporter_name" wire:model="reporter_name" class="w-full border-gray-300 rounded">
      @error('reporter_name') <span class="text-red-600">{{ $message }}</span> @enderror
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

    <div id="map" class="w-full h-64 mb-4" wire:ignore></div>
    @error('latitude') <span class="text-red-600">You need to select a point from the map</span> @enderror

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Report Disaster</button>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize the map centered at a default location
      var map = L.map('map').setView([-5.147665, 119.432732], 13); // Coordinates for Makassar, Indonesia

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

      var marker = L.marker([0, 0], {
        draggable: true
      }).addTo(map);

      marker.on('dragend', function(event) {
        var latLng = event.target.getLatLng();
        @this.set('latitude', latLng.lat);
        @this.set('longitude', latLng.lng);
      });

      map.on('click', function(event) {
        var latLng = event.latlng;
        marker.setLatLng(latLng);
        @this.set('latitude', latLng.lat);
        @this.set('longitude', latLng.lng);
      });
    });
  </script>
</main>