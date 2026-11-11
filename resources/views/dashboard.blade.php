@extends('layouts.app')

@section('title', 'Ruang Kerja')

@section('content')
    @php
        $totalKoleksi = $statistik['koleksi'];
        $ringan = (int) ($kondisi['ringan'] ?? 0);
        $sedang = (int) ($kondisi['sedang'] ?? 0);
        $berat = (int) ($kondisi['berat'] ?? 0);
        $rencana = (int) ($statusTindakan['rencana'] ?? 0);
        $proses = (int) ($statusTindakan['proses'] ?? 0);
        $selesai = (int) ($statusTindakan['selesai'] ?? 0);
    @endphp

    <section class="mb-8 grid items-stretch gap-6 lg:grid-cols-[1.45fr_1fr]">
        <div class="flex min-w-0 flex-col justify-between">
            <div>
                <p class="mb-3 flex items-center gap-2 font-mono text-[10px] font-semibold uppercase tracking-[0.2em] text-ink-faint">
                    <span class="inline-block h-1.5 w-1.5 bg-rust" aria-hidden="true"></span>
                    Lembar kerja · {{ now()->locale('id')->translatedFormat('j F Y') }}
                </p>

                <h1 class="text-balance text-4xl leading-[1.03] text-ink sm:text-5xl lg:text-[3.65rem]">
                    Setiap pita punya usia yang perlu dijaga.
                </h1>

                <p class="mt-4 max-w-[52ch] text-sm leading-relaxed text-ink-soft sm:text-base">
                    Catat kondisi awal, susun tindakan restorasi, dan lacak koleksi yang paling rapuh sebelum suaranya hilang.
                </p>
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-2.5">
                <x-button href="{{ route('koleksi.create') }}" icon="plus">Catat koleksi</x-button>
                <x-button href="{{ route('koleksi.index', ['status' => 'proses']) }}" variant="secondary" icon="sliders-horizontal">
                    Lihat antrean
                </x-button>
            </div>
        </div>

        <div class="relative min-w-0 overflow-hidden rounded-[6px] border-2 border-ink bg-ink p-5 text-cream shadow-hard">
            <div class="label-notch absolute -right-6 -top-6 h-24 w-24 rotate-12 border-2 border-tan/30 bg-tan/10" aria-hidden="true"></div>

            <div class="flex items-center justify-between gap-3">
                <p class="font-mono text-[9px] uppercase tracking-[0.2em] text-paper/65">Pita Lestari / Rekapitulasi</p>
                <span class="stamp px-2 py-1 font-mono text-[8px] uppercase tracking-[0.14em] text-tan">{{ $berat }} berat</span>
            </div>

            <div class="mt-5 flex items-end justify-between gap-4">
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-paper/65">Tindakan selesai</p>
                    <p class="mt-1 font-display text-6xl leading-none text-cream">{{ $persentaseSelesai }}<span class="text-2xl text-tan">%</span></p>
                </div>
                <p class="max-w-[14ch] text-right text-xs leading-relaxed text-paper/55">
                    dari {{ $totalPivot }} penugasan restorasi
                </p>
            </div>

            <div class="mt-4 h-2.5 overflow-hidden rounded-[2px] border border-paper/20 bg-paper/10" role="img" aria-label="Progres restorasi {{ $persentaseSelesai }} persen">
                <div class="h-full bg-tan" style="width: {{ $persentaseSelesai }}%"></div>
            </div>

            <div class="mt-5 grid grid-cols-3 gap-2 border-t border-paper/15 pt-4">
                <div>
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-paper/65">Rencana</p>
                    <p class="mt-1 font-mono text-lg font-medium text-paper/90">{{ $rencana }}</p>
                </div>
                <div class="border-l border-paper/10 pl-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-paper/65">Proses</p>
                    <p class="mt-1 font-mono text-lg font-medium text-tan">{{ $proses }}</p>
                </div>
                <div class="border-l border-paper/10 pl-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-paper/65">Selesai</p>
                    <p class="mt-1 font-mono text-lg font-medium text-sage">{{ $selesai }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-5" aria-label="Ringkasan koleksi">
        <div class="rounded-[6px] border-2 border-ink bg-ink p-5 text-paper-light shadow-hard sm:col-span-2">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="font-mono text-[9px] uppercase tracking-[0.18em] text-paper/65">Total koleksi</p>
                    <p class="mt-2 font-display text-5xl leading-none">{{ $totalKoleksi }}</p>
                </div>
                <span class="flex h-10 w-10 items-center justify-center rounded-[3px] border border-paper/20 text-tan">
                    <x-icon name="cassette-tape" class="h-5 w-5" />
                </span>
            </div>

            <div class="mt-5 grid grid-cols-3 gap-2">
                <div>
                    <p class="font-mono text-[8px] uppercase tracking-[0.14em] text-paper/65">Ringan</p>
                    <p class="mt-1 font-mono text-sm text-sage">{{ $ringan }}</p>
                </div>
                <div class="border-l border-paper/10 pl-3">
                    <p class="font-mono text-[8px] uppercase tracking-[0.14em] text-paper/65">Sedang</p>
                    <p class="mt-1 font-mono text-sm text-tan">{{ $sedang }}</p>
                </div>
                <div class="border-l border-paper/10 pl-3">
                    <p class="font-mono text-[8px] uppercase tracking-[0.14em] text-paper/65">Berat</p>
                    <p class="mt-1 font-mono text-sm text-[#e4a58e]">{{ $berat }}</p>
                </div>
            </div>

            <div class="mt-4 flex h-2 overflow-hidden rounded-[2px] border border-paper/10" aria-hidden="true">
                @php $basis = max(1, $totalKoleksi); @endphp
                <span class="h-full bg-sage" style="width: {{ ($ringan / $basis) * 100 }}%"></span>
                <span class="h-full bg-tan" style="width: {{ ($sedang / $basis) * 100 }}%"></span>
                <span class="h-full bg-[#c46a4c]" style="width: {{ ($berat / $basis) * 100 }}%"></span>
            </div>
        </div>

        <a href="{{ route('kategori.index') }}" class="group rounded-[6px] border-2 border-ink/20 bg-paper-light p-5 transition hover:border-ink hover:shadow-hard-sm">
            <div class="flex items-start justify-between">
                <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-ink-faint">Kategori format</p>
                <x-icon name="tag" class="h-4 w-4 text-ink-faint transition group-hover:text-rust" />
            </div>
            <p class="mt-4 font-display text-4xl leading-none">{{ $statistik['kategori'] }}</p>
            <p class="mt-3 text-xs leading-relaxed text-ink-soft">Format media yang terdaftar di rak arsip.</p>
        </a>

        <a href="{{ route('tindakan.index') }}" class="group rounded-[6px] border-2 border-ink/20 bg-sage-light p-5 transition hover:border-ink hover:shadow-hard-sm">
            <div class="flex items-start justify-between">
                <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-ink-soft">Master tindakan</p>
                <x-icon name="wrench" class="h-4 w-4 text-ink-soft transition group-hover:text-rust" />
            </div>
            <p class="mt-4 font-display text-4xl leading-none">{{ $statistik['tindakan'] }}</p>
            <p class="mt-3 text-xs leading-relaxed text-ink-soft">{{ $totalPivot }} penugasan tersebar pada koleksi.</p>
        </a>

        <a href="{{ route('koleksi.index', ['tingkat' => 'berat']) }}" class="group relative overflow-hidden rounded-[6px] border-2 border-rust/50 bg-rust-light p-5 transition hover:border-rust hover:shadow-hard-sm">
            <div class="flex items-start justify-between">
                <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-rust">Perlu perhatian</p>
                <x-icon name="warning" class="h-4 w-4 text-rust" />
            </div>
            <p class="mt-4 font-display text-4xl leading-none text-rust">{{ $statistik['berat'] }}</p>
            <p class="mt-3 text-xs leading-relaxed text-rust/90">Koleksi dengan kerusakan berat.</p>
        </a>
    </section>

    @if ($totalKoleksi === 0)
        <x-empty-state
            title="Rak arsip masih kosong"
            description="Mulai dengan mencatat koleksi pertama. Detail kondisi dan tindakan restorasi dapat diisi pada formulir yang sama."
            icon="cassette-tape"
            class="mb-8"
        >
            <x-slot name="actions">
                <x-button href="{{ route('koleksi.create') }}" icon="plus">Catat koleksi pertama</x-button>
            </x-slot>
        </x-empty-state>
    @endif

    <div class="mb-8 grid gap-6 xl:grid-cols-[1.15fr_1fr]">
        <section class="min-w-0 rounded-[6px] border-2 border-ink/20 bg-paper-light" aria-labelledby="antrean-heading">
            <div class="flex items-center justify-between gap-4 border-b-2 border-ink/10 px-5 py-4">
                <div>
                    <h2 id="antrean-heading" class="text-xl">Sedang dikerjakan</h2>
                    <p class="mt-1 text-xs text-ink-soft">Koleksi dengan tindakan berstatus proses.</p>
                </div>
                <x-button href="{{ route('koleksi.index', ['status' => 'proses']) }}" variant="ghost" size="sm">Semua</x-button>
            </div>

            @if ($antreanProses->isEmpty())
                <div class="px-5 py-10 text-center">
                    <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-ink-faint">Belum ada proses berjalan</p>
                    <p class="mx-auto mt-2 max-w-sm text-sm text-ink-soft">Tandai tindakan sebagai proses pada lembar koleksi untuk memunculkannya di sini.</p>
                </div>
            @else
                <ul class="divide-y divide-ink/10">
                    @foreach ($antreanProses as $item)
                        @php
                            $tindakanAktif = $item->tindakanRestorasi->firstWhere('pivot.status', 'proses');
                        @endphp
                        <li>
                            <a href="{{ route('koleksi.show', $item) }}" class="group flex items-start gap-3 px-5 py-4 transition hover:bg-cream/60">
                                <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 border-ink/30 font-mono text-[9px] text-ink-soft">
                                    {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="flex flex-wrap items-center gap-2">
                                        <span class="font-mono text-[10px] font-semibold uppercase tracking-[0.1em] text-ink-faint">{{ $item->kode_koleksi }}</span>
                                        <x-status-badge status="proses" />
                                    </span>
                                    <span class="mt-1 block truncate text-sm font-medium text-ink group-hover:text-rust">{{ $item->nama_koleksi }}</span>
                                    <span class="mt-1 block text-xs text-ink-soft">
                                        {{ $tindakanAktif?->nama_tindakan ?? 'Tindakan restorasi' }}
                                        @if ($tindakanAktif?->pivot?->tanggal_mulai)
                                            · mulai {{ \Illuminate\Support\Carbon::parse($tindakanAktif->pivot->tanggal_mulai)->locale('id')->translatedFormat('j M Y') }}
                                        @endif
                                    </span>
                                </span>
                                <x-icon name="arrow-up-right" class="mt-1 h-4 w-4 shrink-0 text-ink-faint transition group-hover:text-rust" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        <section class="min-w-0 rounded-[6px] border-2 border-rust/30 bg-rust-light/60" aria-labelledby="prioritas-heading">
            <div class="flex items-center justify-between gap-4 border-b-2 border-rust/20 px-5 py-4">
                <div>
                    <h2 id="prioritas-heading" class="text-xl text-rust">Prioritas berat</h2>
                    <p class="mt-1 text-xs text-rust/80">Perlu penanganan lebih dahulu.</p>
                </div>
                <x-button href="{{ route('koleksi.index', ['tingkat' => 'berat']) }}" variant="ghost" size="sm" class="text-rust hover:bg-rust/10">Semua</x-button>
            </div>

            @if ($prioritasBerat->isEmpty())
                <div class="px-5 py-10 text-center">
                    <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-rust/70">Tidak ada kerusakan berat</p>
                    <p class="mx-auto mt-2 max-w-sm text-sm text-ink-soft">Semua koleksi tercatat pada tingkat ringan atau sedang.</p>
                </div>
            @else
                <ul class="divide-y divide-rust/15">
                    @foreach ($prioritasBerat as $item)
                        <li>
                            <a href="{{ route('koleksi.show', $item) }}" class="group flex items-center gap-3 px-5 py-4 transition hover:bg-rust/10">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-[3px] border-2 border-rust/40 bg-paper-light text-rust">
                                    <x-icon name="warning" class="h-4 w-4" />
                                </span>
                                <span class="min-w-0 flex-1">
                                    <span class="block truncate text-sm font-medium text-ink group-hover:text-rust">{{ $item->nama_koleksi }}</span>
                                    <span class="mt-1 block font-mono text-[10px] uppercase tracking-[0.1em] text-ink-soft">
                                        {{ $item->kode_koleksi }} · {{ $item->kategoriFormat?->nama_format }}
                                    </span>
                                </span>
                                <x-status-badge status="berat" type="kerusakan" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>

    <div class="grid gap-6 xl:grid-cols-[1.55fr_1fr]">
        <section class="min-w-0 overflow-hidden rounded-[6px] border-2 border-ink/20 bg-paper-light" aria-labelledby="terbaru-heading">
            <div class="flex items-center justify-between gap-4 border-b-2 border-ink/10 px-5 py-4">
                <div>
                    <h2 id="terbaru-heading" class="text-xl">Koleksi terbaru</h2>
                    <p class="mt-1 text-xs text-ink-soft">Enam catatan terakhir yang masuk ke rak.</p>
                </div>
                <x-button href="{{ route('koleksi.index') }}" variant="secondary" size="sm">Lihat semua</x-button>
            </div>

            @if ($koleksiTerbaru->isEmpty())
                <div class="px-5 py-10 text-center text-sm text-ink-soft">Belum ada koleksi yang dicatat.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[34rem] text-left text-sm">
                        <thead>
                            <tr class="border-b border-ink/10 bg-paper/60 font-mono text-[9px] uppercase tracking-[0.13em] text-ink-faint">
                                <th scope="col" class="px-5 py-2.5 font-medium">Kode</th>
                                <th scope="col" class="px-3 py-2.5 font-medium">Koleksi</th>
                                <th scope="col" class="hidden px-3 py-2.5 font-medium md:table-cell">Kondisi</th>
                                <th scope="col" class="px-5 py-2.5 text-right font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-ink/10">
                            @foreach ($koleksiTerbaru as $item)
                                <tr class="transition hover:bg-cream/50">
                                    <td class="whitespace-nowrap px-5 py-3 font-mono text-[10px] font-semibold uppercase tracking-[0.08em] text-ink-soft">
                                        {{ $item->kode_koleksi }}
                                    </td>
                                    <td class="px-3 py-3">
                                        <a href="{{ route('koleksi.show', $item) }}" class="font-medium text-ink hover:text-rust">{{ $item->nama_koleksi }}</a>
                                        <p class="mt-0.5 text-xs text-ink-faint">{{ $item->kategoriFormat?->nama_format }} · {{ $item->labelTahun() }}</p>
                                    </td>
                                    <td class="hidden px-3 py-3 md:table-cell">
                                        <x-status-badge :status="$item->detailKondisi?->tingkat_kerusakan ?? 'ringan'" type="kerusakan" />
                                    </td>
                                    <td class="px-5 py-3 text-right">
                                        <a href="{{ route('koleksi.show', $item) }}" class="inline-flex h-11 w-11 items-center justify-center rounded-[3px] text-ink-soft transition hover:bg-ink hover:text-paper" aria-label="Buka {{ $item->kode_koleksi }}">
                                            <x-icon name="arrow-right" class="h-4 w-4" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <section class="min-w-0 rounded-[6px] border-2 border-ink/20 bg-paper-light p-5" aria-labelledby="distribusi-heading">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 id="distribusi-heading" class="text-xl">Sebaran format</h2>
                    <p class="mt-1 text-xs text-ink-soft">Enam format dengan koleksi terbanyak.</p>
                </div>
                <x-icon name="vinyl-record" class="h-5 w-5 text-ink-faint" />
            </div>

            <div class="mt-6 space-y-4">
                @forelse ($distribusi as $item)
                    <div>
                        <div class="flex items-baseline justify-between gap-3">
                            <p class="text-sm text-ink">{{ $item->nama_format }}</p>
                            <p class="font-mono text-[10px] text-ink-faint">{{ $item->koleksi_pita_count }}</p>
                        </div>
                        <div class="mt-1.5 h-2 overflow-hidden rounded-[1px] border border-ink/20 bg-paper">
                            <div class="h-full bg-tan" style="width: {{ max(4, round(($item->koleksi_pita_count / $maksDistribusi) * 100)) }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-ink-soft">Belum ada kategori format yang terdaftar.</p>
                @endforelse
            </div>

            <x-button href="{{ route('kategori.index') }}" variant="ghost" size="sm" class="mt-5 -ml-2">Kelola kategori</x-button>
        </section>
    </div>
@endsection
