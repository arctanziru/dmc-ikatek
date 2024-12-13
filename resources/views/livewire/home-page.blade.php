@php
$cards = [
[
'name' => 'Our Mission',
'subtitle' => 'Learn About Our Commitment.',
'button' => 'Learn More'
],
[
'name' => 'Corporate Strategy',
'subtitle' => 'Discover our approach to disaster response.',
'button' => 'Explore Strategy'
],
[
'name' => 'Organization & Leadership',
'subtitle' => 'Meet our leaders and governance team',
'button' => 'Meet The Team'
],
[
'name' => 'Our History',
'subtitle' => 'Track our key milestones in disaster management',
'button' => 'Read More'
],
];
function formatCurrency($amount)
{
if ($amount >= 1_000_000_000_000) { // Trillion
return number_format($amount / 1_000_000_000_000, 0) . ' T+'; // Format to 3 decimal places and add +
} elseif ($amount >= 1_000_000_000) { // Billion
return number_format($amount / 1_000_000_000, 0) . ' B+'; // Format to 3 decimal places and add +
} else {
return number_format($amount, 2); // Default formatting
}
}

$partners = [
[
'name' => 'Government',
'path' => 'icons/Govt.svg',
],
[
'name' => 'Non-Gov Organization',
'path' => 'icons/NonGovt.svg',
],
[
'name' => 'Private Sector Partnership',
'path' => 'icons/PSP.svg',
],
[
'name' => 'Academia and Think Tanks',
'path' => 'icons/Academia.svg',
],
[
'name' => 'Goodwill Ambassador & High Level Supporter',
'path' => 'icons/Ambassador.svg',
],

];

$currentLanguage = 'en';

$about = [
[
'idn' => "Membangun ketahanan, Memulihkan harapan",
'en' => "Building Resilience, Restoring Hope"
],
[
'idn' => "Dengan dukunganmu",
'en' => "With your support",
],
[
'idn' => "berkomitmen untuk membangun ketahanan dan menyelamatkan nyawa dengan berfokus pada kesiapsiagaan bencana, respons cepat, dan pemulihan jangka panjang. Kami memberikan strategi inovatif, dukungan masyarakat, dan solusi langsung untuk mengelola risiko dan bencana secara efektif.",
'en' => "are committed to building resilience and saving lives by focusing on disaster preparedness, rapid response, and long-term recovery. We deliver innovative strategies, community support, and hands-on solutions to effectively manage disaster risks and challenges.",
]
];

$ourworkstext = [
[
'idn' => "Di Disaster Management Center, kami berkomitmen untuk menyediakan bantuan dan dukungan bencana yang efektif di beberapa Provinsi dan Daerah. Operasi kami mencakup berbagai wilayah, seperti yang ditunjukkan pada peta di bawah ini.",
'en' => "At the Disaster Management Center, we are committed to providing effective disaster relief and support across Several Provinces and Regions. Our operations cover a wide range of areas, as shown on the map below."
],
]

@endphp


