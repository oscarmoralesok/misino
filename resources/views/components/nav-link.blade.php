@props(['active'])

@php
$classes = ($active ?? false)
            ? 'transition duration-150 ease-in-out focus:outline-none'
            : 'transition duration-150 ease-in-out focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
