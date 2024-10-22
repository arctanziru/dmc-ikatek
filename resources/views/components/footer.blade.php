@php
    $links = [
        ['name' => 'Twitter', 'path' => 'icons/twitter.svg'],
        ['name' => 'Instagram', 'path' => 'icons/instagram.svg'],
        ['name' => 'Pinterest', 'path' => 'icons/pinterest.svg'],
        ['name' => 'Youtube', 'path' => 'icons/youtube.svg'],
    ];

    $rightNavs =
        [
            //1
            [
                [
                    'title' => 'About Us',
                    'links' => [
                        ['text' => 'Our Mission', 'url' => '/'],
                        ['text' => 'Partnership', 'url' => '/'],
                        ['text' => 'Accountability', 'url' => '/']
                    ]
                ],
                [
                    'title' => 'Our Reach',
                    'links' => [
                        ['text' => 'Provinces And Region', 'url' => '/'],

                    ]
                ],

            ],
            //2
            [
                [
                    'title' => 'Our Works',
                    'links' => [
                        ['text' => 'Disaster Response Plan', 'url' => '/'],
                        ['text' => 'Disaster Risk Reduction', 'url' => '/'],
                        ['text' => 'Innovation and Tech', 'url' => '/'],
                        ['text' => 'IT System', 'url' => '/'],
                        ['text' => 'System Management Development', 'url' => '/'],
                    ]
                ]
            ],
            //3
            [
                [
                    'title' => 'Get Involved',
                    'links' => [
                        ['text' => 'Donate', 'url' => '/'],
                        ['text' => 'Share The Meal App', 'url' => '/'],
                    ]
                ]
            ],

        ]

@endphp


<footer class="w-screen flex p-16 bg-dark flex-col gap-8 items-center justify-center">
    <main class="max-w-[1440px] gap-8 w-full flex items-start justify-center">
        <section class="flex flex-col gap-8 max-w-[360px]">
            <div class="text-primary text-[32px] flex gap-6 items-center">
                <img src="{{ asset('images/Logo.png') }}" alt="Site Logo" class="h-[42px]">
                DMC IKATEK-UH
            </div>
            <p class="text-white text-[12px] font-[500]">
                <span class="text-primary text-[12px] font-[500]">

                    Disaster Management Center (DMC) IKATEK
                </span>
                is dedicated to providing timely disaster management, relief,
                and recovery operations. Through collaboration with governments, NGOs, and the private sector, we strive
                to minimize the impact of disasters and support affected communities. Our mission includes disaster risk
                reduction, emergency response, and long-term resilience building.
            </p>
            <nav class="flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <div class="bg-primary h-1 w-[15px] rounded-xl"></div>
                    <p class="font-semibold text-[18px] shadow text-white">Contact Us</p>
                </div>
                <div class="flex gap-2 items-center text-white">
                    <img src="{{ asset('icons/arrow-right.svg') }}" alt="Site Logo" class=" shrink-0">

                    <p class="text-[12px] font-light">Phone: +123 456 7890</p>
                </div>
                <div class="flex gap-2 items-center text-white">
                    <img src="{{ asset('icons/arrow-right.svg') }}" alt="Site Logo" class=" shrink-0">

                    <p class="text-[12px] font-light">Address: DMC IKATEK, 456 Relief Avenue, City, Country</p>
                </div>
                <div class="flex gap-4">
                    @foreach ($links as $link)
                        <a>
                            <div class="h-8 w-8 items-center flex rounded-[50%] bg-white justify-center cursor-pointer">
                                <img src="{{$link['path']}}" />
                            </div>
                        </a>
                    @endforeach
                </div>
            </nav>
        </section>

        <section class="flex flex-col gap-6 flex-1">

            <!-- NewsLetter -->
            <div class="flex gap-4 items-center ">
                <div class="flex gap-4 flex-1">
                    <div class="bg-[rgba(220,134,48,0.20)] max-w-[60px] max-h-[60px] rounded-lg p-3">
                        <img src="icons/sms.svg" />
                    </div>
                    <div class="flex text-white flex-col justify-between">
                        <p class="text-[24px] font-semibold">Enter Your Email</p>
                        <p class="text-[14px]">We Will Contact You Soon</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <input class="p-[12px_8px] bg-transparent text-white text-[14px] min-w-[280px] h-max rounded-md"
                        placeholder="Enter Email" />
                    <x-button class="h-full self-stretch bg-white">
                        <p class="text-black">
                            →
                        </p>

                    </x-button>
                </div>
            </div>

            <!-- Footer Right Menu -->
            <!-- Right Navigation Menu (mapped from $rightNavs) -->
            <div class="flex justify-between">
                @foreach ($rightNavs as $navSection)
                    <!-- Each $navSection contains an array of navigation groups -->
                    <nav class="flex flex-col gap-7">
                        @foreach ($navSection as $navGroup)
                            <!-- Title of the navigation group -->
                            <div class="flex flex-col gap-4">
                                <div class="flex gap-2 items-center">
                                    <div class="bg-primary h-1 w-[15px] rounded-xl"></div>
                                    <p class="text-white text-lg font-semibold">{{ $navGroup['title'] }}</p>
                                </div>
                                <ul class="flex flex-col gap-1">
                                    <!-- Iterate over the links in the group -->
                                    @foreach ($navGroup['links'] as $link)
                                        <div class="flex gap-2 items-center text-white">
                                            <img src="{{ asset('icons/arrow-right.svg') }}" alt="Site Logo" class=" shrink-0">

                                            <a href="{{ $link['url'] }}"
                                                class="text-white-dark text-sm hover:text-primary transition-[200ms] hover:transition-[200ms]">{{ $link['text'] }}</a>
                                        </div>
                                        <li>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </nav>
                @endforeach
            </div>
        </section>

    </main>
    <section class="flex gap-[10px] items-center self-stretch">
        <div class="h-[2px] bg-white-dark flex-1"></div>
        <div class="text-[14px] font-light text-white-dark">© 2024 Disaster Management Center IKATEK. All Rights
            Reserved.</div>
        <div class="h-[2px] bg-white-dark flex-1"></div>
    </section>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
</footer>