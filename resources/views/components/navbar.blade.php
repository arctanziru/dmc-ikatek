@php
    $links = [
        ['name' => 'About Us', 'url' => '/about-us'],
        ['name' => 'Our Works', 'url' => '/our-works'],
        ['name' => 'Our Reach', 'url' => '/our-reach'],
        ['name' => 'Get Involved', 'url' => '/#get-involved']
    ];

    // Set classes for navbar variant
    $navbarVariantClass = match ($variant) {
        'default' => 'bg-dark text-white sticky',
        'transparent' => 'bg-transparent text-white fixed transition-[200ms]',
        default => 'bg-blue-600 text-black', // Fallback for any undefined variant
    };
@endphp

<nav id="navbar"
    class="w-screen p-[12px_16px] md:p-[12px_32px] lg:p-[12px_48px] items-center flex justify-between z-[100] top-0 m-0 {{ $navbarVariantClass }} {{ $class }}">

    <!-- Logo centered on small screens -->
    <div class="flex-grow flex justify-start">
        <a href="/">
            <div class="flex gap-2 items-center select-none cursor-pointer">
                <img src="{{ asset(path: 'images/Logo.png') }}" alt="Site Logo"
                    class="h-[30px] md:h-[36px] lg:h-[42px]">
                <div class="font-semibold text-[14px]">
                    DMC-Ikatek UH
                </div>
            </div>
        </a>
    </div>

    <!-- Right menu for desktop -->
    <div class="hidden gap-5 items-center justify-center md:flex">
        <div class="flex gap-6">
            @foreach ($links as $link)
                <a href="{{ $link['url'] }}"
                    class="text-[12px] transition-[200ms] hover:transition-[200ms] hover:text-primary">{{ $link['name'] }}</a>
            @endforeach
        </div>
        <a href="/donate">
            <x-button size="medium">
                <p class="text-[12px]">Donate</p>
            </a>
        </x-button>
    </div>

    <!-- Mobile menu button aligned to right -->
    <!-- Mobile menu button aligned to right -->
    <div class="flex md:hidden relative">
        <!-- Button to toggle the dropdown menu with overlay -->
        <x-button onclick="toggleDropdown()" variant="ghost" rounded="[50%]" size="square-sm">
            <x-bladewind::icon name="bars-3" class="text-primary" />
        </x-button>

        <!-- Overlay to close when clicked -->
        <div id="menuOverlay" class="fixed inset-0 bg-black/50 hidden opacity-0 transition-opacity duration-100 z-30"
            onclick="closeDropdown()">
            <!-- Dropdown Menu (Accordion Style) with stopPropagation -->
            <div id="mobileDropdown"
                class="absolute top-0 left-0 w-full bg-dark text-white shadow-lg max-h-0 overflow-hidden transition-[max-height] duration-200 ease-in-out"
                onclick="event.stopPropagation()">
                <div class="flex flex-col gap-2 ">
                    <div class="flex justify-end w-full px-1 py-3 bg-dark-dark">
                        <x-button color="primary" variant="ghost" rounded="[120px]" size="square-sm"
                            onclick="closeDropdown()">
                            <x-bladewind::icon name="x-mark" class="text-primary" />
                        </x-button>
                    </div>
                    <section class="p-4 gap-2 flex flex-col">

                        <!-- Menu Links -->
                        @foreach ($links as $link)
                            <a href="{{ $link['url'] }}">
                                <x-button variant="ghost" color="white" class="w-full" allignment="center">
                                    <p class="text-[14px]">
                                        {{ $link['name'] }}
                                    </p>
                                </x-button>
                            </a>
                        @endforeach
                        <!-- Donate Button at Bottom -->
                        <a href="/donate">

                            <x-button variant="fill" color="primary" class="w-full" allignment="center">
                                <p class="text-[14px]">Donate</p>
                            </x-button>
                        </a>

                    </section>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Include the JavaScript at the end of your body -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.getElementById('navbar');

        // Define the classes
        const transparentClass = 'bg-transparent';
        const textClass = 'text-white';
        const darkClass = 'bg-dark'; // Change this to your desired dark class

        // Function to handle scroll event
        function handleScroll() {
            if ({{ $variant === "transparent"}}) {


                if (window.scrollY >= window.innerHeight - 100) {
                    navbar.classList.remove(transparentClass);
                    navbar.classList.remove(textClass);
                    navbar.classList.add(darkClass);
                    navbar.classList.add(textClass); // Ensure text color remains white
                    console.log("Scrollling");

                } else {
                    navbar.classList.remove(darkClass);
                    navbar.classList.add(transparentClass);
                    navbar.classList.add(textClass); // Ensure text color remains white
                    console.log("Scrollling");
                }
            } else {
                return;
            }
        }

        // Attach the scroll event listener
        window.addEventListener('scroll', handleScroll);

        // Initial check in case the page is already scrolled
        handleScroll();
    });
</script>
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('mobileDropdown');
        const overlay = document.getElementById('menuOverlay');

        // Toggle the dropdown menu and overlay with animations
        if (dropdown.classList.contains("max-h-0")) {
            dropdown.classList.remove("max-h-0");
            dropdown.classList.add("max-h-[500px]"); // Adjust height as needed
            overlay.classList.remove("hidden");
            setTimeout(() => overlay.classList.add("opacity-100"), 10); // Smoothly fade in overlay
        } else {
            closeDropdown();
        }
    }

    function closeDropdown() {
        const dropdown = document.getElementById('mobileDropdown');
        const overlay = document.getElementById('menuOverlay');

        // Smoothly collapse the dropdown and fade out overlay
        dropdown.classList.add("max-h-0");
        dropdown.classList.remove("max-h-[500px]");
        overlay.classList.remove("opacity-100");
        setTimeout(() => overlay.classList.add("hidden"), 300); // Delay hiding overlay to allow fade out
    }
</script>

<style>
    /* CSS for the overlay fade effect */
    #menuOverlay {
        transition: opacity 0.3s ease-in-out;
    }
</style>