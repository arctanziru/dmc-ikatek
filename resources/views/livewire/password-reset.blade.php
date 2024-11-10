<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Reset Password</h2>

    @if (session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <form wire:submit.prevent="resetPassword">
        <div class="mb-4">
            <label for="password" class="block text-gray-700">New Password</label>
            <input type="password" id="password" wire:model="password" class="w-full border-gray-300 rounded" required>
            @error('password') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm New Password</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" class="w-full border-gray-300 rounded" required>
            @error('password_confirmation') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Reset Password</button>
    </form>
</div>