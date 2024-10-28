<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'DMC Ikatek' }}</title>
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs" defer></script>

    <x-bladewind::notification />
    @livewireStyles
    @livewireScripts
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    </link>

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
</head>

<body class="m-0 p-0 w-screen overflow-x-hidden">

    {{ $slot }}

</body>

</html>