<div>
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

    <main id="hero-section"
        class="relative p-4 md:p-8 lg:p-12 h-[420px] lg:h-[720px] lg:max-h-screen w-screen flex justify-center items-end overflow-hidden cursor-pointer">

        <!-- Background image with fade transition -->
        <img id="hero-background"
            src="{{ $areaOfWorks->isEmpty() ? 'images/noimage.jpeg' : asset('storage/' . $areaOfWorks[0]->image) }}"
            onerror="this.src='/images/noimage.jpeg'"
            class="absolute top-0 left-0 w-full h-full object-cover -z-10 opacity-100 transition-opacity duration-1000" />

        <!-- Semi-transparent overlay -->
        <div class="absolute top-0 left-0 w-full h-full bg-[rgba(11,20,47,0.8)] -z-5"></div>
        <div
            class="absolute hidden md:inline w-[856px] h-[1024px] right-[-428px] bottom-[-246px] rounded-[50%] blur-[200px]  bg-[rgba(220,134,48,0.33)] -z-5">
        </div>

        <!-- Content container (overlay on top of the background) -->
        <div id="hero-content"
            class="flex flex-col gap-4 items-start w-full justify-end z-10 max-w-[1440px] opacity-100 transition-opacity duration-1000">
            <a class="flex gap-6 items-center">
                <div class="w-[6px] h-[100px] hidden md:inline bg-primary rounded-[10px_1px_1px_10px]">
                </div>
                <div class="flex flex-col md:gap-2 lg:gap-4">
                    <p id="hero-title" class="text-[20px] md:text-[28px] lg:text-[36px] font-bold text-white uppercase">
                        {{ $areaOfWorks->isEmpty() ? 'DMC IKATEK-UH' : $areaOfWorks[0]->name }}
                    </p>
                    <p id="hero-description" class="text-[12px] md:text-[18px] lg:text-[24px] font-semibold capitalize text-white">
                        {{ $areaOfWorks->isEmpty() ? 'Building Resilience, Restoring Hope' : $areaOfWorks[0]->short_description }}
                    </p>
                </div>
            </a>
            <div id="area-of-works-navigation" class="w-full flex justify-center space-x-4 z-10">
                <div id="nav-indicators" class="flex w-full gap-4">
                    <!-- Dynamic indicators will go here -->
                </div>
            </div>
        </div>

        <!-- Navigation arrows -->
        <x-button variant="outlined" size="square-sm" rounded="[50%]" color="white" id="prev-arrow"
            class="absolute left-3 lg:left-4 top-1/2 transform -translate-y-1/2 text-white font-bold text-[32px]">
            <x-bladewind::icon name="chevron-left" />
        </x-button>
        <x-button variant="outlined" size="square-sm" rounded="[50%]" color="white" id="next-arrow"
            class="absolute right-3 lg:right-6 top-1/2 transform -translate-y-1/2 text-white font-bold text-[32px]">
            <x-bladewind::icon name="chevron-right" />
        </x-button>

    </main>


    <main class="flex flex-col items-center">
        <!-- About Us -->
        <section class="lg:p-12 md:p-8 p-4 w-full  max-w-[1440px]">
            <main class="w-full max-w-[1440px] flex flex-col  gap-8">
                <section class="flex justify-center md:flex-col md:gap-4 lg:gap-0 lg:flex-row w-full items-center ">
                    <div class="hidden md:flex flex-1 justify-end ">
                        <div class="relative w-full">

                            <div
                                class="w-[300px] h-[125px] bg-primary absolute  left-[-16px] md:top-[-17px] lg:bottom-[-17px] -z-10">
                            </div>
                            <img src="/images/img.jpeg"
                                class="w-full lg:max-w-[480px] h-[280px] border-l-8 md:border-t-8  lg:border-b-8 border-white" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 flex-1">
                        <img src="/images/img.jpeg" class="w-full md:hidden max-h-[240px] object-cover rounded-md" />
                        <p class="text-primary text-[14px] font-medium">ABOUT DMC IKATEK-UH</p>
                        <p class="text-dark text-[24px] md:text-[30px] lg:text-[36px] font-bold">
                            <?= htmlspecialchars($about[0][$currentLanguage]); ?>
                        </p>
                        <p class="text-dark text-[12px] md:text-[14px] lg:text-[16px]  font-normal">
                            <?= htmlspecialchars($about[1][$currentLanguage]); ?>
                            <span class="md:text-[14px] text-primary lg:text-[16px] font-semibold font-primary">
                                DMC IKATEK-UNHAS
                            </span>
                            <?= htmlspecialchars($about[2][$currentLanguage]); ?>
                        </p>

                    </div>
                </section>
                <section class="hidden md:flex flex-col justify-center w-full items-center ">
                    <div class="w-[2px] h-10 bg-primary"></div>
                    <div class="h-[2px] w-60 bg-primary"></div>
                </section>
                <section class="flex flex-col gap-2 md:gap-4 lg:gap-6 items-center">
                    <div>
                        <p class="text-[24px] font-semibold">Our Partners</p>
                    </div>
                    <div class="flex gap-3 md:gap-6 lg:gap-9 flex-wrap md:flex-nowrap items-center justify-center">
                        @foreach ($partners as $partner)
                        <div class="gap-3 w-24 md:w-32 lg:w-40 flex flex-col select-none items-center">
                            <img draggable="false" src="{{ $partner['path'] }}" class="h-[60px] w-full" />
                            <p class="text-center text-primary text-[10px] font-semibold">{{ $partner['name'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </section>
            </main>
        </section>

        <!-- Where We Works -->
        <section class="relative p-4 md:p-8 lg:p-12  w-full flex flex-col justify-center items-center overflow-hidden">
            <!-- Background image -->
            <img src="/images/Our Reach.jpeg" class="absolute top-0 left-0 w-full h-full object-cover -z-10" />
            <!-- Semi-transparent overlay -->
            <div class="absolute top-0 left-0 w-full h-full bg-[rgba(11,20,47,0.8)] -z-5"></div>
            <div
                class="absolute w-[856px] h-[1024px] right-[-428px] bottom-[-246px] rounded-[50%] blur-[200px]  bg-[rgbz(53,64,141,0.4)] -z-5">
            </div>
            <!-- Content container (overlay on top of the background) -->
            <div id="content" class="flex flex-col justify-center items-center w-full z-10 max-w-[1440px]">
                <div class="flex flex-col items-center">
                    <p class="text-white text-[24px] md:text-[48px] text-[] lg:text-[72px] font-bold">WHERE WE <span
                            class="text-primary text-[24px] md:text-[48px] text-[] lg:text-[72px] font-bold">WORKS?</span>
                    </p>
                    <div class="flex gap-8 items-center ">
                        <p class="text-white font-poppins text-[16px] md:text-[32px] lg:text-[48px] font-normal"><span
                                class="text-[16px] md:text-[32px] lg:text-[48px] font-bold">{{$totalCities}}
                            </span>Province</p>
                        <div class="self-stretch w-[2px] bg-white"></div>
                        <p class="text-white font-poppins text-[16px] md:text-[32px] lg:text-[48px] font-normal"><span
                                class="text-[16px] md:text-[32px] lg:text-[48px] font-bold">{{$totalProvinces}}
                            </span>Region</p>
                    </div>
                    <p
                        class="max-w-[980px] font-poppins text-center md:font-medium text-white text-[8px] md:text-[12px] lg:text-[16px]">
                        <?= htmlspecialchars($ourworkstext[0][$currentLanguage]); ?>
                    </p>
                </div>
                <section class=" w-full flex text-[12px]">
                    <iframe title="Rescue and Relief Distribution Map" aria-label="Map" id="datawrapper-chart-wAZge"
                        src="https://datawrapper.dwcdn.net/wAZge/1/" scrolling="no" frameborder="0"
                        style="width: 100%; min-width: 100% !important; border: none;" height="256"
                        data-external="1"></iframe>
                    <script type="text/javascript">
                        ! function() {
                            "use strict";
                            window.addEventListener("message", (function(a) {
                                if (void 0 !== a.data["datawrapper-height"]) {
                                    var e = document.querySelectorAll("iframe");
                                    for (var t in a.data["datawrapper-height"])
                                        for (var r = 0; r < e.length; r++)
                                            if (e[r].contentWindow === a.source) {
                                                var i = a.data["datawrapper-height"][t] + "px";
                                                e[r].style.height = i
                                            }
                                }
                            }))
                        }();
                    </script>
                </section>
                <a href="/our-reach">

                    <x-button variant="outlined" color="white" size="small" class=" mt-4">
                        <p class="text-[12px] md:text-[14px] lg:text-[16px] p-1">
                            View Province and Regions
                        </p>
                </a>
                </x-button>
            </div>
        </section>

        <section class="flex flex-col items-start justify-center w-full">
            <section
                class="flex flex-col gap-4 md:gap-6 lg:gap-8 items-start p-4 md:py-8 lg:pb-0 lg:pt-12 justify-center w-full z-50">

                <div class="flex flex-col justify-center w-full items-center gap-3">
                    <p class="text-dark text-[24px] md:text-[36px] lg:text-[48px] text-center font-bold">
                        GET <span class="text-primary">INVOLVED</span>
                    </p>
                    <p class="text-dark text-[12px] md:text-[18px] lg:text-[24px] text-center font-light">you can help
                        by donating to our latest program</p>
                    <section class="hidden md:flex flex-col justify-center w-full items-center ">
                        <div class="w-[2px] h-10 bg-primary"></div>
                        <div class="h-[2px] w-60 bg-primary"></div>
                    </section>
                </div>

                <section class="hidden md:flex gap-3 lg:gap-6 justify-center w-full">
                    @foreach ($programs as $program)
                    <div class="flex justify-center">
                        <x-program-card name="{{ $program->name }}" image="{{ $program->image }}"
                            desc="{{ $program->description }}" target="{{ (int) $program->target_donation }}"
                            totalDonation="{{ $program->donations->sum('amount') }}"
                            category="{{ $program->category->name ?? 'N/A' }}" id="{{ $program->id }}"
                            createdAt="{{ $program->created_at->format('d M Y') }}" status="{{$program->status}}" />
                    </div>
                    @endforeach

                    <a href="/programs"
                        class=" hover:text-primary hidden lg:flex cursor-pointer p-3 shadow-[0_0_2px_0_rgba(0,0,0,0.80)] hover:shadow-primary z-20 bg-white  flex-col gap-2 justify-center overflow-hidden w-[224px] items-center">
                        <div class="w-[240px] flex flex-col items-center justify-center">
                            <div class="rounded-[50%] p-2 border-[1px] border-inherit">
                                <x-bladewind::icon name="chevron-right" class="!h-6 !w-6" />
                            </div>
                            <p class="text-[18px]">
                                More Program
                            </p>
                        </div>

                    </a>

                </section>
                <div class="w-full flex justify-center lg:hidden">
                    <a class="" href="/programs">
                        <x-button variant="outlined" color="dark">
                            <p class="text-[14px]">
                                View Program
                            </p>
                        </x-button>
                    </a>
                </div>


            </section>


            <section id="get-involved"
                class="relative z-0 lg:p-[40px_0px] lg:-mt-16 w-full flex flex-col justify-center items-center overflow-hidden">
                <!-- Background image -->
                <img src="/images/Our Reach.jpeg" class="absolute top-0 left-0 w-full h-full object-cover -z-10" />
                <!-- Semi-transparent overlay -->
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-dark/70 to-dark/70 -z-5"></div>
                <!-- content -->
                <div id="content"
                    class="flex flex-col justify-center md:gap-8 gap-4 lg:gap-12 items-center w-full z-10 ">
                    <section class="grid grid-cols-1 md:grid-cols-2 w-full lg:pb-8">
                        <div
                            class="bg-primary lg:bg-primary/70 lg:h-max p-[12px_16px] md:p-[24px_32px] lg:p-[48px_64px] gap-2 justify-center flex flex-col relative items-center">
                            <img src="icons/donate.svg" />
                            <p class="text-[16px] md:text-[22px] lg:text-[28px] text-white font-semibold">
                                {{__('landing.makeADonation')}}
                            </p>
                            <p class="text-[10px] md:text-[12px] lg:text-[14px] text-white font-light text-center ">{{__('landing.makeADonationDesc')}}</p>
                            <a href="/donate" class="inline lg:absolute -bottom-[20.5px] left-auto right-auto">
                                <x-button rounded="none" size="medium" variant="fill" color="white">
                                    <p class="text-[12px] lg:text-[14px] lg:p-1 font-light">
                                        Donate Now
                                    </p>
                                </x-button>
                            </a>
                        </div>
                        <div
                            class="bg-white lg:bg-white/70 lg:h-max lg:mt-[60px] p-[12px_16px] md:p-[24px_32px] lg:p-[48px_64px] gap-2 justify-center flex flex-col relative items-center">
                            <img src="icons/sharethemeal.svg" />
                            <p class="text-[16px] md:text-[22px] lg:text-[28px] text-dark font-semibold">Share The Meal
                                App</p>
                            <p class="text-[10px] md:text-[12px] lg:text-[14px] text-dark font-light text-center ">
                                Provide food to those in need by using the Share The Meal app. Every meal helps save a
                                life.
                            </p>
                            <a href="https://sharethemeal.org"
                                class="inline lg:absolute -bottom-[20.5px] left-auto right-auto">
                                <x-button rounded="none" size="medium" variant="fill" color="dark">
                                    <p class="text-[12px] lg:text-[14px] lg:p-1 font-light">
                                        Download App
                                    </p>
                                </x-button>
                            </a>
                        </div>
                    </section>
                    <section id="statistics" class="flex flex-col md:px -8 lg:flex-row gap-3 w-full">
                        <div class="flex-1 flex px-4  md:px-8 lg:px-0  lg:justify-end ">
                            <div class="p-8 flex w-full lg:w-fit  gap-6 flex-col items-center bg-secondary/30">
                                <p class="text-center text-[16px] md:text-[28px]  text-white">Some Statistics of Our
                                    Platforms</p>
                                <div class="grid w-full grid-cols-1 md:grid-cols-3 lg:grid-cols-2 gap-8">
                                    <div class=" justify-center flex flex-col gap-2 items-center">
                                        <img src="icons/Program.svg" class="h-12" />

                                        <p class="text-[24px] md:text-[36px] lg:text-[48px] text-primary">
                                            {{$totalProgramCount}}
                                        </p>
                                        <p
                                            class="text-[12px] md:text-[18px] lg:text-[24px] font-poppins font-extralight text-white">
                                            Programs
                                        </p>

                                    </div>
                                    <div class=" justify-center flex flex-col gap-2 items-center">
                                        <img src="icons/Donation.svg" class="h-12" />

                                        <p class="text-[24px] md:text-[36px] lg:text-[48px] text-primary">
                                            Rp. {{formatCurrency($donationSum)}}
                                        </p>
                                        <p
                                            class="text-[12px] md:text-[18px] lg:text-[24px] font-poppins font-extralight text-white">
                                            Donations
                                        </p>

                                    </div>
                                    <div class=" justify-center flex flex-col gap-2 items-center">
                                        <img src="icons/Donator.svg" class="h-12" />

                                        <p class="text-[24px] md:text-[36px] lg:text-[48px] text-primary">
                                            {{$uniqueDonorCount}}
                                        </p>
                                        <p
                                            class="text-[12px] md:text-[18px] lg:text-[24px] font-poppins font-extralight text-white">
                                            Donator
                                        </p>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex-1 flex w-full justify-end lg:justify-start">
                            <div
                                class="py-4 md:py-8 px-4 md:px-8 lg:px-16 w-full md: lg:max-w-[640px] flex gap-3 flex-col">
                                <p class="text-[14px] md:text-[18px] text-primary">What Can You Do</p>
                                <p class="font-semibold text-[20px] md:text-[26px] lg:text-[32px] text-white">Your
                                    Actions Can Make a
                                    Difference in Disaster Relief.</p>
                                <div class="flex p-2 md:p-4 lg:p-6 gap-6 bg-dark select-none items-center">
                                    <div class="flex justify-center !w-6 md:!w-8 lg:!w-12 items-center">
                                        <img class="object-fit w-full h-full" src="icons/Share.svg" />
                                    </div>
                                    <div class="flex-1 flex-col flex">
                                        <p class="text-white text-[16px] lg:text-[20px]">Share</p>
                                        <p class="md:inline hidden text-white text-[14px]">Help us spread the word about
                                            disaster relief
                                            efforts. Share on social media to amplify our mission and reach those in
                                            need.</p>
                                    </div>
                                </div>
                                <div class="flex p-2 md:p-4 lg:p-6 gap-6 bg-dark select-none items-center">
                                    <div class="flex justify-center !w-6 md:!w-8 lg:!w-12 items-center">
                                        <img class="object-fit w-full h-full" src="icons/Donation.svg" />
                                    </div>

                                    <div class="flex flex-col flex-1">
                                        <p class="text-white text-[16px] lg:text-[20px]">Donate</p>
                                        <p class="md:inline hidden text-white text-[14px]">Your generous contributions
                                            allow us to
                                            provide urgent assistance and resources to those affected by disasters.</p>
                                    </div>
                                </div>
                                <div class="flex p-2 md:p-4 lg:p-6 gap-6 bg-dark select-none items-center">
                                    <div class="flex justify-center !w-6 md:!w-8 lg:!w-12 items-center">
                                        <img class="object-fit w-full h-full" src="icons/Event.svg" />

                                    </div>
                                    <div class="flex flex-col flex-1">
                                        <p class="text-white text-[16px] lg:text-[20px]">Event And Fundraising</p>
                                        <p class="md:inline hidden text-white text-[14px]">Join us in our fundraising
                                            events or create
                                            your own to help support disaster management efforts and rebuild
                                            communities.</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>
                </div>

            </section>
        </section>

        <!-- news -->
        <section class="w-full p-4 md:p-8 lg:p-12 flex justify-center ">
            <div class="max-w-[1440px] w-full flex flex-col items-center gap-4">
                <div class="flex w-full p-2 border-l-4 border-l-primary">
                    <p class="text-[24px] font-medium">Check Our News</p>
                </div>
                @if (!$news || $news->isEmpty())
                <div class="flex flex-col items-center gap-4">
                    <p class="text-[16px] text-dark-light">No news available</p>
                </div>
                @else
                <section class="flex gap-4 w-full justify-start flex-col lg:flex-row lg:h-[436px] ">
                    <!-- Left Section (Featured News) -->
                    <section class="flex-1 flex justify-start relative bg-white/20 max-w-[940px] ">
                        <div class="hidden relative lg:flex justify-start items-center w-[80px] ">
                            <div
                                class="bg-white/90 shadow-sm gap-2 shadow-dark/40 w-[360px] flex flex-col p-8 absolute z-50 left-0">
                                <p class="text-[18px] font-medium text-primary">
                                    {{ $news->first()->author ?? 'N/A' }}
                                </p>
                                <p class="text-ellipsis line-clamp-2 text-[24px] font-semibold">
                                    {{ $news->first()->title ?? 'N/A' }}
                                </p>
                                <p class="text-ellipsis text-[14px] line-clamp-3">
                                    {{ $news->first()->description ?? 'N/A' }}
                                </p>
                                <p class="w-full text-right text-[12px]">
                                    {{ optional(value: $news->first())->created_at->format('d M Y') }}
                                </p>

                                </p>
                                <x-button href="/news" rounded="none" variant="outlined" color="dark">Read
                                    More</x-button>
                            </div>
                        </div>

                        <div
                            class="relative flex h-full min-h-[240px] md:min-h-[320px] lg:min-h-fit rounded-lg overflow-hidden bg-dark-light/20 flex-1">
                            <img src="{{ asset($news->first()->image) }}" class="rounded-lg w-full object-cover"
                                alt="Featured News Image" />
                            <a
                                class="absolute hover:bg-dark/80 cursor-pointer duration-200 flex lg:hidden top-0 left-0 w-full h-full bg-dark/40 p-2 md:p-6 flex-col justify-end items-start ">
                                <p class="text-[16px] md:text-[18px] font-medium text-white">
                                    {{ $news->first()->author ?? 'N/A' }}
                                </p>
                                <p
                                    class="text-ellipsis line-clamp-2 text-white text-[20px] md:text-[24px] font-semibold">
                                    {{ $news->first()->title ?? 'N/A' }}
                                </p>
                                <p class="text-ellipsis md:text-[14px] text-white text-[12px] line-clamp-3">
                                    {{ $news->first()->description ?? 'N/A' }}
                                </p>
                                <p class="w-full text-left text-white text-[10px] md:text-[12px]">
                                    {{ optional(value: $news->first())->created_at->format('d M Y') }}
                                </p>
                            </a>
                        </div>
                    </section>

                    <!-- Right Section (News List) -->
                    <section class="grid grid-cols-2 lg:flex lg:flex-col gap-1 md:gap-2 lg:h-[436px]">
                        @foreach ($news->skip(1) as $newsItem)
                        <a id="news-card" href="/news/{{$newsItem->id}}"
                            class="flex gap-2 lg:gap-4 shadow-[0_0_1px_0] shadow-dark/20  lg:shadow-none bg-white cursor-pointer items-center lg:flex-row flex-col justify-start hover:bg-white-light p-1 md:p-2 rounded-md lg:w-[360px]">
                            <div class="rounded-lg h-24 md:h-32 lg:h-20 w-full lg:w-20 flex bg-dark">
                                <img src="{{ $newsItem->image }}" class="w-full h-full object-cover rounded-lg"
                                    alt="News Image" />
                            </div>

                            <div class="flex flex-col w-full lg:w-fit lg:p-0 p-2 flex-1 justify-between">
                                <div class="flex flex-col">
                                    <p class="font-light text-[8px] md:text-[14px] lg:text-[16px]">
                                        {{ $newsItem->author }}
                                    </p>
                                    <p
                                        class="font-medium text-[10px] md:text-[14px] lg:text-[16px] text-ellipsis line-clamp-2">
                                        {{ $newsItem->title }}
                                    </p>
                                </div>
                                <div class="flex gap-1">
                                    <p class="font-light text-[8px] md:text-[12px] text-dark-light">
                                        {{ optional(value: $newsItem->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </section>
                </section>
                @endif
            </div>
        </section>

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
</div>

<script>
    // Pass the array directly from Blade to JavaScript
    const areaOfWorks = @json($areaOfWorks);
    let currentIndex = 0;
    let autoChangeInterval;

    // Function to update the hero section content with transition effect
    function updateHeroContent() {
        const heroTitle = document.getElementById('hero-title');
        const heroDescription = document.getElementById('hero-description');
        const heroBackground = document.getElementById('hero-background');

        // Fade-out the elements
        heroTitle.classList.remove('opacity-100');
        heroTitle.classList.add('opacity-0');
        heroDescription.classList.remove('opacity-100');
        heroDescription.classList.add('opacity-0');
        heroBackground.classList.remove('opacity-100');
        heroBackground.classList.add('opacity-0');

        // Wait for the fade-out to complete, then update the content
        setTimeout(() => {
            if (areaOfWorks.length === 0) {
                // Static fallback content
                heroTitle.textContent = 'DMC IKATEK UH';
                heroDescription.textContent = 'HASANUDDIN UNIVERSITY';
                heroBackground.src = '{{ asset('
                images / hero.jpg ') }}';
            } else {
                // Dynamic content
                heroTitle.textContent = areaOfWorks[currentIndex].name;
                heroDescription.textContent = areaOfWorks[currentIndex].short_description;
                heroBackground.src = `{{ asset('storage/') }}/${areaOfWorks[currentIndex].image}`;
            }

            // Fade-in the elements after updating
            heroTitle.classList.remove('opacity-0');
            heroTitle.classList.add('opacity-100');
            heroDescription.classList.remove('opacity-0');
            heroDescription.classList.add('opacity-100');
            heroBackground.classList.remove('opacity-0');
            heroBackground.classList.add('opacity-100');
        }, 500); // Duration of fade-out (500ms)
    }

    // Function to update the navigation indicators
    function updateNavigation() {
        const navIndicators = document.getElementById('nav-indicators');
        navIndicators.innerHTML = ''; // Clear previous indicators

        if (areaOfWorks.length === 0) return; // Don't create navigation if empty

        // Create a new indicator for each area of work
        areaOfWorks.forEach((work, index) => {
            const indicator = document.createElement('div');
            indicator.classList.add('h-2', 'flex-1', 'bg-white', 'opacity-50', 'cursor-pointer', 'rounded-[20px]', 'transition-all', 'duration-300');

            // Active class for the current index
            if (index === currentIndex) {
                indicator.classList.remove('opacity-50');
                indicator.classList.add('opacity-100');
            }

            indicator.addEventListener('click', () => {
                currentIndex = index;
                updateHeroContent();
                updateNavigation(); // Update navigation states
                resetAutoChange();
            });

            navIndicators.appendChild(indicator);
        });
    }

    // Handle previous button click
    document.getElementById('prev-arrow').addEventListener('click', () => {
        if (areaOfWorks.length === 0) return; // If empty, do nothing

        currentIndex = (currentIndex === 0) ? areaOfWorks.length - 1 : currentIndex - 1;
        updateHeroContent();
        updateNavigation();
        resetAutoChange(); // Reset the auto-change timer
    });

    // Handle next button click
    document.getElementById('next-arrow').addEventListener('click', () => {
        if (areaOfWorks.length === 0) return; // If empty, do nothing

        currentIndex = (currentIndex === areaOfWorks.length - 1) ? 0 : currentIndex + 1;
        updateHeroContent();
        updateNavigation();
        resetAutoChange(); // Reset the auto-change timer
    });

    // Auto-update every 10 seconds
    function startAutoChange() {
        if (areaOfWorks.length === 0) return; // If empty, do nothing

        autoChangeInterval = setInterval(() => {
            currentIndex = (currentIndex === areaOfWorks.length - 1) ? 0 : currentIndex + 1;
            updateHeroContent();
            updateNavigation();
        }, 30000); // 5 seconds interval
    }

    // Reset the auto-change timer
    function resetAutoChange() {
        clearInterval(autoChangeInterval); // Clear previous interval
        startAutoChange(); // Start a new interval
    }

    // Initial content load, navigation update, and start auto-change
    updateHeroContent();
    updateNavigation();
    startAutoChange(); // Start the auto-change timer
</script>