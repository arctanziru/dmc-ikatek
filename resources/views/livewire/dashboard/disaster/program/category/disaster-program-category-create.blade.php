<main class="p-4">
  <form wire:submit.prevent="save" id="categoryForm">
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name</label>
      <input type="text" id="name" wire:model="name" class="w-full border-gray-300 rounded">
      @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="description" class="block text-gray-700">Description</label>
      <textarea id="description" wire:model="description" class="w-full border-gray-300 rounded p-3"></textarea>
      @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="short_description" class="block text-gray-700">Short Description</label>
      <textarea id="short_description" wire:model="short_description" class="w-full border-gray-300 rounded p-2"></textarea>
      @error('short_description') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <!-- Image -->
    <div class="mb-4">
      <label for="image" class="block text-gray-700">Image</label>
      <input type="file" accept="image/*" id="image" wire:model="image" class="w-full">
      @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
      @if ($image)
      <img src="{{ $image->temporaryUrl() }}" class="mt-2" style="max-width: 200px;">
      @endif
    </div>

    <!-- Cover Image -->
    <div class="mb-4">
      <label for="cover_image" class="block text-gray-700">Cover Image</label>
      <input type="file" accept="image/*" id="cover_image" wire:model="cover_image" class="w-full">
      @error('cover_image') <span class="text-red-600">{{ $message }}</span> @enderror
      @if ($cover_image)
      <img src="{{ $cover_image->temporaryUrl() }}" class="mt-2" style="max-width: 200px;">
      @endif
    </div>

    <!-- Image Galleries -->
    <div class="mb-4">
      <label for="image_galleries" class="block text-gray-700">Image Galleries</label>
      <input type="file" accept="image/*" id="image_galleries" wire:model="image_galleries" class="w-full" multiple>
      @error('image_galleries.*') <span class="text-red-600">{{ $message }}</span> @enderror
      @if ($image_galleries)
      <div class="mt-2">
        @foreach ($image_galleries as $image_gallery)
        <img src="{{ $image_gallery->temporaryUrl() }}" class="inline-block mt-2" style="max-width: 160px;">
        @endforeach
      </div>
      @endif
    </div>

    <!-- Area of Work -->
    <div class="mb-4">
      <label for="area_of_work" class="block text-gray-700">Area of Work</label>
      <select id="area_of_work" wire:model="area_of_work_id" class="w-full p-3 border-gray-300 rounded">
        <option value="">Select Area of Work</option>
        @foreach($areas_of_work as $area)
        <option value="{{ $area->id }}">{{ $area->name }}</option>
        @endforeach
      </select>
      @error('area_of_work_id') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
  </form>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var form = document.getElementById("categoryForm");
      var saveButton = document.getElementById("saveButton");

      saveButton.addEventListener("click", function() {
        setTimeout(function() {
          form.requestSubmit();
        }, 100);
      });
    });
  </script>
</main>