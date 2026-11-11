@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => false,
])

@php
    $styles = [
        'success' => [
            'wrapper' => 'border-sage bg-sage-light text-ink',
            'icon' => 'check-circle',
            'accent' => 'text-ink',
        ],
        'error' => [
            'wrapper' => 'border-rust bg-rust-light text-rust',
            'icon' => 'warning',
            'accent' => 'text-rust',
        ],
        'warning' => [
            'wrapper' => 'border-ochre bg-ochre-light text-ochre',
            'icon' => 'warning',
            'accent' => 'text-ochre',
        ],
        'info' => [
            'wrapper' => 'border-ink/30 bg-cream text-ink',
            'icon' => 'info',
            'accent' => 'text-ink',
        ],
    ];
    $style = $styles[$type] ?? $styles['info'];
@endphp

<div
    @if ($dismissible) data-flash @endif
    role="{{ $type === 'error' ? 'alert' : 'status' }}"
    {{ $attributes->merge(['class' => 'flex items-start gap-3 rounded-[4px] border-2 px-4 py-3 text-sm shadow-hard-sm '.$style['wrapper']]) }}
>
    <x-icon :name="$style['icon']" class="mt-0.5 h-5 w-5 shrink-0 {{ $style['accent'] }}" />

    <div class="min-w-0 flex-1">
        @if ($title)
            <p class="font-mono text-[11px] font-semibold uppercase tracking-[0.13em]">{{ $title }}</p>
        @endif
        <div class="leading-relaxed {{ $title ? 'mt-1' : '' }}">{{ $slot }}</div>
    </div>

    @if ($dismissible)
        <button
            type="button"
            data-flash-close
            class="-mr-1 -mt-1 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-[3px] transition hover:bg-ink/10"
            aria-label="Tutup pemberitahuan"
        >
            <x-icon name="x" class="h-4 w-4" />
        </button>
    @endif
</div>
