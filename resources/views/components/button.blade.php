@php
    // Variant class logic
    $variantClass = match ($variant) {
        'fill' => $disabled
        ? "bg-gray-300 text-gray-500 cursor-not-allowed"
        : "bg-$color text-$color-contrast hover:bg-$color-dark",
        'outlined' => $disabled
        ? "bg-transparent border border-gray-300 text-gray-500 cursor-not-allowed"
        : "bg-transparent border border-$color text-$color hover:bg-$color hover:text-$color-contrast",
        'ghost' => $disabled
        ? "bg-transparent text-gray-500 cursor-not-allowed"
        : "bg-transparent text-$color hover:bg-$color/40",
        default => $disabled
        ? "bg-gray-300 text-gray-500 cursor-not-allowed"
        : "bg-$color text-$color-contrast hover:bg-$color-dark",
    };

    // Size class logic
    $sizeClass = match ($size) {
        'small' => 'px-2 py-1',
        'medium' => 'px-4 py-2',
        'large' => 'px-6 py-3',
        'square-sm' => 'p-2',
        'square-md' => 'p-4',
        'square-lg' => 'p-6',
        default => 'px-4 py-2'
    };
    $allignmentClass = match ($allignment) {
        'start' => '',
        'end' => 'end',
        'center' => 'center',
        default => 'center'
    };
@endphp

<button type="{{ $type }}"
    class="{{ $sizeClass }} flex justify-{{ $allignmentClass }} transition-[200ms] hover:transition-[200ms] rounded-{{ $rounded }} {{ $variantClass }} {{ $class }}"
    @if($disabled) disabled @endif {{ $attributes }}>
    {{ $slot }}
</button>