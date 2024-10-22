@php
    $variantClass = match ($variant) {
        'fill' => "bg-$color text-$color-contrast hover:bg-$color-dark",
        'outlined' => "bg-transparent border border-$color text-$color hover:bg-$color hover:text-$color-contrast",
        'ghost' => "bg-transparent text-$color hover:bg-$color/40",
        default => "bg-$color text-$color-contrast hover:bg-$color-dark",
    };

    $sizeClass = match ($size) {
        'small' => 'px-2 py-1 text-xs',
        'medium' => 'px-4 py-2',
        'large' => 'px-6 py-3',
        default => 'px-4 py-2'
    };


@endphp

<button type="{{ $type }}"
    class="{{ $sizeClass }} flex justify-center transition-[200ms] hover:transition-[200ms] rounded-{{ $rounded }} {{ $variantClass }} {{ $class }}"
    @if($disabled) disabled @endif {{ $attributes }}>
    {{ $slot }}
</button>