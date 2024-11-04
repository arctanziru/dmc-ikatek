<main id="hero-section" class="relative p-16 h-screen flex justify-center items-center overflow-hidden">
    <!-- Background image -->
    <img src="images/Our Reach.jpeg" class="absolute top-0 left-0 w-full h-full object-cover -z-10" />

    <!-- Semi-transparent overlay -->
    <div class="absolute top-0 left-0 w-full h-full bg-black/90 -z-5"></div>

    <!-- Content container (overlay on top of the background) -->
    <div id="hero-content" class="flex flex-col items-center gap-8 w-full justify-center z-10 max-w-[1440px] ">

        <div class="w-full max-w-sm p-6 bg-white shadow-lg rounded-sm flex flex-col items-center">
            <main class="flex flex-col gap-4 w-full">
                <div class="flex flex-col w-full items-center">
                    <!-- <img src="images/Logo.png" class="h-12 w-12" /> -->
                    <h1 class="w-full text-center text-dark text-2xl font-semibold">Login</h1>
                    <p>Welcome Back! Admin</p>
                </div>

                <form wire:submit.prevent="login" novalidate>
                    <div class="flex flex-col gap-2">

                        <div>

                            <x-bladewind::input type="email" label="Email" name="email" wire:model="email" required />
                            <x-bladewind::input type="password" label="Password" name="password" wire:model="password"
                                required />
                        </div>

                        @error('error')
                            <div class="flex gap-1 items-center">
                                <x-bladewind::icon name="no-symbol" class="text-red-500 w-4 h-4" />
                                <p class="text-red-500 text-[12px]">Error: {{ $message }}</p>
                            </div>
                        @enderror

                        <!-- Test with standard button -->
                        <button type="submit"
                            class="w-full bg-dark text-white font-medium text-[14px] hover:bg-dark-light duration-200 py-2 rounded">
                            Login
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</main>
</div>