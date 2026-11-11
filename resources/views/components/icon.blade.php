@props(['name', 'class' => 'h-5 w-5'])

@php
    $path = resource_path("icons/{$name}.svg");
    $svg = is_file($path) ? file_get_contents($path) : '';
    $svg = $svg !== ''
        ? preg_replace('/<svg /', '<svg class="'.e($class).'" aria-hidden="true" focusable="false" ', $svg, 1)
        : '';
@endphp

{!! $svg !!}
