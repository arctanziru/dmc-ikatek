<div class="p-6">
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label>Name</label>
            <input type="text" wire:model="name" class="w-full border-gray-300 rounded">
            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label>Description</label>
            <textarea wire:model="description" class="w-full border-gray-300 rounded"></textarea>
            @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <x-button type="submit">Save</x-button>
    </form>
</div>
