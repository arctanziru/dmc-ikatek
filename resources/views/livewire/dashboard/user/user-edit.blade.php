<main class="p-4">
    <form wire:submit.prevent="save" class="flex flex-col">
        <x-bladewind::input type="text" wire:model="form.name" placeholder="Enter name" label="Name" />
        @error('form.name') <span class="text-red-600 -mt-4 mb-4">{{ $message }}</span> @enderror

        <x-bladewind::input type="text" wire:model="form.username" placeholder="Enter username" label="Username" />
        @error('form.username') <span class="text-red-600 -mt-4 mb-4">{{ $message }}</span> @enderror

        <x-bladewind::input type="email" wire:model="form.email" placeholder="Enter email" label="Email" />
        @error('form.email') <span class="text-red-600 -mt-4 mb-4">{{ $message }}</span> @enderror

        <select wire:model="form.role" class="bw-raw-select mb-4" label="Role" placeholder="Select role">
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="reporter">Reporter</option>
            <option value="user">User</option>
        </select>
        @error('form.role') <span class="text-red-600 -mt-4 mb-4">{{ $message }}</span> @enderror

        <x-button type="submit" class="self-end">Update User</x-button>
    </form>
</main>