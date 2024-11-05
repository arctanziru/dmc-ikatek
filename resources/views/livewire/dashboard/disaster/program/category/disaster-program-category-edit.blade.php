<main class="p-4">
  <form wire:submit.prevent="update" id="categoryEditForm">
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name</label>
      <input type="text" id="name" wire:model="name" class="w-full border-gray-300 rounded">
      @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="description" class="block text-gray-700">Description</label>
      <textarea id="description" wire:model="description" class="w-full border-gray-300 rounded"></textarea>
      @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <button type="button" id="updateButton" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
  </form>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var form = document.getElementById("categoryEditForm");
      var updateButton = document.getElementById("updateButton");

      updateButton.addEventListener("click", function() {
        setTimeout(function() {
          form.requestSubmit();
        }, 100);
      });
    });
  </script>
</main>