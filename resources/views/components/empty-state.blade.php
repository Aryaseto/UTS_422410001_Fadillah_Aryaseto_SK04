@props([
    'title',
    'description' => null,
    'icon' => 'cassette-tape',
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center rounded-[6px] border-2 border-dashed border-ink/25 bg-paper-light/70 px-6 py-14 text-center']) }}>
    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-[4px] border-2 border-ink/25 bg-cream text-ink">
        <x-icon :name="$icon" class="h-7 w-7" />
    </div>
    <h2 class="text-xl text-ink">{{ $title }}</h2>
    @if ($description)
        <p class="mt-2 max-w-md text-sm leading-relaxed text-ink-soft">{{ $description }}</p>
    @endif
    @if (isset($actions) && ! $actions->isEmpty())
        <div class="mt-5 flex flex-wrap justify-center gap-2.5">
            {{ $actions }}
        </div>
    @endif
</div>
