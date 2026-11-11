@extends('layouts.app')

@section('title', 'Koleksi Pita')

@section('content')
    <x-page-header
        eyebrow="Rak arsip · {{ $koleksi->total() }} catatan"
        title="Koleksi pita"
        description="Telusuri koleksi berdasarkan kode, nama, format, tingkat kerusakan, atau status tindakan restorasi."
    >
        <x-slot name="actions">
            <x-button href="{{ route('tindakan.index') }}" variant="secondary" icon="wrench">Master tindakan</x-button>
            <x-button href="{{ route('koleksi.create') }}" icon="plus">Catat koleksi</x-button>
        </x-slot>
    </x-page-header>

    <section class="mb-6 rounded-[6px] border-2 border-ink/20 bg-paper-light" aria-labelledby="filter-heading">
        <div class="flex items-center gap-2 border-b-2 border-ink/10 px-4 py-3 sm:px-5">
            <x-icon name="funnel" class="h-4 w-4 text-ink-soft" />
            <h2 id="filter-heading" class="font-mono text-[10px] font-semibold uppercase tracking-[0.16em] text-ink-soft">Lembar sortir</h2>
        </div>

        <form action="{{ route('koleksi.index') }}" method="GET" class="grid gap-4 p-4 sm:p-5 md:grid-cols-2 xl:grid-cols-[1.4fr_1fr_1fr_1fr_auto]">
            <x-input
                name="q"
                label="Kata kunci"
                type="search"
                value="{{ $filter['q'] }}"
                placeholder="Kode atau nama koleksi"
            />

            <x-select
                name="kategori"
                label="Kategori format"
                :options="$kategori->pluck('nama_format', 'id')->all()"
                :value="$filter['kategori']"
                placeholder="Semua format"
            />

            <x-select
                name="tingkat"
                label="Tingkat kerusakan"
                :options="$tingkatOptions"
                :value="$filter['tingkat']"
                placeholder="Semua tingkat"
            />

            <x-select
                name="status"
                label="Status tindakan"
                :options="$statusOptions"
                :value="$filter['status']"
                placeholder="Semua status"
            />

            <div class="flex items-end gap-2 self-end">
                <x-button type="submit" icon="magnifying-glass">Terapkan</x-button>
                @if ($adaFilter)
                    <x-button href="{{ route('koleksi.index') }}" variant="ghost" size="md">Reset</x-button>
                @endif
            </div>
        </form>

        @if ($adaFilter)
            <div class="flex flex-wrap items-center gap-2 border-t border-dashed border-ink/15 px-4 py-3 sm:px-5">
                <span class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Filter aktif</span>

                @if (filled($filter['q']))
                    <a href="{{ route('koleksi.index', array_filter(array_merge($filter, ['q' => null]), fn ($nilai) => filled($nilai))) }}" class="inline-flex items-center gap-1.5 rounded-[3px] border border-ink/25 bg-cream px-2 py-1 font-mono text-[10px] text-ink transition hover:border-ink">
                        "{{ $filter['q'] }}"
                        <x-icon name="x" class="h-3 w-3" />
                    </a>
                @endif

                @if (filled($filter['kategori']))
                    <a href="{{ route('koleksi.index', array_filter(array_merge($filter, ['kategori' => null]), fn ($nilai) => filled($nilai))) }}" class="inline-flex items-center gap-1.5 rounded-[3px] border border-ink/25 bg-cream px-2 py-1 font-mono text-[10px] text-ink transition hover:border-ink">
                        {{ $kategori->firstWhere('id', (int) $filter['kategori'])?->nama_format ?? 'Kategori' }}
                        <x-icon name="x" class="h-3 w-3" />
                    </a>
                @endif

                @if (filled($filter['tingkat']))
                    <a href="{{ route('koleksi.index', array_filter(array_merge($filter, ['tingkat' => null]), fn ($nilai) => filled($nilai))) }}" class="inline-flex items-center gap-1.5 rounded-[3px] border border-ink/25 bg-cream px-2 py-1 font-mono text-[10px] text-ink transition hover:border-ink">
                        {{ $tingkatOptions[$filter['tingkat']] ?? $filter['tingkat'] }}
                        <x-icon name="x" class="h-3 w-3" />
                    </a>
                @endif

                @if (filled($filter['status']))
                    <a href="{{ route('koleksi.index', array_filter(array_merge($filter, ['status' => null]), fn ($nilai) => filled($nilai))) }}" class="inline-flex items-center gap-1.5 rounded-[3px] border border-ink/25 bg-cream px-2 py-1 font-mono text-[10px] text-ink transition hover:border-ink">
                        {{ $statusOptions[$filter['status']] ?? $filter['status'] }}
                        <x-icon name="x" class="h-3 w-3" />
                    </a>
                @endif
            </div>
        @endif
    </section>

    @if ($koleksi->isEmpty())
        <x-empty-state
            :title="$adaFilter ? 'Tidak ada koleksi yang cocok' : 'Rak arsip masih kosong'"
            :description="$adaFilter
                ? 'Coba kata kunci yang lebih pendek atau hapus salah satu filter untuk melihat hasil lain.'
                : 'Mulai dengan mencatat koleksi pertama. Detail kondisi dan rencana restorasi dapat diisi sekaligus.'"
            icon="magnifying-glass"
        >
            <x-slot name="actions">
                @if ($adaFilter)
                    <x-button href="{{ route('koleksi.index') }}" variant="secondary" icon="funnel">Hapus filter</x-button>
                @endif
                <x-button href="{{ route('koleksi.create') }}" icon="plus">Catat koleksi</x-button>
            </x-slot>
        </x-empty-state>
    @else
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <p class="font-mono text-[10px] uppercase tracking-[0.12em] text-ink-faint">
                {{ $koleksi->firstItem() }}–{{ $koleksi->lastItem() }} dari {{ $koleksi->total() }} koleksi
            </p>
            <p class="font-mono text-[10px] uppercase tracking-[0.12em] text-ink-faint">Urutan: terbaru</p>
        </div>

        <div class="grid gap-4 md:grid-cols-2 2xl:grid-cols-3">
            @foreach ($koleksi as $item)
                @php
                    $total = max(1, $item->total_tindakan);
                @endphp
                <article class="group flex flex-col rounded-[6px] border-2 border-ink/20 bg-paper-light transition hover:border-ink hover:shadow-hard">
                    <div class="flex items-center justify-between gap-3 border-b border-ink/10 px-4 py-2.5">
                        <span class="font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-ink-soft">{{ $item->kode_koleksi }}</span>
                        <x-status-badge :status="$item->detailKondisi?->tingkat_kerusakan ?? 'ringan'" type="kerusakan" />
                    </div>

                    <div class="flex flex-1 flex-col p-4">
                        <p class="font-mono text-[9px] uppercase tracking-[0.13em] text-ink-faint">
                            {{ $item->kategoriFormat?->nama_format }} · {{ $item->labelTahun() }}
                        </p>

                        <h2 class="mt-2 text-lg leading-snug text-ink">
                            <a href="{{ route('koleksi.show', $item) }}" class="transition group-hover:text-rust">{{ $item->nama_koleksi }}</a>
                        </h2>

                        <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-ink-soft">
                            {{ \Illuminate\Support\Str::limit($item->deskripsi ?: 'Belum ada deskripsi koleksi.', 130) }}
                        </p>

                        <div class="mt-auto pt-4">
                            <div class="flex items-center justify-between gap-3">
                                <span class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Tindakan</span>
                                <span class="font-mono text-[10px] text-ink-soft">{{ $item->total_selesai }}/{{ $item->total_tindakan }} selesai</span>
                            </div>

                            @if ($item->total_tindakan > 0)
                                <div class="mt-1.5 flex h-2 overflow-hidden rounded-[1px] border border-ink/15 bg-paper" role="img" aria-label="{{ $item->total_selesai }} dari {{ $item->total_tindakan }} tindakan selesai">
                                    <span class="h-full bg-sage" style="width: {{ ($item->total_selesai / $total) * 100 }}%"></span>
                                    <span class="h-full bg-tan" style="width: {{ ($item->total_proses / $total) * 100 }}%"></span>
                                    <span class="h-full bg-paper-dark" style="width: {{ ($item->total_rencana / $total) * 100 }}%"></span>
                                </div>
                            @else
                                <p class="mt-1.5 text-[11px] text-ink-faint">Belum ada tindakan yang dipilih.</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 border-t border-ink/10 px-4 py-3">
                        <span class="inline-flex items-center gap-1.5 text-[11px] text-ink-faint">
                            <x-icon name="calendar-blank" class="h-3.5 w-3.5" />
                            {{ $item->created_at?->locale('id')->translatedFormat('j M Y') }}
                        </span>
                        <x-button href="{{ route('koleksi.show', $item) }}" variant="ghost" size="sm" iconAfter="arrow-up-right">
                            Buka lembar
                        </x-button>
                    </div>
                </article>
            @endforeach
        </div>

        {{ $koleksi->links('vendor.pagination.ledger') }}
    @endif
@endsection
