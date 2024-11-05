<main class="p-4">
  <form wire:submit.prevent="save" id="categoryForm">
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name</label>
      <input type="text" id="name" wire:model="name" class="w-full border-gray-300 rounded">
      @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
      <label for="description" class="block text-gray-700">Description</label>
      <textarea id="description" wire:model="description" class="w-full border-gray-300 rounded p-2"></textarea>
      @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
    </div>

    <button type="button" id="saveButton" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
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