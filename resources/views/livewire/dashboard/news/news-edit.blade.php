<main class="p-4">
    <form wire:submit.prevent="save" id="newsForm">
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" id="title" wire:model="title" class="w-full border-gray-300 rounded">
            @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <input type="text" id="description" wire:model="description" class="w-full border-gray-300 rounded">
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image</label>
            <input type="file" id="image" wire:model="image" class="w-fit border-gray-300 rounded">
            @error('image') <span class="text-red-600">{{ $message }}</span> @enderror

            @if ($image)
            <div class="mt-2">
                <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="w-32 h-32 object-cover">
            </div>
            @elseif ($currentImage)
            <div class="mt-2">
                <img src="{{ asset($currentImage) }}" alt="Current Image" class="w-32 h-32 object-cover">
            </div>
            @endif
        </div>

        <div class="mb-4">
            <livewire:trix :value="$content" />
            @error('content') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="author" class="block text-gray-700">Author</label>
            <input type="text" id="author" wire:model="author" class="w-full border-gray-300 rounded">
            @error('author') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="news_category_id" class="block text-gray-700">Category</label>
            <select id="news_category_id" wire:model="news_category_id" class="w-full border-gray-300 rounded p-2">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('news_category_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="button" id="updateButton" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById("newsForm");
            var trixEditor = document.querySelector("trix-editor");

            var updateButton = document.getElementById("updateButton");

            updateButton.addEventListener("click", function() {
                trixEditor.blur();

                setTimeout(function() {
                    form.requestSubmit();
                }, 100);
            });
        });
    </script>
</main>