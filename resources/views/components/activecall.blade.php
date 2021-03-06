@props(['registered'])

@php
$classes = ($registered ?? false)
            ? 'cursor-pointer bg-transparent font-semibold py-2 px-4 rounded'
            : 'cursor-pointer py-2 px-4 rounded hover:bg-gray-500 hover:text-white hover:opacity-50';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>