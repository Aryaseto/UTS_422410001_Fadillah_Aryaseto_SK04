@extends('layouts.app')

@section('title', 'Tindakan Restorasi')

@section('content')
    <x-page-header
        eyebrow="Master data · {{ $tindakan->total() }} tindakan"
        title="Tindakan restorasi"
        description="Katalog tindakan yang dapat dipilih pada setiap koleksi. Setiap pemilihan menyimpan status dan tanggalnya sendiri."
    >
        <x-slot name="actions">
            <x-button href="{{ route('tindakan.create') }}" icon="plus">Tambah tindakan</x-button>
        </x-slot>
    </x-page-header>

    <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form action="{{ route('tindakan.index') }}" method="GET" role="search" class="flex w-full max-w-md gap-2">
            <div class="relative flex-1">
                <label for="tindakan-search" class="sr-only">Cari tindakan restorasi</label>
                <x-icon name="magnifying-glass" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-faint" />
                <input
                    id="tindakan-search"
                    type="search"
                    name="q"
                    value="{{ $q }}"
                    placeholder="Cari nama tindakan"
                    class="h-11 w-full rounded-[4px] border-2 border-ink/20 bg-paper-light pl-9 pr-3 text-sm text-ink transition placeholder:text-ink-faint focus:border-ink focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rust"
                >
            </div>
            <x-button type="submit" variant="secondary">Cari</x-button>
            @if (filled($q))
                <x-button href="{{ route('tindakan.index') }}" variant="ghost">Reset</x-button>
            @endif
        </form>

        <p class="font-mono text-[10px] uppercase tracking-[0.12em] text-ink-faint">
            {{ $tindakan->firstItem() ?? 0 }}–{{ $tindakan->lastItem() ?? 0 }} dari {{ $tindakan->total() }}
        </p>
    </div>

    @if ($tindakan->isEmpty())
        <x-empty-state
            :title="filled($q) ? 'Tindakan tidak ditemukan' : 'Belum ada master tindakan'"
            :description="filled($q)
                ? 'Coba kata kunci lain atau tampilkan seluruh tindakan.'
                : 'Tambahkan tindakan pertama agar rencana restorasi koleksi dapat disusun.'"
            icon="wrench"
        >
            <x-slot name="actions">
                @if (filled($q))
                    <x-button href="{{ route('tindakan.index') }}" variant="secondary">Tampilkan semua</x-button>
                @endif
                <x-button href="{{ route('tindakan.create') }}" icon="plus">Tambah tindakan</x-button>
            </x-slot>
        </x-empty-state>
    @else
        <div class="grid gap-3 md:grid-cols-2">
            @foreach ($tindakan as $item)
                <article class="group flex flex-col rounded-[6px] border-2 border-ink/20 bg-paper-light p-5 transition hover:border-ink hover:shadow-hard-sm">
                    <div class="flex items-start gap-3.5">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-[4px] border-2 border-ink/20 bg-cream text-ink-soft">
                            <x-icon name="wrench" class="h-5 w-5" />
                        </span>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-start justify-between gap-2">
                                <h2 class="text-base font-semibold leading-snug text-ink">{{ $item->nama_tindakan }}</h2>
                                <span class="inline-flex items-center gap-1 rounded-[3px] border border-ink/15 bg-paper px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-soft">
                                    {{ $item->koleksi_pita_count }} koleksi
                                </span>
                            </div>
                            <p class="mt-2 line-clamp-3 text-xs leading-relaxed text-ink-soft">
                                {{ $item->deskripsi ?: 'Belum ada deskripsi tindakan.' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between gap-3 border-t border-ink/10 pt-3">
                        <a href="{{ route('koleksi.index') }}" class="inline-flex items-center gap-1.5 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-faint transition hover:text-rust">
                            <x-icon name="cassette-tape" class="h-3.5 w-3.5" />
                            Lihat koleksi
                        </a>

                        <div class="flex items-center gap-1.5">
                            <a
                                href="{{ route('tindakan.edit', $item) }}"
                                class="inline-flex h-11 items-center gap-1.5 rounded-[3px] border border-ink/15 px-2.5 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-soft transition hover:border-ink hover:bg-cream hover:text-ink sm:h-9"
                                aria-label="Sunting tindakan {{ $item->nama_tindakan }}"
                            >
                                <x-icon name="pencil-simple" class="h-3.5 w-3.5" />
                                Sunting
                            </a>
                            <form method="POST" action="{{ route('tindakan.destroy', $item) }}" data-confirm="Tindakan {{ $item->nama_tindakan }} akan dihapus. Tindakan yang masih terpasang pada koleksi akan ditolak oleh sistem." data-confirm-title="Hapus tindakan {{ $item->nama_tindakan }}?">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex h-11 w-11 sm:h-9 sm:w-9 items-center justify-center rounded-[3px] border border-rust/25 text-rust transition hover:border-rust hover:bg-rust-light"
                                    aria-label="Hapus tindakan {{ $item->nama_tindakan }}"
                                >
                                    <x-icon name="trash" class="h-4 w-4" />
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{ $tindakan->links('vendor.pagination.ledger') }}
    @endif
@endsection
