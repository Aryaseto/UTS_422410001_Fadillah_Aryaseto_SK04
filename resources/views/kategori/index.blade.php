@extends('layouts.app')

@section('title', 'Kategori Format')

@section('content')
    <x-page-header
        eyebrow="Master data · {{ $kategori->total() }} format"
        title="Kategori format"
        description="Daftar format media yang menjadi rujukan koleksi. Kategori yang masih dipakai tidak dapat dihapus."
    >
        <x-slot name="actions">
            <x-button href="{{ route('kategori.create') }}" icon="plus">Tambah kategori</x-button>
        </x-slot>
    </x-page-header>

    <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form action="{{ route('kategori.index') }}" method="GET" role="search" class="flex w-full max-w-md gap-2">
            <div class="relative flex-1">
                <label for="kategori-search" class="sr-only">Cari kategori format</label>
                <x-icon name="magnifying-glass" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-faint" />
                <input
                    id="kategori-search"
                    type="search"
                    name="q"
                    value="{{ $q }}"
                    placeholder="Cari nama format"
                    class="h-11 w-full rounded-[4px] border-2 border-ink/20 bg-paper-light pl-9 pr-3 text-sm text-ink transition placeholder:text-ink-faint focus:border-ink focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rust"
                >
            </div>
            <x-button type="submit" variant="secondary">Cari</x-button>
            @if (filled($q))
                <x-button href="{{ route('kategori.index') }}" variant="ghost">Reset</x-button>
            @endif
        </form>

        <p class="font-mono text-[10px] uppercase tracking-[0.12em] text-ink-faint">
            {{ $kategori->firstItem() ?? 0 }}–{{ $kategori->lastItem() ?? 0 }} dari {{ $kategori->total() }}
        </p>
    </div>

    @if ($kategori->isEmpty())
        <x-empty-state
            :title="filled($q) ? 'Kategori tidak ditemukan' : 'Belum ada kategori format'"
            :description="filled($q)
                ? 'Coba kata kunci lain, atau tampilkan seluruh kategori.'
                : 'Tambahkan format media pertama agar koleksi dapat dikelompokkan dengan rapi.'"
            icon="tag"
        >
            <x-slot name="actions">
                @if (filled($q))
                    <x-button href="{{ route('kategori.index') }}" variant="secondary">Tampilkan semua</x-button>
                @endif
                <x-button href="{{ route('kategori.create') }}" icon="plus">Tambah kategori</x-button>
            </x-slot>
        </x-empty-state>
    @else
        <div class="overflow-hidden rounded-[6px] border-2 border-ink/20 bg-paper-light">
            <div class="hidden grid-cols-[3rem_1.2fr_2fr_7rem_8rem] gap-4 border-b-2 border-ink/10 bg-paper/60 px-5 py-2.5 font-mono text-[9px] uppercase tracking-[0.13em] text-ink-faint md:grid">
                <span>No.</span>
                <span>Nama format</span>
                <span>Deskripsi</span>
                <span>Koleksi</span>
                <span class="text-right">Aksi</span>
            </div>

            <div class="divide-y divide-ink/10">
                @foreach ($kategori as $item)
                    <article class="grid gap-3 px-4 py-4 transition hover:bg-cream/40 sm:px-5 md:grid-cols-[3rem_1.2fr_2fr_7rem_8rem] md:items-center md:gap-4">
                        <span class="hidden font-mono text-[10px] text-ink-faint md:block">
                            {{ str_pad((string) ($kategori->firstItem() + $loop->index), 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-[3px] border border-ink/20 bg-cream text-ink-soft md:hidden">
                                    <x-icon name="tag" class="h-3.5 w-3.5" />
                                </span>
                                <h2 class="truncate text-sm font-semibold text-ink">{{ $item->nama_format }}</h2>
                            </div>
                            <p class="mt-1 line-clamp-2 text-xs leading-relaxed text-ink-soft md:hidden">
                                {{ $item->deskripsi ?: 'Belum ada deskripsi.' }}
                            </p>
                        </div>

                        <p class="hidden line-clamp-2 text-xs leading-relaxed text-ink-soft md:block">
                            {{ $item->deskripsi ?: 'Belum ada deskripsi.' }}
                        </p>

                        <div>
                            <span class="inline-flex items-center gap-1.5 rounded-[3px] border border-ink/20 bg-paper px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-soft">
                                {{ $item->koleksi_pita_count }} koleksi
                            </span>
                        </div>

                        <div class="flex items-center gap-1.5 md:justify-end">
                            <a
                                href="{{ route('koleksi.index', ['kategori' => $item->id]) }}"
                                class="inline-flex h-11 w-11 sm:h-9 sm:w-9 items-center justify-center rounded-[3px] border border-ink/15 text-ink-soft transition hover:border-ink hover:bg-cream hover:text-ink"
                                aria-label="Lihat koleksi dengan format {{ $item->nama_format }}"
                            >
                                <x-icon name="cassette-tape" class="h-4 w-4" />
                            </a>
                            <a
                                href="{{ route('kategori.edit', $item) }}"
                                class="inline-flex h-11 w-11 sm:h-9 sm:w-9 items-center justify-center rounded-[3px] border border-ink/15 text-ink-soft transition hover:border-ink hover:bg-cream hover:text-ink"
                                aria-label="Sunting kategori {{ $item->nama_format }}"
                            >
                                <x-icon name="pencil-simple" class="h-4 w-4" />
                            </a>
                            <form method="POST" action="{{ route('kategori.destroy', $item) }}" data-confirm="Kategori {{ $item->nama_format }} akan dihapus. Kategori yang masih dipakai akan ditolak oleh sistem." data-confirm-title="Hapus kategori {{ $item->nama_format }}?">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex h-11 w-11 sm:h-9 sm:w-9 items-center justify-center rounded-[3px] border border-rust/25 text-rust transition hover:border-rust hover:bg-rust-light"
                                    aria-label="Hapus kategori {{ $item->nama_format }}"
                                >
                                    <x-icon name="trash" class="h-4 w-4" />
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        {{ $kategori->links('vendor.pagination.ledger') }}
    @endif
@endsection
