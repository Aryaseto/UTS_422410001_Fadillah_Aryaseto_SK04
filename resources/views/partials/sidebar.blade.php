@php
    $navigasi = [
        ['label' => 'Ruang kerja', 'route' => 'dashboard', 'icon' => 'layout', 'nomor' => '00', 'aktif' => request()->routeIs('dashboard')],
        ['label' => 'Koleksi pita', 'route' => 'koleksi.index', 'icon' => 'cassette-tape', 'nomor' => '01', 'aktif' => request()->routeIs('koleksi.*')],
        ['label' => 'Kategori format', 'route' => 'kategori.index', 'icon' => 'tag', 'nomor' => '02', 'aktif' => request()->routeIs('kategori.*')],
        ['label' => 'Tindakan restorasi', 'route' => 'tindakan.index', 'icon' => 'wrench', 'nomor' => '03', 'aktif' => request()->routeIs('tindakan.*')],
    ];
@endphp

<div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-ink/60 lg:hidden" aria-hidden="true"></div>

<aside
    id="app-sidebar"
    class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r-2 border-ink bg-ink text-paper-light transition-transform duration-200 ease-out lg:translate-x-0"
    aria-label="Navigasi utama"
>
    <div class="flex items-start justify-between gap-3 border-b border-paper/15 px-5 py-5">
        <a href="{{ route('dashboard') }}" class="group block">
            <span class="block font-display text-2xl font-semibold leading-none tracking-tight text-cream">Pita Lestari</span>
            <span class="mt-2 block font-mono text-[9px] uppercase tracking-[0.22em] text-paper/55 transition group-hover:text-tan">Ruang restorasi arsip analog</span>
        </a>

        <button
            type="button"
            data-sidebar-close
            class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-[4px] border border-paper/20 text-paper/70 transition hover:bg-paper/10 hover:text-paper lg:hidden"
            aria-label="Tutup navigasi"
        >
            <x-icon name="x" class="h-5 w-5" />
        </button>
    </div>

    <div class="px-5 py-5">
        <div class="label-notch border-2 border-paper/25 bg-cream p-3 text-ink shadow-[4px_4px_0_0_rgba(212,163,115,0.55)]">
            <div class="flex items-center justify-between font-mono text-[8px] font-semibold uppercase tracking-[0.18em] text-ink-soft">
                <span>SK04 / 2026</span>
                <span>Sisi A</span>
            </div>

            <div class="mt-2.5 flex items-center gap-2.5 border-y border-ink/25 py-2.5">
                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full border-2 border-ink/50">
                    <span class="h-1.5 w-1.5 rounded-full bg-ink/70"></span>
                </span>
                <span class="flex-1 space-y-1" aria-hidden="true">
                    <span class="block h-px bg-ink/35"></span>
                    <span class="block h-px bg-ink/20"></span>
                    <span class="block h-px bg-ink/35"></span>
                </span>
                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full border-2 border-ink/50">
                    <span class="h-1.5 w-1.5 rounded-full bg-ink/70"></span>
                </span>
            </div>

            <p class="mt-2 font-mono text-[8px] uppercase tracking-[0.2em] text-ink-soft">Pita magnetik · koleksi arsip</p>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 pb-4">
        <p class="px-3 pb-2 pt-1 font-mono text-[9px] font-semibold uppercase tracking-[0.22em] text-paper/65">Rak kerja</p>

        <ul class="space-y-1">
            @foreach ($navigasi as $item)
                <li>
                    <a
                        href="{{ route($item['route']) }}"
                        @if ($item['aktif']) aria-current="page" @endif
                        class="group flex min-h-11 items-center gap-3 rounded-[4px] border-2 px-3 py-2.5 font-mono text-[11px] font-medium uppercase tracking-[0.11em] transition {{ $item['aktif'] ? 'border-cream bg-cream text-ink shadow-[3px_3px_0_0_#D4A373]' : 'border-transparent text-paper/65 hover:border-paper/20 hover:bg-paper/5 hover:text-paper' }}"
                    >
                        <x-icon :name="$item['icon']" class="h-4 w-4 shrink-0 {{ $item['aktif'] ? 'text-rust' : 'text-paper/45 group-hover:text-tan' }}" />
                        <span class="flex-1">{{ $item['label'] }}</span>
                        <span class="font-mono text-[9px] {{ $item['aktif'] ? 'text-ink-faint' : 'text-paper/60' }}">{{ $item['nomor'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="my-4 border-t border-paper/10"></div>

        <a
            href="{{ route('koleksi.create') }}"
            class="flex min-h-11 items-center justify-center gap-2 rounded-[4px] border-2 border-paper/25 bg-tan px-3 py-2.5 font-mono text-[11px] font-semibold uppercase tracking-[0.11em] text-ink shadow-[3px_3px_0_0_#FAEDCD] transition hover:-translate-y-0.5 hover:bg-[#e0b183] active:translate-y-0 active:shadow-none"
        >
            <x-icon name="plus" class="h-4 w-4" />
            Catat koleksi baru
        </a>
    </nav>

    <div class="border-t border-paper/15 px-5 py-4">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="font-mono text-[9px] uppercase tracking-[0.18em] text-paper/65">Meja kerja</p>
                <p class="mt-1 text-sm text-paper/80">{{ now()->locale('id')->translatedFormat('l, j F Y') }}</p>
            </div>
            <span class="stamp inline-block px-2 py-1 font-mono text-[8px] font-semibold uppercase tracking-[0.14em] text-tan">Arsip</span>
        </div>
        <div class="mt-4 flex items-center justify-between border-t border-paper/10 pt-3 font-mono text-[8px] uppercase tracking-[0.15em] text-paper/60">
            <span>Laravel 12</span>
            <span>MySQL</span>
        </div>
    </div>
</aside>
