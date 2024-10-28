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
    $newsItems = $news->slice(1, 4); // Skip the first item and take the next 4
@endphp

<x-layouts.landing :title="'Home Page'">

    <x-hero />
    <main class="flex flex-col items-center">
        <!-- About Us -->
        <main class=" p-8 w-full max-w-[1440px] flex flex-col  gap-8">
            <section class="flex justify-center w-full items-center ">
                <div class="flex flex-1 justify-end ">
                    <div class="relative">

                        <div class="w-[300px] h-[125px] bg-primary absolute left-[-16px] bottom-[-17px] -z-10">
                        </div>
                        <img src="images/img.jpeg"
                            class="w-full max-w-[480px] h-[280px] border-l-8 border-b-8 border-white" />
                    </div>
                </div>
                <div class="flex flex-col gap-2 p-[0_24px] flex-1">
                    <!-- <img src="images/img.jpeg" class="w-full max-w-[480px] h-[280px]" /> -->
                    <p class="text-primary text-[14px] font-medium">ABOUT DMC IKATEK-UH</p>
                    <p class="text-dark text-[38px] font-bold">Prepared for Today Ready for Tomorrow</p>
                    <p class="text-dark text-[16px]  font-light">Help those at the frontlines of disaster
                        response
                        by donating today. Your contribution will go towards disaster preparedness, risk reduction,
                        and
                        innovative solutions that protect lives and livelihoods in crisis-affected regions.</p>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex gap-2 items-center ">
                            <img src="icons/check.svg" />
                            <p class="text-dark text-[16px] ">Provide Emergency Relief Supplies
                        </div>
                        <div class="flex gap-2 items-center ">
                            <img src="icons/check.svg" />
                            <p class="text-dark text-[16px] ">Rebuild Affected Communities
                        </div>
                        <div class="flex gap-2 items-center ">
                            <img src="icons/check.svg" />
                            <p class="text-dark text-[16px] ">Educate on Disaster Preparedness
                        </div>
                        <div class="flex gap-2 items-center ">
                            <img src="icons/check.svg" />
                            <p class="text-dark text-[16px] ">Lead Rescue and Evacuation Efforts
                        </div>
                    </div>
                </div>
            </section>
            <section class="flex flex-col justify-center w-full items-center ">
                <div class="w-[2px] h-10 bg-primary"></div>
                <div class="h-[2px] w-60 bg-primary"></div>
            </section>
            <section class="flex gap-3 justify-center w-full items-center  ">
                @foreach ($cards as $card)
                    <main class="flex p-[22px] items-center flex-col justify-between w-[250px] border-primary border">
                        <div class="gap-3 items-center flex flex-col h-[140px]">
                            <p>
                                <img src="icons/check.svg" alt="image" class="w-8 h-8" />
                            </p>
                            <p class="text-[20px] font-bold text-center">
                                {{$card['name']}}
                            </p>
                            <p class="text-center text-[10px] min-h-">
                                {{$card['subtitle']}}
                            </p>
                        </div>
                        <x-button variant="outlined" class="rounded-none w-full inline-flex">
                            <p class="text-[10px] ">
                                {{$card['button']}}
                            </p>
                        </x-button>
                    </main>
                @endforeach
            </section>
            <section class="flex flex-col justify-center w-full items-center ">
                <div class="h-[2px] w-60 bg-primary"></div>
                <div class="w-[2px] h-10 bg-primary"></div>
            </section>
            <section class="flex flex-col gap-6 items-center">
                <div class="flex flex-col gap-[6px]">
                    <p class="text-[24px] font-semibold">Our Partners</p>
                </div>
                <div class="flex gap-9">
                    @foreach ($partners as $partner)
                        <div class="gap-3 w-[120px] flex flex-col select-none items-center">
                            <img draggable="false" src="{{ $partner['path'] }}" class="h-[60px] w-full" />
                            <p class="text-center text-primary text-[10px] font-semibold">{{ $partner['name'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
        <!-- Where We Works -->
        <main class="relative p-16  w-full flex flex-col justify-center items-center overflow-hidden">
            <!-- Background image -->
            <img src="images/Our Reach.jpeg" class="absolute top-0 left-0 w-full h-full object-cover -z-10" />
            <!-- Semi-transparent overlay -->
            <div class="absolute top-0 left-0 w-full h-full bg-[rgba(11,20,47,0.8)] -z-5"></div>
            <div
                class="absolute w-[856px] h-[1024px] right-[-428px] bottom-[-246px] rounded-[50%] blur-[200px]  bg-[rgbz(53,64,141,0.4)] -z-5">
            </div>
            <!-- Content container (overlay on top of the background) -->
            <div id="content" class="flex flex-col justify-center items-center w-full z-10 max-w-[1440px]">
                <div class="flex flex-col items-center">
                    <p class="text-white text-[72px] font-bold">WHERE WE <span
                            class="text-primary text-[72px] font-bold">WORKS?</span></p>
                    <div class="flex gap-8 items-center ">
                        <p class="text-white font-poppins text-[48px] font-normal"><span class="text-[48px] font-bold">7
                            </span>Province</p>
                        <div class="self-stretch w-[2px] bg-white"></div>
                        <p class="text-white font-poppins text-[48px] font-normal"><span
                                class="text-[48px] font-bold">14
                            </span>Region</p>
                    </div>
                    <p class="max-w-[980px] font-poppins text-center font-medium text-white text-[16px]">
                        At the Disaster Management Center, we are committed to providing effective disaster relief
                        and
                        support across 7 Provinces and their 14 Regions. Our operations cover a wide range of areas,
                        as
                        shown on the map below.
                    </p>
                </div>
                <img src="images/Map.png" class="object-cover w-full max-w-[1200px]" />
            </div>
        </main>

        <!-- Get Involved -->
        <main class="flex flex-col items-start justify-center w-full">
            <section class="flex flex-col gap-8 items-start p-t-8 justify-center w-full z-50">

                <div class="flex flex-col justify-center w-full items-center gap-3">
                    <p class="text-dark text-[48px]  font-bold">
                        GET <span class="text-primary">INVOLVED</span>
                    </p>
                    <p class="text-dark text-[24px] font-light">you can help by donating to our latest program</p>
                    <section class="flex flex-col justify-center w-full items-center ">
                        <div class="w-[2px] h-10 bg-primary"></div>
                        <div class="h-[2px] w-60 bg-primary"></div>
                    </section>
                </div>
                <section class="flex gap-6 justify-center w-full ">
                    <x-program-card />
                    <x-program-card />
                    <x-program-card />
                    <x-program-card />
                </section>
            </section>


            <section
                class="relative z-0 p-[40px_0px] -mt-16 w-full flex flex-col justify-center items-center overflow-hidden">
                <!-- Background image -->
                <img src="images/Our Reach.jpeg" class="absolute top-0 left-0 w-full h-full object-cover -z-10" />
                <!-- Semi-transparent overlay -->
                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-dark/70 to-dark/70 -z-5"></div>
                <!-- content -->
                <div id="content" class="flex flex-col justify-center gap-16 items-center w-full z-10 ">
                    <section class="grid grid-cols-2 w-full pb-8">
                        <div
                            class="bg-primary/70 h-max p-[48px_64px] justify-center flex flex-col relative items-center">
                            <img src="icons/donate.svg" />
                            <p class="text-[28px] text-white font-semibold">Make A Donation</p>
                            <p class="text-[14px] text-white font-light text-center ">Join us on the ground or remotely
                                to help with
                                disaster relief
                                efforts. <br />Your time and skills can make a difference.</p>
                            <x-button rounded="none" size="large" variant="fill" color="white"
                                class="absolute -bottom-[20.5px] left-auto right-auto">
                                <p class="text-[14px] font-light">

                                    Donate Now
                                </p>
                            </x-button>
                        </div>
                        <div
                            class="bg-white/70 h-max mt-[60px] p-[48px_64px] justify-center flex flex-col relative items-center">
                            <img src="icons/sharethemeal.svg" />
                            <p class="text-[28px] text-dark font-semibold">Share The Meal App</p>
                            <p class="text-[14px] text-dark font-light text-center ">Provide food to those in need by
                                using the Share The Meal app. Every meal
                                <br /> helps save a life.
                            </p>
                            <x-button rounded="none" variant="fill" color="dark" size="large"
                                class="absolute -bottom-[20.5px] left-auto right-auto">
                                <p class="text-[14px] font-light">

                                    Download App
                                </p>
                            </x-button>
                        </div>
                    </section>
                    <section id="statistics" class="flex gap-3 w-full">
                        <div class="flex-1 flex justify-end ">
                            <div class="p-8 flex gap-6 flex-col items-center bg-secondary/30">
                                <p class="text-center text-[28px] text-white">Some Statistics of Our Platforms</p>
                                <div class="grid grid-cols-2 gap-8">
                                    <div class="w-[180px] flex flex-col gap-2 items-center">
                                        <img src="icons/Program.svg" class="h-12" />

                                        <p class="text-[48px] text-primary">
                                            34
                                        </p>
                                        <p class="text-[24px] font-poppins font-extralight text-white">
                                            Programs
                                        </p>

                                    </div>
                                    <div class="w-[180px] flex flex-col gap-2 items-center">
                                        <img src="icons/Donation.svg" class="h-12" />

                                        <p class="text-[48px] text-primary">
                                            234 Jt
                                        </p>
                                        <p class="text-[24px] font-poppins font-extralight text-white">
                                            Donations
                                        </p>

                                    </div>
                                    <div class="w-[180px] flex flex-col gap-2 items-center">
                                        <img src="icons/Donator.svg" class="h-12" />

                                        <p class="text-[48px] text-primary">
                                            3000+
                                        </p>
                                        <p class="text-[24px] font-poppins font-extralight text-white">
                                            Donator
                                        </p>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex-1 flex justify-start">
                            <div class="py-3 pl-8 pr-16 max-w-[640px]  flex gap-3 flex-col">
                                <p class="text-[18px] text-primary">What Can You Do</p>
                                <p class="font-semibold text-[32px] text-white">Your Actions Can Make a
                                    Difference in Disaster Relief.</p>
                                <div class="flex p-6 gap-6 bg-dark select-none">
                                    <div class="flex justify-center  w-12">
                                        <img class="object-fit" src="icons/Share.svg" />
                                    </div>
                                    <div>
                                        <p class="text-white text-[20px]">Share</p>
                                        <p class="text-white text-[14px]">Help us spread the word about disaster relief
                                            efforts. Share on social media to amplify our mission and reach those in
                                            need.</p>
                                    </div>
                                </div>
                                <div class="flex p-6 gap-6 bg-dark select-none">
                                    <div class="flex justify-center  w-12">
                                        <img class="object-fit" src="icons/Donation.svg" />
                                    </div>

                                    <div>
                                        <p class="text-white text-[20px]">Donate</p>
                                        <p class="text-white text-[14px]">Your generous contributions allow us to
                                            provide urgent assistance and resources to those affected by disasters.</p>
                                    </div>
                                </div>
                                <div class="flex p-6 gap-6 bg-dark select-none">
                                    <div class="flex justify-center  w-12">
                                        <img class="object-fit" src="icons/Event.svg" />

                                    </div>
                                    <div>
                                        <p class="text-white text-[20px]">Event And Fundraising</p>
                                        <p class="text-white text-[14px]">Join us in our fundraising events or create
                                            your own to help support disaster management efforts and rebuild
                                            communities.</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </section>
                </div>

            </section>
        </main>
        <main class="max-w-[1980px] flex flex-col items-center p-16 gap-4">
            <div class="flex w-full p-2 border-l-4 border-l-primary">
                <p class="text-[20px] font-medium">Check Our News</p>
            </div>

            <section class="flex gap-4 w-full justify-center h-[436px]">
                <!-- Left Section (Featured News) -->
                <section class="flex-1 flex justify-start">
                    <div class="w-[32px] relative flex justify-center items-center">
                        <div
                            class="bg-white/95 shadow-sm gap-2 shadow-dark/40 w-[360px] flex flex-col p-8 absolute z-50 left-0">
                            <p class="text-[18px] font-medium text-primary">{{ $news->first()->author ?? 'N/A' }}</p>
                            <p class="text-ellipsis line-clamp-2 text-[24px] font-semibold">
                                {{ $news->first()->title ?? 'N/A' }}</p>
                            <p class="text-ellipsis text-[14px] line-clamp-3">{{ $news->first()->description ?? 'N/A' }}
                            </p>
                            <p class="w-full text-right text-[12px]">
                                {{ optional(value: $news->first())->created_at->format('d M Y') }}</p>
                            <x-button href="/news" rounded="none" variant="outlined" color="dark">Read More</x-button>
                        </div>
                    </div>

                    <div class="flex-1 relative flex w-full h-full bg-gray-200">
                        <img src="{{ asset($news->first()->image ?? 'images/placeholder.webp') }}"
                            class="rounded-lg h-[436px] w-full object-cover" alt="Featured News Image"
                            onload="this.parentNode.classList.remove('bg-gray-200');"
                            onerror="this.src='{{ asset('images/placeholder.webp') }}';" />
                    </div>
                </section>

                <!-- Right Section (News List) -->
                <section class="flex flex-col gap-1 h-[436px]">
                    @foreach ($newsItems as $newsItem)
                        <div id="news-card"
                            class="flex gap-4 bg-white cursor-pointer items-center justify-start hover:bg-white-light p-2 rounded-md w-[360px]">
                            <div class="h-[80px] w-[80px] bg-gray-200 rounded-lg overflow-hidden">
                                <img src="{{ asset($newsItem->image ?? 'images/placeholder.webp') }}"
                                    class="h-[80px] w-[80px] object-cover" alt="News Image"
                                    onload="this.parentNode.classList.remove('bg-gray-200');"
                                    onerror="this.src='{{ asset('images/placeholder.webp') }}';" />
                            </div>
                            <div class="flex flex-col justify-between">
                                <div class="flex flex-col">
                                    <p class="font-light">{{ $newsItem->author }}</p>
                                    <p class="font-medium text-ellipsis line-clamp-2">{{ $newsItem->title }}</p>
                                </div>
                                <div class="flex gap-1">
                                    <p class="font-normal text-[12px] text-primary">{{ $newsItem->category ?? 'N/A' }} •</p>
                                    <p class="font-light text-[12px] text-dark-light">
                                        {{ optional(value: $newsItem->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>
            </section>

        </main>



    </main>

    <!-- <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Welcome to the Home Page!</h1>
        <p>This is a simple page using the app layout.</p>

        <x-button variant="primary" class="mt-4">Get Started</x-button>
        <x-bladewind::code />
        <x-bladewind::table has_border="true" divider="thin">
            <x-slot name="header">
                <th>Name</th>
                <th>Department</th>
                <th>Email</th>
            </x-slot>
            <tr>
                <td>Alfred Rowe</td>
                <td>Outsourcing</td>
                <td>alfred@therowe.com</td>
            </tr>
            <tr>
                <td>Michael K. Ocansey</td>
                <td>Tech</td>
                <td>kabutey@gmail.com</td>
            </tr>
        </x-bladewind::table>
    </div> -->

</x-layouts.landing>