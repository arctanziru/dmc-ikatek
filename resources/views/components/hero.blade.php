<main id="hero-section"
    class="relative p-4 md:p-8 lg:p-12  min-h-[420px] lg:min-h-[720px] w-screen flex justify-center items-center overflow-hidden">
    <!-- Background image -->
    <img src="images/hero.jpg" class="absolute top-0 left-0 w-full h-full object-cover -z-10" />

    <!-- Semi-transparent overlay -->
    <div class="absolute top-0 left-0 w-full h-full bg-[rgba(11,20,47,0.8)] -z-5"></div>
    <div
        class="absolute hidden md:inline w-[856px] h-[1024px] right-[-428px] bottom-[-246px] rounded-[50%] blur-[200px]  bg-[rgba(220,134,48,0.33)] -z-5">
    </div>

    <!-- Content container (overlay on top of the background) -->
    <div id="hero-content" class="flex flex-col items-start gap-8 w-full z-10 max-w-[1440px] ">
        <!-- Main Content -->
        <section class="flex flex-col gap-3">
            <div class="md:flex gap-3 items-center hidden">
                <div class="w-9 h-9 bg-secondary rounded-md"></div>
                <p class="text-[18px] text-white">
                    Building Resilience, Saving Lives
                </p>
            </div>
            <div class="flex gap-3  items-center">
                <div class="w-[6px] h-[100px] hidden md:inline bg-primary rounded-[10px_1px_1px_10px]">
                </div>
                <div class="flex flex-col ">
                    <p
                        class="text-[24px] md:text-[36px] hidden md:inline lg:text-[48px] font-poppins font-semibold text-white">
                        Disaster Management Center
                    </p>
                    <p
                        class="text-[24px] md:text-[36px] hidden md:inline lg:text-[48px] font-poppins font-semibold text-white">
                        IKATEK-UH
                    </p>
                    <p
                        class="text-[24px] md:text-[36px] lg:text-[48px] inline md:hidden font-poppins font-semibold text-white">
                        DMC IKATEK UH
                    </p>
                </div>
            </div>
            <p class="max-w-[700px] text-white-dark text-[12px] md:text-[16px] ">

                <span class="text-[12px] md:text-[16px] text-primary">
                    DMC IKATEK-UH
                </span>
                are committed to building resilience and saving lives by focusing on disaster
                preparedness, rapid response, and long-term recovery. We deliver innovative strategies, community
                support, and hands-on solutions to effectively manage disaster risks and challenges.
            </p>
        </section>
        <section class="w-full justify-center md:justify-start flex gap-3 md:gap-6">
            <x-button size="medium" color="white" class="w-full md:w-fit">
                <p class="text-[10px] md:text-[14px]">
                    Explore
                </p>
            </x-button>
            <x-button size="medium" variant="outlined" color="white" class="w-full md:w-fit">
                <p class="text-[10px] md:text-[14px]">
                    Contact Us
                </p>
            </x-button>
        </section>

    </div>
</main>