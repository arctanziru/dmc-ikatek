<main class="p-4">
  <form wire:submit.prevent="update" id="areaOfWorkEditForm">
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

    <div class="mb-4">
      <label for="image" class="block text-gray-700">Image</label>
      <input type="file" accept="image/*" id="image" wire:model="image" class="w-full border-gray-300 rounded">
      @if ($image)
      <img src="{{ $image->temporaryUrl() }}" class="mt-2">
      @elseif ($areaOfWork->image)
      <img src="{{ asset('storage/' . $areaOfWork->image) }}" class="mt-2">
      @endif
      @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="cover_image" class="block text-gray-700">Cover Image</label>
      <input type="file" accept="image/*" id="cover_image" wire:model="cover_image" class="w-full border-gray-300 rounded">
      @if ($cover_image)
      <img src="{{ $cover_image->temporaryUrl() }}" class="mt-2">
      @elseif ($areaOfWork->cover_image)
      <img src="{{ asset('storage/' . $areaOfWork->cover_image) }}" class="mt-2">
      @endif
      @error('cover_image') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
  </form>
</main>