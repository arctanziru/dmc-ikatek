@php
    $links = [
        ['name' => 'About Us', 'url' => '/about-us'],
        ['name' => 'Our Works', 'url' => '#our-works'],
        ['name' => 'Our Reach', 'url' => '#our-reach'],
        ['name' => 'Get Involved', 'url' => '#get-involved']
    ];

    // Set classes for navbar variant
    $navbarVariantClass = match ($variant) {
        'default' => 'bg-black text-white sticky',
        'transparent' => 'bg-transparent text-white fixed transition-[200ms]',
        default => 'bg-blue-600 text-black', // Fallback for any undefined variant
    };
@endphp

<nav id="navbar"
    class="w-screen p-[12px_48px] items-center flex justify-between z-[100] top-0 margin-0 {{ $navbarVariantClass }} {{ $class }}">

    <a href="/">
        <div class="flex gap-2 items-center select-none cursor-pointer">
            <img draggable="false" src="{{ asset('images/Logo.png') }}" alt="Site Logo" class="h-[42px]">
            <div class="font-semibold text-[14px]">
                DMC-Ikatek UH
            </div>
        </div>
    </a>

    <!-- right menu -->
    <div class="flex gap-5 items-center justify-center">
        <div class="flex gap-6">
            @foreach ($links as $link)
                <a href="{{ $link['url'] }}"
                    class="text-[12px] transition-[200ms] hover:transition-[200ms] hover:text-primary">{{ $link['name'] }}</a>
            @endforeach
        </div>
        <x-button size="medium">
            <p class="text-[12px]">
                Donate
            </p>
        </x-button>
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