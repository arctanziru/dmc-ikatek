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
        <section class="flex flex-col gap-3 w-full">
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
            <!-- <p class="max-w-[700px] text-white-dark text-[12px] md:text-[16px] ">

                <span class="text-[12px] md:text-[16px] text-primary">
                    DMC IKATEK-UH
                </span>, established by Yayasan Teknik Peduli 09, is dedicated to disaster management and
                humanitarian social programs. We focus on the three crucial phases of disaster management: Pre-Disaster,
                Emergency Response, and Post-Disaster Recovery.
                <br />
                <br />
                With our engineering expertise, <span class="text-[12px] md:text-[16px] text-primary">
                    DMC IKATEK-UH
                </span> plays a vital role in delivering effective disaster
                relief, reducing disaster risks, and supporting recovery efforts across Indonesia. Our commitment is to
                continually strengthen our team's capacity and contribute to a disaster-resilient Indonesia.
            </p> -->
            <p class="text-white">
                Area Of Works :
            </p>
            <section class="w-full overflow-x-auto grid grid-cols-2 md:flex gap-2 md:gap-4 md:py-4 scrollbar-hidden">
                @foreach ($areaOfWorks as $area)
                    <a href="/our-works#{{$area->id}}"
                        class="flex-shrink-0 cursor-pointer relative overflow-hidden rounded-lg h-[120px] md:w-[360px] md:h-[240px] transform  hover:-translate-y-2 hover:shadow-lg hover:shadow-primary/20 transition-[200ms]">
                        <img src="{{ asset('storage/' . $area->image) }}" alt="Gallery Image"
                            class="absolute w-full h-full object-cover" />
                        <div class="absolute w-full h-full z-10 flex p-2 md:p-4 justify-end items-start flex-col"
                            style="background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4));">
                            <p class="uppercase font-bold text-[12px] md:text-[24px] text-white">
                                {{$area->name}}
                            </p>
                            <p class="font-poppins hidden md:inline text-[12px] text-white line-clamp-3">
                                {{$area->short_description}}
                            </p>
                        </div>
                    </a>
                @endforeach
            </section>



            <style>
                /* Hide scrollbar for Chrome, Safari, and Edge */
                .scrollbar-hidden::-webkit-scrollbar {
                    display: none;
                }

                /* Hide scrollbar for Firefox */
                .scrollbar-hidden {
                    -ms-overflow-style: none;
                    /* IE and Edge */
                    scrollbar-width: none;
                    /* Firefox */
                }
            </style>
        </section>
        <section class="w-full justify-center md:justify-start grid grid-cols-2 md:flex gap-3 md:gap-6">
            <a class="w-full md:w-fit" href="/about-us">
                <x-button size="medium" color="white" class="w-full">
                    <p class="text-[10px] md:text-[14px]">
                        Explore
                    </p>
                </x-button>
            </a>
            <x-button onclick="scrollToNewsletter()" size="medium" variant="outlined" color="white"
                class="w-full md:w-fit">
                <p class="text-[10px] md:text-[14px]">
                    Contact Us
                </p>
            </x-button>
        </section>

    </div>
</main>


<script>
    function scrollToNewsletter() {
        const newsletterInput = document.getElementById('newsletter');
        if (newsletterInput) {
            newsletterInput.scrollIntoView({
                behavior: 'smooth'
            });
            setTimeout(() => {
                newsletterInput.focus();
            }, 500); // Adjust delay as needed
        }
    }
</script>