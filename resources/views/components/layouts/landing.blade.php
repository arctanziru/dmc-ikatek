<x-layouts.app>
  <div>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-navbar variant="{{ request()->is('/') ? 'transparent' : 'default' }}" />
    {{ $slot }}
    <x-footer />
  </div>
</x-layouts.app>