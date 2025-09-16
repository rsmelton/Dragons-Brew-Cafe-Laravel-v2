@props(['route', 'active' => false ])

@php
    $classes = $active ?? false ? 'text-blue-500 text-sm sm:text-lg font-bold' : 'text-white hover:text-blue-500 text-sm sm:text-lg font-bold';
@endphp

<a {{ $attributes->merge([ 'class' => $classes ]) }}>
    {{ $slot }}
</a>