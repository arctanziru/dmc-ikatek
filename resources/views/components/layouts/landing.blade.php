<x-layouts.app>
  <x-slot name="title">{{ $title }}</x-slot>
  <x-navbar variant="{{ request()->is('/') ? 'transparent' : 'default' }}" />
  {{ $slot }}
  <x-footer />
</x-layouts.app>