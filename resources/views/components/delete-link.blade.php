@props(['url'])

@php
    $classes = "bg-transparent hover:bg-red-500 text-red-500 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded";
@endphp

<a href="{{ $url }}" {{ $attributes->merge(['class' => $classes]) }} onclick="return confirm('削除してよろしいですか？')">
    {{ $slot }}
</a>