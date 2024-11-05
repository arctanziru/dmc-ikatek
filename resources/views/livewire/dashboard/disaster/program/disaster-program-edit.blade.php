<main class="p-4">
    <form wire:submit.prevent="update" id="programEditForm">
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

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Category</label>
            <select id="category_id" wire:model="category_id" class="w-full border-gray-300 rounded">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="disaster_id" class="block text-gray-700">Disaster</label>
            <select id="disaster_id" wire:model="disaster_id" class="w-full border-gray-300 rounded">
                <option value="">Select Disaster</option>
                @foreach ($disasters as $disaster)
                <option value="{{ $disaster->id }}">{{ $disaster->name }}</option>
                @endforeach
            </select>
            @error('disaster_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Program</button>
    </form>
</main>