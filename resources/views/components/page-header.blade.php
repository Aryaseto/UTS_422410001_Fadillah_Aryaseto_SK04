@props([
    'title',
    'description' => null,
    'eyebrow' => null,
])

<header {{ $attributes->merge(['class' => 'mb-8 flex flex-col gap-5 border-b-2 border-ink/15 pb-6 sm:flex-row sm:items-end sm:justify-between']) }}>
    <div class="min-w-0">
        @if ($eyebrow)
            <p class="mb-2 flex items-center gap-2 font-mono text-[10px] font-semibold uppercase tracking-[0.2em] text-ink-faint">
                <span class="inline-block h-1.5 w-1.5 bg-rust" aria-hidden="true"></span>
                {{ $eyebrow }}
            </p>
        @endif

        <h1 class="text-balance text-3xl leading-[1.08] text-ink sm:text-4xl lg:text-[2.65rem]">{{ $title }}</h1>

        @if ($description)
            <p class="mt-3 max-w-[65ch] text-sm leading-relaxed text-ink-soft sm:text-[15px]">{{ $description }}</p>
        @endif
    </div>

    @if (isset($actions) && ! $actions->isEmpty())
        <div class="flex shrink-0 flex-wrap items-center gap-2.5">
            {{ $actions }}
        </div>
    @endif
</header>
