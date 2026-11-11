@props([
    'as' => 'div',
    'elevated' => false,
])

@php
    $classes = 'rounded-[6px] border-2 border-ink/20 bg-paper-light';
    $classes .= $elevated ? ' shadow-hard' : '';
@endphp

<{{ $as }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $as }}>
