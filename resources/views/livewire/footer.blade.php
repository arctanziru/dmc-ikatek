@php
    $links = [
        ['name' => 'Facebook', 'path' => '/icons/fb.svg', 'url' => 'https://web.facebook.com/DMCIKATEKUH'],
        ['name' => 'Instagram', 'path' => '/icons/instagram.svg', 'url' => 'https://www.instagram.com/dmcikatek.uh/'],
        ['name' => 'Youtube', 'path' => '/icons/youtube.svg', 'url' => 'https://www.youtube.com/@dmcikatekunhas1304'],
    ];

    $rightNavs = [
        // Section 1
        [
            [
                'title' => 'About Us',
                'links' => [
                    ['text' => 'About Us', 'url' => '/about-us'],
                ],
            ],
            [
                'title' => 'Our Reach',
                'links' => [
                    ['text' => 'Provinces And Region', 'url' => '/our-reach'],
                ],
            ],
        ],
        // Section 2 (Dynamic Our Works)
        [
            [
                'title' => 'Our Works',
                'links' => array_merge(
                    $areaOfWorks->map(function ($work) {
                        return [
                            'text' => $work->name, // AreaOfWork name
                            'url' => "/our-works#{$work->id}", // AreaOfWork ID
                        ];
                    })->toArray(),
                    [ // Append the static 'All Programs' link
                        ['text' => 'All Programs', 'url' => '/programs']
                    ]
                ),
            ],
        ],
        // Section 3
        [
            [
                'title' => 'Get Involved',
                'links' => [
                    ['text' => 'Donate', 'url' => '/donate'],
                    ['text' => 'Share The Meal App', 'url' => 'https://sharethemeal.org/'],
                ],
            ],
        ],
    ];


@endphp


