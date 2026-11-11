@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'icon' => null,
    'iconAfter' => null,
])

@php
    $variants = [
        'primary' => 'border-ink bg-ink text-paper-light shadow-hard-sm hover:-translate-y-0.5 hover:shadow-hard active:translate-y-0 active:shadow-none',
        'secondary' => 'border-ink bg-paper-light text-ink shadow-hard-sm hover:-translate-y-0.5 hover:bg-cream active:translate-y-0 active:shadow-none',
        'accent' => 'border-ink bg-tan text-ink shadow-hard-sm hover:-translate-y-0.5 hover:bg-tan-dark active:translate-y-0 active:shadow-none',
        'danger' => 'border-ink bg-rust text-paper-light shadow-hard-sm hover:-translate-y-0.5 hover:bg-[#87361f] active:translate-y-0 active:shadow-none',
        'ghost' => 'border-transparent bg-transparent text-ink-soft hover:border-ink/20 hover:bg-ink/5 hover:text-ink',
    ];

    $sizes = [
        'sm' => 'h-11 px-3 text-[10px] sm:h-9',
        'md' => 'h-11 px-4 text-[11px]',
        'lg' => 'h-12 px-5 text-xs',
    ];

    $classes = 'inline-flex shrink-0 items-center justify-center gap-2 rounded-[4px] border-2 font-mono font-semibold uppercase tracking-[0.12em] transition duration-150 ease-out disabled:pointer-events-none disabled:opacity-45';
    $classes .= ' '.($variants[$variant] ?? $variants['primary']);
    $classes .= ' '.($sizes[$size] ?? $sizes['md']);

    $element = $href ? 'a' : 'button';
@endphp

<{{ $element }}
    @if ($href)
        href="{{ $href }}"
    @else
        type="{{ $type }}"
    @endif
    {{ $attributes->merge(['class' => $classes]) }}
>
    @if ($icon)
        <x-icon :name="$icon" class="h-4 w-4" />
    @endif
    {{ $slot }}
    @if ($iconAfter)
        <x-icon :name="$iconAfter" class="h-4 w-4" />
    @endif
</{{ $element }}>
