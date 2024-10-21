<div class="h-screen bg-gray-50 flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-md flex flex-col items-center">
        <main class="flex flex-col gap-4 w-full">
            <h1 class="text-2xl font-semibold mb-4">Login to Your Account</h1>

            <form wire:submit.prevent="login" novalidate>
                <x-bladewind::input
                    type="email"
                    label="Email"
                    name="email"
                    wire:model="email"
                    required />

                <x-bladewind::input
                    type="password"
                    label="Password"
                    name="password"
                    wire:model="password"
                    required />

                @error('error') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <x-bladewind::button class="w-full mt-4" can_submit="true">Login</x-bladewind::button>
            </form>
        </main>
    </div>
</div>