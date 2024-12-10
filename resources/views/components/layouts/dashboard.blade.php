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
[
'route' => 'dashboard.disaster',
'icon' => 'fire',
'label' => 'Disaster'
],
[
'route' => 'dashboard.covered-area',
'icon' => 'map',
'label' => 'Covered Area'
],
[
'route' => 'dashboard.disaster.program.areaOfWork',
'icon' => 'square-3-stack-3d',
'label' => 'Disaster program area of work'
],
[
'route' => 'dashboard.disaster.program.category',
'icon' => 'tag',
'label' => 'Disaster program category'
],
[
'route' => 'dashboard.disaster.program',
'icon' => 'chart-pie',
'label' => 'Disaster program'
],
[
'route' => 'dashboard.donation',
'icon' => 'banknotes',
'label' => 'Donation'
],
];

@endphp


<!DOCTYPE html>

<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? 'Dashboard - DMC Ikatek-UH' }}</title>
  <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
  <script defer src="https://unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
  <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon">

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
              contrast: "#ffffff",
            },
            secondary: {
              DEFAULT: "#35408D",
              light: "#5966B0",
              dark: "#2A336E",
              contrast: "#ffffff",
            },
            white: {
              DEFAULT: "#ffffff",
              light: "#f0f0f0",
              dark: "#cccccc",
              contrast: "#222222",
            },
            dark: {
              DEFAULT: "#222222",
              light: "#2e2e2e",
              dark: "#1a1a1a",
              contrast: "#ffffff",
            },
          },
        }
      }
    }
    localStorage.removeItem('theme');
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

<body class="m-0 relative p-0 w-screen h-screen overflow-x-hidden text-black">
  <x-bladewind::notification />
  <!-- Overlay -->
  <div id="overlay" class="w-screen h-full fixed top-0 left-0 bg-black/80 z-[80] hidden lg:hidden"></div>

  <!-- Sidebar -->
  <aside id="sidebar"
    class="p-4 z-[100] -translate-x-full lg:translate-x-0 bg-dark text-white w-[240px] h-full fixed flex flex-col justify-between transition-transform duration-300">
    <div class="flex flex-col flex-1 overflow-y-auto gap-6">
      <!-- Sidebar Header -->
      <div class="flex font-semibold items-center gap-2">
        <img src="{{ asset('images/Logo.png') }}" class="!w-[42px] !h-[42px]" alt="Logo" />
        <p class="text-[16px]">DMC IKATEK-UH</p>
      </div>

      <!-- Navigation Links -->
      <nav class="flex flex-col gap-3 overflow-y-auto flex-1">
        @foreach ($navLinks as $link)
        @php
        $isActive = Route::currentRouteName() === $link['route'];
        @endphp
        <a href="{{ route($link['route']) }}"
          class="p-[12px_14px_12px_12px] rounded {{ $isActive ? 'bg-primary text-dark font-bold hover:bg-primary-dark' : 'hover:bg-primary hover:text-dark hover:font-bold' }} flex gap-4 items-center justify-between duration-200 text-[14px]">
          <div class="flex items-center gap-4">
            <x-bladewind::icon name="{{ $link['icon'] }}" class="!h-6 !w-6" />
            <p class="flex-1">{{ $link['label'] }}</p>
          </div>
          <div class="{{ $isActive ? 'bg-secondary' : 'bg-transparent' }} rounded-sm w-[2px] h-full"></div>
        </a>
        @endforeach
      </nav>
    </div>
    <!-- Sidebar Footer -->
    <div class="border-t bg-dark w-full py-2 flex flex-col gap-2 bottom-0 sticky border-secondary-light">
      <div class="w-full flex">
        <x-button variant="ghost" size="small" class="w-full lg:hidden">
          <p class="w-full text-left">
            <x-bladewind::icon name="user-circle" class="!h-6 !w-6" />
            Logout
          </p>
        </x-button>
      </div>
      <div class=" text-sm text-center w-full  ">
        <p class="font-poppins">© 2024 DMC Ikatek</p>
      </div>
    </div>

  </aside>

  <!-- Main Content Wrapper -->
  <div class="ml-0 lg:ml-[240px] relative">
    <!-- Sticky Navbar -->
    <nav class="bg-dark-dark z-10 text-white sticky top-0 p-1 md:p-4 flex justify-between items-center shadow-md">
      <div class="text-sm md:text-md lg:text-lg flex gap-2 font-bold items-center text-center">
        <x-button id="sidebarToggle" variant="ghost" size="square-sm" rounded="[50%]" class="lg:hidden">
          <x-bladewind::icon name="bars-3" class="!h-6 !w-6" />
        </x-button>
        DMC Ikatek Dashboard
      </div>

      <div class="relative">
        <x-button class="hidden lg:flex" size="small" variant="ghost" onclick="toggleDropdown()">
          <div class="flex items-center">
            <span class="font-medium">Hello, {{ Auth::user()->name }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </div>
        </x-button>

        <!-- Dropdown Menu -->
        <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50 overflow-hidden">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
              Logout
            </button>
          </form>
          @csrf
          <a href="{{ route('password.reset') }}">
            <button class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
              Reset Password
            </button>
          </a>
        </div>
      </div>
    </nav>

    {{ $slot }}
  </div>



  @if (session()->has('message') && session()->has('title'))
  <script>
    showNotification("{{ session('title') }}", "{{ session('message') }}");
  </script>
  @endif

  @auth
  <script src="{{ asset('js/enable-push.js') }}" defer></script>
  @endauth

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');
      const toggleButton = document.getElementById('sidebarToggle');

      function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        overlay.classList.remove('hidden');
      }

      function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        overlay.classList.add('hidden');
      }

      toggleButton.addEventListener('click', openSidebar);
      overlay.addEventListener('click', closeSidebar);
    });

    function toggleDropdown() {
      const dropdown = document.getElementById('profileDropdown');
      dropdown.classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
      const dropdown = document.getElementById('profileDropdown');
      const button = event.target.closest('button');

      if (!dropdown.contains(event.target) && !button) {
        dropdown.classList.add('hidden');
      }
    });
  </script>
</body>

</html>
<!-- JavaScript to Toggle Sidebar and Overlay -->