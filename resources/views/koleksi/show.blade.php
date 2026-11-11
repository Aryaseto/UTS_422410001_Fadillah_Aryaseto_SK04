@extends('layouts.app')

@section('title', $koleksi->kode_koleksi)

@section('content')
    @php
        $total = $daftarTindakan->count();
        $selesai = $daftarTindakan->where('pivot.status', 'selesai')->count();
        $proses = $daftarTindakan->where('pivot.status', 'proses')->count();
        $rencana = $daftarTindakan->where('pivot.status', 'rencana')->count();
        $persentase = $total > 0 ? (int) round(($selesai / $total) * 100) : 0;
        $kondisi = $koleksi->detailKondisi;
    @endphp

    <div class="mb-5">
        <a href="{{ route('koleksi.index') }}" class="inline-flex items-center gap-1.5 font-mono text-[10px] font-medium uppercase tracking-[0.12em] text-ink-soft transition hover:text-rust">
            <x-icon name="arrow-left" class="h-3.5 w-3.5" />
            Kembali ke rak koleksi
        </a>
    </div>

    <header class="mb-8 grid gap-6 border-b-2 border-ink/15 pb-6 lg:grid-cols-[1fr_auto] lg:items-end">
        <div class="min-w-0">
            <div class="flex flex-wrap items-center gap-2.5">
                <button
                    type="button"
                    data-copy="{{ $koleksi->kode_koleksi }}"
                    class="group inline-flex min-h-11 items-center gap-2 rounded-[3px] border-2 border-ink/25 bg-cream px-2.5 py-2 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-ink transition hover:border-ink"
                    aria-label="Salin kode koleksi {{ $koleksi->kode_koleksi }}"
                >
                    <x-icon name="hash" class="h-3.5 w-3.5 text-ink-faint" />
                    <span data-copy-label>{{ $koleksi->kode_koleksi }}</span>
                </button>

                @if ($kondisi)
                    <x-status-badge :status="$kondisi->tingkat_kerusakan" type="kerusakan" />
                @endif

                <x-status-badge :status="$koleksi->statusDominan()" />
            </div>

            <h1 class="mt-3 text-balance text-3xl leading-[1.08] text-ink sm:text-4xl lg:text-[2.8rem]">{{ $koleksi->nama_koleksi }}</h1>

            <p class="mt-3 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-ink-soft">
                <span>{{ $koleksi->kategoriFormat?->nama_format }}</span>
                <span class="text-ink-faint" aria-hidden="true">·</span>
                <span>{{ $koleksi->labelTahun() }}</span>
                <span class="text-ink-faint" aria-hidden="true">·</span>
                <span>Dicatat {{ $koleksi->created_at?->locale('id')->translatedFormat('j F Y') }}</span>
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <x-button href="{{ route('koleksi.edit', $koleksi) }}" variant="secondary" icon="pencil-simple">Sunting data</x-button>
            <form method="POST" action="{{ route('koleksi.destroy', $koleksi) }}" data-confirm="Koleksi {{ $koleksi->kode_koleksi }} beserta detail kondisi dan seluruh tindakan restorasinya akan dihapus permanen." data-confirm-title="Hapus koleksi {{ $koleksi->kode_koleksi }}?">
                @csrf
                @method('DELETE')
                <x-button type="submit" variant="danger" icon="trash">Hapus</x-button>
            </form>
        </div>
    </header>

    <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
        <div class="space-y-6">
            <section class="rounded-[6px] border-2 border-ink/20 bg-paper-light p-5 sm:p-6" aria-labelledby="deskripsi-heading">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="font-mono text-[9px] font-semibold uppercase tracking-[0.18em] text-ink-faint">Catatan koleksi</p>
                        <h2 id="deskripsi-heading" class="mt-1 text-xl">Deskripsi</h2>
                    </div>
                    <x-icon name="note" class="h-5 w-5 text-ink-faint" />
                </div>

                <p class="mt-4 max-w-[72ch] whitespace-pre-line text-sm leading-relaxed text-ink-soft">
                    {{ $koleksi->deskripsi ?: 'Belum ada deskripsi yang dicatat untuk koleksi ini.' }}
                </p>
            </section>

            <section class="relative overflow-hidden rounded-[6px] border-2 border-ink/20 bg-cream/60" aria-labelledby="kondisi-heading">
                <div class="ledger-lines pointer-events-none absolute inset-0 opacity-60" aria-hidden="true"></div>

                <div class="relative flex flex-wrap items-start justify-between gap-4 border-b-2 border-ink/10 px-5 py-4 sm:px-6">
                    <div>
                        <p class="font-mono text-[9px] font-semibold uppercase tracking-[0.18em] text-ink-faint">Lembar inspeksi</p>
                        <h2 id="kondisi-heading" class="mt-1 text-xl">Kondisi awal</h2>
                    </div>

                    <div class="flex items-center gap-3">
                        @if ($kondisi)
                            <x-status-badge :status="$kondisi->tingkat_kerusakan" type="kerusakan" />
                        @endif
                        <span class="stamp inline-block px-2 py-1 font-mono text-[8px] font-semibold uppercase tracking-[0.14em] text-ink-soft">Pra-restorasi</span>
                    </div>
                </div>

                <div class="relative px-5 py-5 sm:px-6">
                    @if ($kondisi)
                        <div class="border-l-2 border-ink/20 pl-4">
                            <p class="whitespace-pre-line text-sm leading-relaxed text-ink">{{ $kondisi->kondisi_awal }}</p>
                        </div>

                        <div class="mt-5 grid gap-4 border-t border-dashed border-ink/20 pt-4 sm:grid-cols-2">
                            <div>
                                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Catatan pemeriksa</p>
                                <p class="mt-1.5 text-sm leading-relaxed text-ink-soft">{{ $kondisi->catatan ?: 'Tidak ada catatan tambahan.' }}</p>
                            </div>
                            <div>
                                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Diperbarui</p>
                                <p class="mt-1.5 text-sm text-ink-soft">{{ $kondisi->updated_at?->locale('id')->translatedFormat('j F Y, H.i') }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-ink-soft">Detail kondisi belum dicatat. Sunting koleksi untuk menambahkan kondisi awal.</p>
                    @endif
                </div>
            </section>

            <section class="rounded-[6px] border-2 border-ink/20 bg-paper-light" aria-labelledby="tindakan-heading">
                <div class="flex flex-wrap items-center justify-between gap-4 border-b-2 border-ink/10 px-5 py-4 sm:px-6">
                    <div>
                        <p class="font-mono text-[9px] font-semibold uppercase tracking-[0.18em] text-ink-faint">Rencana kerja</p>
                        <h2 id="tindakan-heading" class="mt-1 text-xl">Tindakan restorasi</h2>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-mono text-[10px] uppercase tracking-[0.1em] text-ink-faint">{{ $total }} tindakan</span>
                        <x-button href="{{ route('koleksi.edit', $koleksi) }}" variant="ghost" size="sm" icon="pencil-simple">Atur</x-button>
                    </div>
                </div>

                @if ($daftarTindakan->isEmpty())
                    <div class="px-5 py-10 text-center sm:px-6">
                        <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-ink-faint">Belum ada tindakan</p>
                        <p class="mx-auto mt-2 max-w-md text-sm text-ink-soft">Pilih tindakan restorasi pada formulir sunting agar rencana kerja koleksi ini tercatat.</p>
                        <x-button href="{{ route('koleksi.edit', $koleksi) }}" variant="secondary" size="sm" icon="plus" class="mt-4">Pilih tindakan</x-button>
                    </div>
                @else
                    <ol class="divide-y divide-ink/10">
                        @foreach ($daftarTindakan as $tindakan)
                            <li class="relative px-5 py-5 sm:px-6">
                                <div class="flex items-start gap-3.5">
                                    <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 border-ink/25 font-mono text-[10px] font-semibold text-ink-soft">
                                        {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center justify-between gap-2">
                                            <h3 class="text-base font-semibold text-ink">{{ $tindakan->nama_tindakan }}</h3>
                                            <x-status-badge :status="$tindakan->pivot->status" />
                                        </div>

                                        @if ($tindakan->deskripsi)
                                            <p class="mt-1 text-xs leading-relaxed text-ink-soft">{{ $tindakan->deskripsi }}</p>
                                        @endif

                                        <div class="mt-3 grid gap-2 text-xs text-ink-soft sm:grid-cols-2">
                                            <p class="flex items-center gap-1.5">
                                                <x-icon name="calendar-blank" class="h-3.5 w-3.5 shrink-0 text-ink-faint" />
                                                Mulai:
                                                <span class="font-medium text-ink">
                                                    {{ $tindakan->pivot->tanggal_mulai ? \Illuminate\Support\Carbon::parse($tindakan->pivot->tanggal_mulai)->locale('id')->translatedFormat('j M Y') : 'belum dijadwalkan' }}
                                                </span>
                                            </p>
                                            <p class="flex items-center gap-1.5">
                                                <x-icon name="check-circle" class="h-3.5 w-3.5 shrink-0 text-ink-faint" />
                                                Selesai:
                                                <span class="font-medium text-ink">
                                                    {{ $tindakan->pivot->tanggal_selesai ? \Illuminate\Support\Carbon::parse($tindakan->pivot->tanggal_selesai)->locale('id')->translatedFormat('j M Y') : 'belum selesai' }}
                                                </span>
                                            </p>
                                        </div>

                                        @if ($tindakan->pivot->catatan)
                                            <div class="mt-3 rounded-[3px] border border-ink/15 bg-paper px-3 py-2">
                                                <p class="font-mono text-[8px] uppercase tracking-[0.15em] text-ink-faint">Catatan tindakan</p>
                                                <p class="mt-1 text-xs leading-relaxed text-ink-soft">{{ $tindakan->pivot->catatan }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </section>
        </div>

        <aside class="space-y-6 xl:sticky xl:top-24 xl:self-start">
            <section class="rounded-[6px] border-2 border-ink bg-ink p-5 text-paper-light shadow-hard" aria-labelledby="ringkasan-heading">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="font-mono text-[9px] uppercase tracking-[0.18em] text-paper/65">Ringkasan restorasi</p>
                        <h2 id="ringkasan-heading" class="mt-1 text-xl text-cream">Progres lembar</h2>
                    </div>
                    <x-icon name="seal-check" class="h-5 w-5 text-tan" />
                </div>

                <div class="mt-5 flex items-end justify-between gap-4">
                    <p class="font-display text-5xl leading-none text-cream">{{ $persentase }}<span class="text-xl text-tan">%</span></p>
                    <p class="text-right text-xs leading-relaxed text-paper/55">{{ $selesai }} dari {{ $total }}<br>tindakan selesai</p>
                </div>

                <div class="mt-4 flex h-2.5 overflow-hidden rounded-[2px] border border-paper/20 bg-paper/10" role="img" aria-label="Progres restorasi {{ $persentase }} persen">
                    <span class="h-full bg-sage" style="width: {{ $total > 0 ? ($selesai / $total) * 100 : 0 }}%"></span>
                    <span class="h-full bg-tan" style="width: {{ $total > 0 ? ($proses / $total) * 100 : 0 }}%"></span>
                    <span class="h-full bg-paper/20" style="width: {{ $total > 0 ? ($rencana / $total) * 100 : 0 }}%"></span>
                </div>

                <dl class="mt-5 divide-y divide-paper/10 border-t border-paper/15">
                    <div class="flex items-center justify-between gap-3 py-2.5">
                        <dt class="font-mono text-[9px] uppercase tracking-[0.13em] text-paper/65">Format</dt>
                        <dd class="text-right text-xs text-paper/90">{{ $koleksi->kategoriFormat?->nama_format }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 py-2.5">
                        <dt class="font-mono text-[9px] uppercase tracking-[0.13em] text-paper/65">Tahun</dt>
                        <dd class="text-right text-xs text-paper/90">{{ $koleksi->labelTahun() }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 py-2.5">
                        <dt class="font-mono text-[9px] uppercase tracking-[0.13em] text-paper/65">Kerusakan</dt>
                        <dd class="text-right text-xs capitalize text-paper/90">{{ $kondisi?->tingkat_kerusakan ?? 'belum dicatat' }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3 py-2.5">
                        <dt class="font-mono text-[9px] uppercase tracking-[0.13em] text-paper/65">Proses</dt>
                        <dd class="text-right text-xs text-paper/90">{{ $proses }} tindakan</dd>
                    </div>
                </dl>
            </section>

            <section class="rounded-[6px] border-2 border-ink/20 bg-paper-light p-5" aria-labelledby="kelola-heading">
                <h2 id="kelola-heading" class="font-mono text-[10px] font-semibold uppercase tracking-[0.16em] text-ink-soft">Kelola lembar</h2>
                <p class="mt-2 text-xs leading-relaxed text-ink-soft">Perbarui identitas, kondisi awal, atau susunan tindakan restorasi pada satu formulir.</p>

                <div class="mt-4 flex flex-col gap-2">
                    <x-button href="{{ route('koleksi.edit', $koleksi) }}" variant="secondary" size="sm" icon="pencil-simple" class="w-full">Sunting koleksi</x-button>
                    <x-button href="{{ route('kategori.index') }}" variant="ghost" size="sm" icon="tag" class="w-full justify-start">Kelola kategori format</x-button>
                </div>
            </section>

            <section class="rounded-[6px] border-2 border-rust/35 bg-rust-light/60 p-5" aria-labelledby="hapus-heading">
                <h2 id="hapus-heading" class="font-mono text-[10px] font-semibold uppercase tracking-[0.16em] text-rust">Zona hapus</h2>
                <p class="mt-2 text-xs leading-relaxed text-rust/90">Menghapus koleksi juga menghapus detail kondisi dan seluruh pivot tindakan. Tindakan ini tidak dapat dibatalkan.</p>
                <form method="POST" action="{{ route('koleksi.destroy', $koleksi) }}" class="mt-4" data-confirm="Koleksi {{ $koleksi->kode_koleksi }} beserta detail kondisi dan seluruh tindakan restorasinya akan dihapus permanen." data-confirm-title="Hapus koleksi {{ $koleksi->kode_koleksi }}?">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger" size="sm" icon="trash" class="w-full">Hapus koleksi</x-button>
                </form>
            </section>
        </aside>
    </div>
@endsection