<footer class="w-screen flex p-4 md:p-8 lg:p-12 bg-dark flex-col gap-4 items-center justify-center">
    <main class=" max-w-[1440px] gap-6 md:gap-7 lg:gap-8 w-full flex flex-col items-start justify-center">
        <section class="flex flex-col gap-6 lg:max-w-[320px]">
            <a href="/"
                class="text-primary text-[24px] md:text-[28px] cursor-pointer lg:text-[32px] flex gap-3 items-center">
                <img src="{{ asset(path: '/images/Logo.png') }}" alt="Site Logo"
                    class="h-[30px] md:h-[36px] lg:h-[42px]">
                DMC IKATEK-UH
            </a>

        </section>

        <section class="flex gap-6 w-full flex-col md:flex-row">
            <section class="flex flex-col w-[320px] max-w-[100%] gap-6">

                <p class="text-white text-[10px] md:text-[12px] font-[500]">
                    <span class="text-primary text-[10px] md:text-[12px] font-[500]">

                        Disaster Management Center (DMC) IKATEK
                    </span>
                    is dedicated to providing timely disaster management, relief,
                    and recovery operations. Through collaboration with governments, NGOs, and the private sector,
                    we strive
                    to minimize the impact of disasters and support affected communities. Our mission includes
                    disaster risk
                    reduction, emergency response, and long-term resilience building.
                </p>
                <nav class="hidden md:flex flex-col gap-2 ">

                    <div class="flex gap-2 items-center">
                        <div class="bg-primary h-1 w-[15px] rounded-xl"></div>
                        <p class="font-semibold text-[18px] shadow text-white">Contact Us</p>
                    </div>
                    <div class="flex gap-2 items-center text-white">
                        <div>
                            <x-bladewind::icon name="chevron-right" class="!h-3 !w-3 " />
                        </div>

                        <p class="text-[12px] ">Phone:
                            <span class="text-[12px] hover:text-primary"><a target="_blank"
                                    href="https://wa.me/+6281340734686">0813-4073-4686</a></span> /
                            <span class="text-[12px] hover:text-primary"><a target="_blank"
                                    href="https://wa.me/+6281524063470">0815-2406-3470</a></span>
                        </p>
                    </div>
                    <div class="flex gap-2 items-center text-white">
                        <div>
                            <x-bladewind::icon name="chevron-right" class="!h-3 !w-3 " />
                        </div>

                        <p class="text-[12px] ">Address: Jl. Andi Djemma No.38, Kec.Tamalate, Makassar, Sulawesi Selatan
                            90222</p>
                </nav>
                <div class="hidden md:flex gap-4">

                    @foreach ($links as $link)
                        <a href="{{$link['url']}}" target="_blank">
                            <div class="h-8 w-8 items-center flex rounded-[50%] bg-white justify-center cursor-pointer">
                                <img src="{{$link['path']}}" />
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- <div class="flex flex-wrap gap-4 items-start ">
                <div class="flex gap-4 lg:flex-1">
                    <div
                        class="bg-[rgba(220,134,48,0.20)] hidden md:inline md:sm max-w-[60px] max-h-[60px] rounded-lg p-3">
                        <img src="/icons/sms.svg" />
                    </div>
                    <div class="flex text-white flex-col justify-between">
                        <p class="sm:text-[16px] md:text-[20px] lg:text-[24px] font-semibold min-w-[120px]">Enter Your
                            Email</p>
                        <p class="text-[10px] md:text-[12px] lg:text-[14px]">We Will Contact You Soon</p>
                    </div>
                </div>
                <div class="flex gap-3  flex-1">
                    <input id="newsletter"
                        class="p-[12px_8px] bg-transparent flex-1 min-w-[120px] w-full text-white text-[14px]  h-max rounded-md"
                        placeholder="Enter Email" />
                    <x-button class="h-full self-stretch bg-white">
                        <p class="text-black">
                            →
                        </p>

                    </x-button>
                </div>
            </div> -->

            <!-- Footer Right Menu -->
            <!-- Right Navigation Menu (mapped from $rightNavs) -->


            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4 md:grid-cols-2 w-full lg:grid-cols-3">
                @foreach ($rightNavs as $navSection)
                    <nav class="flex flex-col gap-4 md:gap-6 lg:gap-8">
                        @foreach ($navSection as $navGroup)
                            <div class="flex flex-col gap-1 md:gap-4">
                                <div class="flex gap-2 items-center">
                                    <div class="bg-primary h-1 w-[15px] rounded-xl"></div>
                                    <p class="text-white text-[16px] lg:text-[18px] font-semibold">{{ $navGroup['title'] }}</p>
                                </div>
                                <ul class="flex flex-col gap-1">
                                    @foreach ($navGroup['links'] as $link)
                                        <div class="flex gap-1 md:gap-2 items-center text-white">
                                            <div>
                                                <x-bladewind::icon name="chevron-right" class="!h-4 !w-3 " />
                                            </div>

                                            <!-- Detect if the URL is external by checking if it starts with "http" -->
                                            <a href="{{ $link['url'] }}"
                                                class="text-white-dark text-[12px] lg:text-[14px] hover:text-primary transition-[200ms] hover:transition-[200ms]"
                                                @if (str_starts_with($link['url'], 'http')) target="_blank"
                                                rel="noopener noreferrer" @endif>
                                                {{ $link['text'] }}
                                            </a>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </nav>
                @endforeach
            </div>


        </section>
        <nav class="flex md:hidden flex-col gap-2 ">
            <div class="flex gap-2 items-center">
                <div class="bg-primary h-1 w-[15px] rounded-xl"></div>
                <p class="font-semibold text-[18px] shadow text-white">Contact Us</p>
            </div>
            <div class="flex gap-1  items-center text-white">
                <div>
                    <x-bladewind::icon name="chevron-right" class="!h-3 !w-3 " />
                </div>

                <p class="text-[12px] ">Phone:
                    <span class="text-[12px] hover:text-primary"><a target="_blank"
                            href="https://wa.me/+6281340734686">0813-4073-4686</a></span> /
                    <span class="text-[12px] hover:text-primary"><a target="_blank"
                            href="https://wa.me/+6281524063470">0815-2406-3470</a></span>
                </p>
            </div>
            <div class="flex gap-1 items-center text-white">
                <div>
                    <x-bladewind::icon name="chevron-right" class="!h-3 !w-3 " />
                </div>
                <p class="text-[12px] ">Address: Jl. Andi Djemma No.38, Kec.Tamalate, Makassar, Sulawesi Selatan 90222
                </p>
            </div>
            <div class="flex gap-4">
                @foreach ($links as $link)
                    <a href="{{$link['url']}}">
                        <div class="h-6 w-6 items-center flex rounded-[50%] bg-white justify-center cursor-pointer">
                            <img src="{{$link['path']}}" class="h-4 w-4" />
                        </div>
                    </a>
                @endforeach
            </div>
        </nav>


    </main>
    <section class="flex gap-[10px] items-center self-stretch">
        <div class="h-[2px] bg-white-dark flex-1"></div>
        <div class="text-[10px] text-center lg:text-[14px] font-light  text-white-dark">© 2024 Disaster Management
            Center
            IKATEK. All Rights
            Reserved.</div>
        <div class="h-[2px] bg-white-dark flex-1"></div>
    </section>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
</footer>