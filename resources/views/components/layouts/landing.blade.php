<x-layouts.app>
  <div>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-navbar variant="{{ request()->is('/') ? 'transparent' : 'default' }}" />
    {{ $slot }}
    <x-footer />
  </div>
</x-layouts.app>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>