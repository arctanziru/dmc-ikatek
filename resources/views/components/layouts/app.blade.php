<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'DMC Ikatek-UH' }}</title>
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon" />

    <meta name="title" content="DMC Ikatek-UH">
    <meta name="description" content="DMC Ikatek-UH (Disaster Management Center Ikatek Universitas Hasanuddin / UNHAS) is a disaster management center at Hasanuddin University.">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="DMC Ikatek-UH, DMC Ikatek UH, DMC Ikatek Unhas, Disaster Management Center, Hasanuddin University, UNHAS, Disaster Management, Disaster, Management, Center, Universitas Hasanuddin, Universitas, Hasanuddin, Makassar, Sulawesi Selatan, Sulawesi, Selatan, Indonesia, South Sulawesi, South, Indonesia">
    <meta name="author" content="Ikatan Alumni Teknik Universitas Hasanuddin (Unhas)">
    <meta name="publisher" content="Ikatan Alumni Teknik Universitas Hasanuddin (Unhas)">

    <meta name="geo.placename" content="Makassar, Sulawesi Selatan, Indonesia">
    <meta name="geo.region" content="ID-SN">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://dmcikatek-uh.org/">
    <meta property="og:title" content="DMC Ikatek-UH">
    <meta property="og:description" content="DMC Ikatek-UH (Disaster Management Center Ikatek Universitas Hasanuddin / UNHAS) is a disaster management center at Hasanuddin University.">
    <meta property="og:image" content="https://dmcikatek-uh.org/images/Logo.png">
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="512">


    <x-bladewind::notification />
    @livewireStyles
    @livewireScripts
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <script>
        tailwind.config = {
            theme: {
                extend: {

                    fontFamily: {
                        poppins: ['Inter', 'sans-serif'], // Add Roboto font
                        poppins: ['Poppins', 'sans-serif'], // Add Roboto font
                    },

                    colors: {
                        primary: {
                            DEFAULT: "#dc8630",
                            light: "#f4a85a ",
                            dark: "#b36d27 ",
                            contrast: "#ffffff"
                        },
                        secondary: {
                            DEFAULT: "#35408D",
                            light: "#5966B0",
                            dark: "#2A336E",
                            contrast: "#ffffff"
                        },
                        white: {
                            DEFAULT: "#ffffff",
                            light: "#f0f0f0",
                            dark: "#cccccc",
                            contrast: "#222222"
                        },
                        dark: {
                            DEFAULT: "#222222",
                            light: "#2e2e2e",
                            dark: "#1a1a1a",
                            contrast: "#ffffff"
                        },
                    },
                }
            }
        }
        localStorage.theme = 'light'
    </script>

    <style>
        * {
            --scrollbar-color-thumb: #cccccc;
            --scrollbar-color-thumb-hover: #cccccc;
            --scrollbar-color-track: rgba(256, 256, 256, 0.1);
            --scrollbar-width: thin;
            --scrollbar-width-legacy: 12px;
        }

        @supports (scrollbar-width: auto) {
            * {
                scrollbar-color: var(--scrollbar-color-thumb) var(--scrollbar-color-track);
                scrollbar-width: var(--scrollbar-width);
            }
        }

        @supports selector(::-webkit-scrollbar) {
            *::-webkit-scrollbar-thumb {
                background: var(--scrollbar-color-thumb);
            }

            *::-webkit-scrollbar-thumb:hover {
                background: var(--scrollbar-color-thumb-hover);
            }

            *::-webkit-scrollbar-track {
                background: var(--scrollbar-color-track);
            }

            *::-webkit-scrollbar {
                max-width: var(--scrollbar-width-legacy);
                max-height: var(--scrollbar-width-legacy);
            }
        }
    </style>
</head>

<body class="m-0 p-0 w-screen overflow-x-hidden">
    <x-bladewind::notification />
    @if (session()->has('message') && session()->has('title'))
    <script>
        showNotification("{{ session('title') }}", "{{ session('message') }}");
    </script>
    @endif

    {{ $slot }}

</body>

</html>