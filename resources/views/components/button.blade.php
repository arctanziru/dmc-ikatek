@php
$variantClass = match($variant) {
'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',
'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white',
'danger' => 'bg-red-600 hover:bg-red-700 text-white',
default => 'bg-gray-300 hover:bg-gray-400 text-black',
};
@endphp

<button
    type="{{ $type }}"
    class="px-4 py-2 rounded {{ $variantClass }} {{ $class }}"
    @if($disabled) disabled @endif
    {{ $attributes }}>
    {{ $slot }}
</button> 