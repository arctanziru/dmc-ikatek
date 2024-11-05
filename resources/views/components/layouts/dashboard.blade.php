@php

  $navLinks = [
    [
    'route' => 'dashboard',
    'icon' => 'chart-bar-square',
    'label' => 'Dashboard'
    ],
    [
    'route' => 'users',
    'icon' => 'user-circle',
    'label' => 'Users'
    ],
    [
    'route' => 'dashboard.news',
    'icon' => 'newspaper',
    'label' => 'News'
    ],
  ];

@endphp


<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{ $title ?? 'Dashboard - DMC Ikatek' }}</title>
  <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
  <script defer src="https://unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
              contrast: "#222222"
            },
            dark: {
              DEFAULT: "#222222",
              light: "#2e2e2e",
              contrast: "#ffffff"
            },
          },
        }
      }
    }
    localStorage.removeItem('theme');
  </script>
</head>

<body class="m-0 p-0 w-screen h-screen overflow-x-hidden text-black">
  <x-bladewind::notification />
  <aside class="p-4 bg-dark text-white w-[240px] h-screen fixed flex flex-col justify-between">

    <div class="flex flex-col gap-6">

      <!-- Sidebar Header -->
      <div class="flex font-semibold items-center gap-2">
        <img src="images/Logo.png" class="!w-[42px] !h-[42px]" />
        <p class="text-[16px] ">
          DMC IKATEK-UH
        </p>
      </div>

      <!-- Navigation Links -->
      <nav class="flex flex-col gap-3">
        @foreach ($navLinks as $link)
          @php
      // Check if the current route name matches the link's route
      $isActive = Route::currentRouteName() === $link['route'];
      @endphp

          <a href="{{ route($link['route']) }}"
            class="p-[12px_14px_12px_12px] rounded {{ $isActive ? 'bg-primary text-dark font-bold hover:bg-primary-dark' : 'hover:bg-primary hover:text-dark hover:font-bold' }} flex gap-4 items-center justify-between duration-200 text-[14px]">
            <div class="flex items-center gap-4">
            <x-bladewind::icon name="{{ $link['icon'] }}" class="!h-6 !w-6" />
            <p>{{ $link['label'] }}</p>
            </div>
            <div class="{{ $isActive ? 'bg-secondary' : 'bg-transparent ' }} rounded-sm hover: w-[2px] h-full"></div>
          </a>
    @endforeach
      </nav>

    </div>


    <!-- Sidebar Footer -->
    <div class="p-4 text-sm border-t border-secondary-light">
      <p class="font-poppins">© 2024 DMC Ikatek</p>
    </div>
  </aside>

  <!-- Main Content Wrapper -->
  <div class="ml-[240px] relative">
    <!-- Sticky Navbar -->
    <nav class="bg-secondary-dark text-white sticky top-0 z-10 p-4 flex justify-between items-center shadow-md">
      <div class="text-lg font-bold">
        DMC Ikatek Dashboard
      </div>

      <div class="relative">
        <button onclick="toggleDropdown()" class="flex items-center space-x-2 focus:outline-none">
          <span class="font-medium">Hello, {{ Auth::user()->name }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </button>

        <!-- Dropdown Menu -->
        <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
              Logout
            </button>
          </form>
        </div>
      </div>
    </nav>

    {{ $slot }}
  </div>

  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('hidden');
    }

    document.addEventListener('click', function (event) {
      const dropdown = document.getElementById('profileDropdown');
      const button = event.target.closest('button');

      if (!dropdown.contains(event.target) && !button) {
        dropdown.classList.add('hidden');
      }
    });
  </script>


</body>

</html>