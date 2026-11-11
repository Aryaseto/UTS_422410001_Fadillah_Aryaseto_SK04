@php
    $remah = match (true) {
        request()->routeIs('dashboard') => 'Ruang kerja',
        request()->routeIs('koleksi.create') => 'Koleksi / Catat baru',
        request()->routeIs('koleksi.edit') => 'Koleksi / Sunting',
        request()->routeIs('koleksi.show') => 'Koleksi / Lembar detail',
        request()->routeIs('koleksi.*') => 'Koleksi / Daftar',
        request()->routeIs('kategori.*') => 'Kategori / Format',
        request()->routeIs('tindakan.*') => 'Tindakan / Master',
        default => 'Ruang kerja',
    };
@endphp

<header class="sticky top-0 z-30 border-b-2 border-ink/15 bg-paper">
    <div class="mx-auto flex h-16 w-full max-w-[1440px] items-center gap-3 px-4 sm:px-6 lg:px-10">
        <button
            type="button"
            id="sidebar-open"
            class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-[4px] border-2 border-ink/20 bg-paper-light text-ink transition hover:bg-cream lg:hidden"
            aria-label="Buka navigasi"
            aria-controls="app-sidebar"
            aria-expanded="false"
        >
            <x-icon name="list" class="h-5 w-5" />
        </button>

        <a href="{{ route('dashboard') }}" class="flex min-h-11 min-w-0 items-center gap-2.5 lg:hidden">
            <span class="flex h-8 w-8 items-center justify-center rounded-[3px] border-2 border-ink bg-ink text-cream">
                <x-icon name="cassette-tape" class="h-4 w-4" />
            </span>
            <span class="truncate font-display text-lg font-semibold leading-none">Pita Lestari</span>
        </a>

        <div class="hidden min-w-0 items-center gap-2 font-mono text-[10px] uppercase tracking-[0.16em] text-ink-faint lg:flex">
            <a href="{{ route('dashboard') }}" class="transition hover:text-ink">Arsip</a>
            <span aria-hidden="true">/</span>
            <span class="truncate text-ink-soft">{{ $remah }}</span>
        </div>

        <form action="{{ route('koleksi.index') }}" method="GET" role="search" class="relative ml-auto hidden w-full max-w-sm md:block">
            <label for="global-search" class="sr-only">Cari koleksi pita</label>
            <x-icon name="magnifying-glass" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-faint" />
            <input
                id="global-search"
                data-global-search
                type="search"
                name="q"
                value="{{ request()->routeIs('koleksi.index') ? request('q') : '' }}"
                placeholder="Cari kode atau nama koleksi"
                class="h-11 w-full rounded-[4px] border-2 border-ink/20 bg-paper-light pl-9 pr-10 text-sm text-ink transition placeholder:text-ink-faint focus:border-ink focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rust"
            >
            <span class="pointer-events-none absolute right-3 top-1/2 hidden -translate-y-1/2 lg:block">
                <kbd class="kbd text-ink-faint">/</kbd>
            </span>
        </form>

        <x-button href="{{ route('koleksi.create') }}" size="sm" icon="plus" class="ml-auto md:ml-2">
            Catat koleksi
        </x-button>
    </div>
</header>
