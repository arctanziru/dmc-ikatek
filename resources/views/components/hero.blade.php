<main id="hero-section" class="relative p-16 min-h-[720px] w-screen flex justify-center items-center overflow-hidden">
    <!-- Background image -->
    <img src="images/hero.jpg" class="absolute top-0 left-0 w-full h-full object-cover -z-10" />

    <!-- Semi-transparent overlay -->
    <div class="absolute top-0 left-0 w-full h-full bg-[rgba(11,20,47,0.8)] -z-5"></div>
    <div
        class="absolute w-[856px] h-[1024px] right-[-428px] bottom-[-246px] rounded-[50%] blur-[200px]  bg-[rgba(220,134,48,0.33)] -z-5">
    </div>

    <!-- Content container (overlay on top of the background) -->
    <div id="hero-content" class="flex flex-col items-start gap-8 w-full z-10 max-w-[1440px] ">
        <!-- Main Content -->
        <section class="flex flex-col gap-3">
            <div class="flex gap-3 items-center">
                <div class="w-9 h-9 bg-secondary rounded-md"></div>
                <p class="text-[18px] text-white">
                    Building Resilience, Saving Lives
                </p>
            </div>
            <div class="flex gap-3  items-center">
                <div class="w-[6px] h-[100px] bg-primary rounded-[10px_1px_1px_10px]">
                </div>
                <div class="flex flex-col ">
                    <p class="text-[48px] font-poppins leading-[62px] font-semibold text-white">
                        Disaster Management Center
                    </p>
                    <p class="text-[48px] font-poppins leading-[62px] font-semibold text-white">
                        IKATEK-UH
                    </p>
                </div>
            </div>
            <p class="max-w-[700px] text-white-dark text-[16px] leading-[30px]">

                <span class="text-[16px] leading-[30px] text-primary">
                    DMC IKATEK-UH
                </span>
                are committed to building resilience and saving lives by focusing on disaster
                preparedness, rapid response, and long-term recovery. We deliver innovative strategies, community
                support, and hands-on solutions to effectively manage disaster risks and challenges.
            </p>
        </section>
        <section class="flex gap-6">
            <x-button size="medium" color="white">Explore</x-button>
            <x-button size="medium" variant="ghost" color="white">Contact Us</x-button>
        </section>

    </div>
</main>