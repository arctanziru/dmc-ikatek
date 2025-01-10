<div class="w-full max-h-[360px] md:max-h-[640px] h-[calc(100vh-80px)] relative">
    <div class="flex justify-center w-full absolute -z-20 h-full overflow-hidden">
        <!-- Main Image -->
        <img src="{{ $src }}" alt="{{ $alt }}" class="h-full w-auto object-cover z-0"
            onerror="this.onerror=null;this.src='{{ asset('images/placeholder.webp') }}';" />
        <!-- Blurred Background Image -->
    </div>
    <!-- Gradient Overlay -->
    <div
        class="w-full justify-center h-full bg-gradient-to-t from-black/100 via-black/30 to-black/20 flex z-10 absolute items-end p-2 md:p-4 lg:p-8">
        <article class="text-white w-full max-w-[1440px]">
            {{ $slot }}
        </article>
    </div>
</div>
