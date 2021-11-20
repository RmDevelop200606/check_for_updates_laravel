@props(['url'])

@php
    $classes = "bg-blue-500 hover:bg-blue-400 font-semibold text-white py-2 px-4 border border-blue-500 rounded";
@endphp

<a href="{{ $url }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>