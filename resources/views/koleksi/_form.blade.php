@php
    $isEdit = $koleksi->exists;
    $tingkatOptions = \App\Models\KoleksiPita::TINGKAT_KERUSAKAN;
    $statusOptions = \App\Models\KoleksiPita::STATUS_TINDAKAN;
    $tersimpan = $isEdit ? $koleksi->tindakanRestorasi->keyBy('id') : collect();
    $detailLama = [
        'kondisi_awal' => $koleksi->detailKondisi?->kondisi_awal,
        'tingkat_kerusakan' => $koleksi->detailKondisi?->tingkat_kerusakan ?? 'ringan',
        'catatan' => $koleksi->detailKondisi?->catatan,
    ];
    $jumlahTerpilih = $tindakan->filter(function ($item) use ($tersimpan) {
        return (bool) old("tindakan.{$item->id}.dipilih", $tersimpan->has($item->id));
    })->count();
@endphp

<form
    method="POST"
    action="{{ $isEdit ? route('koleksi.update', $koleksi) : route('koleksi.store') }}"
    class="space-y-6"
>
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <section class="rounded-[6px] border-2 border-ink/20 bg-paper-light" aria-labelledby="bagian-identitas">
        <div class="flex items-start gap-4 border-b-2 border-ink/10 px-5 py-4 sm:px-6">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 border-ink/30 font-mono text-[10px] font-semibold">01</span>
            <div>
                <h2 id="bagian-identitas" class="text-xl">Identitas koleksi</h2>
                <p class="mt-1 text-xs text-ink-soft">Kode unik, nama, dan format media yang menjadi dasar pencarian.</p>
            </div>
        </div>

        <div class="grid gap-5 p-5 sm:p-6 md:grid-cols-2">
            <x-input
                name="kode_koleksi"
                label="Kode koleksi"
                :value="$koleksi->kode_koleksi"
                placeholder="PL-021"
                hint="Maksimal 30 karakter. Huruf akan diubah menjadi kapital."
                required
            />

            <x-input
                name="tahun"
                label="Tahun koleksi"
                type="number"
                :value="$koleksi->tahun"
                placeholder="1987"
                min="1900"
                max="{{ now()->year + 1 }}"
                hint="Boleh dikosongkan bila tahun belum diketahui."
            />

            <div class="md:col-span-2">
                <x-input
                    name="nama_koleksi"
                    label="Nama koleksi"
                    :value="$koleksi->nama_koleksi"
                    placeholder="Rekaman Gamelan Sriwedari, 1971"
                    required
                />
            </div>

            <x-select
                name="kategori_format_id"
                label="Kategori format"
                :options="$kategori->pluck('nama_format', 'id')->all()"
                :value="$koleksi->kategori_format_id"
                placeholder="Pilih format media"
                required
            />

            <div class="flex items-end">
                <p class="rounded-[4px] border border-dashed border-ink/20 bg-paper px-3 py-2 text-xs leading-relaxed text-ink-soft">
                    Format belum ada?
                    <a href="{{ route('kategori.create') }}" class="font-medium text-rust underline decoration-rust/40 underline-offset-2 hover:decoration-rust">Tambahkan kategori baru</a>.
                </p>
            </div>

            <div class="md:col-span-2">
                <x-textarea
                    name="deskripsi"
                    label="Deskripsi koleksi"
                    :value="$koleksi->deskripsi"
                    placeholder="Isi rekaman, konteks, pencipta, atau keterangan lain yang membantu identifikasi."
                    rows="4"
                    hint="Kosongkan bila belum ada keterangan tambahan."
                />
            </div>
        </div>
    </section>

    <section class="rounded-[6px] border-2 border-ink/20 bg-paper-light" aria-labelledby="bagian-kondisi">
        <div class="flex items-start gap-4 border-b-2 border-ink/10 px-5 py-4 sm:px-6">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 border-ink/30 font-mono text-[10px] font-semibold">02</span>
            <div>
                <h2 id="bagian-kondisi" class="text-xl">Kondisi awal</h2>
                <p class="mt-1 text-xs text-ink-soft">Satu koleksi memiliki satu catatan kondisi awal sebelum tindakan dilakukan.</p>
            </div>
        </div>

        <div class="grid gap-5 p-5 sm:p-6 lg:grid-cols-[1.35fr_1fr]">
            <div class="space-y-5">
                <x-textarea
                    name="detail[kondisi_awal]"
                    label="Uraian kondisi awal"
                    :value="$detailLama['kondisi_awal']"
                    placeholder="Contoh: pita lengket, cangkang retak, jamur pada 20 cm pertama, label pudar."
                    rows="6"
                    required
                    hint="Tuliskan temuan yang terlihat dan tercium, bukan dugaan penyebab."
                />

                <div>
                    <span class="font-mono text-[11px] font-medium uppercase tracking-[0.13em] text-ink-soft">
                        Tingkat kerusakan <span class="text-rust" aria-hidden="true">*</span>
                    </span>

                    <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-3">
                        @foreach ($tingkatOptions as $nilai => $label)
                            @php $terpilih = old('detail.tingkat_kerusakan', $detailLama['tingkat_kerusakan']) === $nilai; @endphp
                            <label class="cursor-pointer">
                                <input
                                    type="radio"
                                    name="detail[tingkat_kerusakan]"
                                    value="{{ $nilai }}"
                                    class="peer sr-only"
                                    @checked($terpilih)
                                    required
                                >
                                <span class="flex min-h-11 items-center justify-center rounded-[4px] border-2 px-3 py-2 text-center font-mono text-[10px] font-semibold uppercase tracking-[0.1em] transition peer-checked:border-ink peer-checked:bg-cream peer-checked:text-ink peer-focus-visible:outline peer-focus-visible:outline-3 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-rust {{ $terpilih ? 'border-ink bg-cream text-ink' : 'border-ink/20 bg-paper text-ink-soft' }}">
                                    {{ $label }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    @error('detail.tingkat_kerusakan')
                        <p class="mt-1.5 flex items-start gap-1.5 text-xs font-medium text-rust">
                            <x-icon name="warning" class="mt-0.5 h-3.5 w-3.5 shrink-0" />
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>
            </div>

            <div class="space-y-5">
                <x-textarea
                    name="detail[catatan]"
                    label="Catatan pemeriksa"
                    :value="$detailLama['catatan']"
                    placeholder="Contoh: pisahkan dari koleksi lain selama remediasi jamur."
                    rows="5"
                />

                <div class="rounded-[4px] border border-dashed border-ink/25 bg-cream/50 p-4">
                    <div class="flex items-center gap-2">
                        <x-icon name="info" class="h-4 w-4 text-ink-soft" />
                        <p class="font-mono text-[9px] font-semibold uppercase tracking-[0.15em] text-ink-soft">Panduan singkat</p>
                    </div>
                    <ul class="mt-3 space-y-2 text-xs leading-relaxed text-ink-soft">
                        <li class="flex gap-2"><span class="text-rust">01</span> Jangan memutar pita yang lengket atau berjamur sebelum dibersihkan.</li>
                        <li class="flex gap-2"><span class="text-rust">02</span> Catat bau, jamur, retakan, dan panjang pita yang terlipat.</li>
                        <li class="flex gap-2"><span class="text-rust">03</span> Simpan temuan apa adanya, termasuk bagian yang tampak normal.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-[6px] border-2 border-ink/20 bg-paper-light" aria-labelledby="bagian-tindakan">
        <div class="flex flex-wrap items-start justify-between gap-4 border-b-2 border-ink/10 px-5 py-4 sm:px-6">
            <div class="flex items-start gap-4">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-2 border-ink/30 font-mono text-[10px] font-semibold">03</span>
                <div>
                    <h2 id="bagian-tindakan" class="text-xl">Tindakan restorasi</h2>
                    <p class="mt-1 text-xs text-ink-soft">Pilih satu atau beberapa tindakan, lalu tentukan status dan tanggalnya.</p>
                </div>
            </div>
            <span class="inline-flex items-center gap-1.5 rounded-[3px] border border-ink/25 bg-cream px-2 py-1 font-mono text-[10px] uppercase tracking-[0.1em] text-ink-soft">
                <span data-action-count>{{ $jumlahTerpilih }}</span> dipilih
            </span>
        </div>

        @if ($tindakan->isEmpty())
            <div class="px-5 py-10 text-center sm:px-6">
                <p class="text-sm text-ink-soft">Master tindakan belum tersedia.</p>
                <x-button href="{{ route('tindakan.create') }}" variant="secondary" size="sm" icon="plus" class="mt-4">Tambahkan tindakan</x-button>
            </div>
        @else
            <div class="grid gap-3 p-5 sm:p-6 lg:grid-cols-2">
                @foreach ($tindakan as $item)
                    @php
                        $pivot = $tersimpan->get($item->id)?->pivot;
                        $dipilih = (bool) old("tindakan.{$item->id}.dipilih", $pivot !== null);
                        $status = old("tindakan.{$item->id}.status", $pivot->status ?? 'rencana');
                        $mulai = old("tindakan.{$item->id}.tanggal_mulai", $pivot?->tanggal_mulai);
                        $selesai = old("tindakan.{$item->id}.tanggal_selesai", $pivot?->tanggal_selesai);
                        $catatan = old("tindakan.{$item->id}.catatan", $pivot?->catatan);
                    @endphp

                    <div
                        data-action-card
                        data-active="{{ $dipilih ? 'true' : 'false' }}"
                        class="rounded-[4px] border-2 p-4 transition {{ $dipilih ? 'border-ink bg-cream/70' : 'border-ink/20 bg-paper-light' }}"
                    >
                        <label class="flex cursor-pointer items-start gap-3">
                            <input
                                type="checkbox"
                                name="tindakan[{{ $item->id }}][dipilih]"
                                value="1"
                                data-action-toggle
                                @checked($dipilih)
                                class="mt-0.5 h-5 w-5 shrink-0 rounded-[2px] border-2 border-ink/35 text-rust focus:ring-0 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rust"
                            >
                            <span class="min-w-0">
                                <span class="block text-sm font-semibold leading-snug text-ink">{{ $item->nama_tindakan }}</span>
                                @if ($item->deskripsi)
                                    <span class="mt-1 block text-xs leading-relaxed text-ink-soft">{{ \Illuminate\Support\Str::limit($item->deskripsi, 110) }}</span>
                                @endif
                            </span>
                        </label>

                        <div data-action-fields class="mt-4 space-y-3 border-t border-ink/15 pt-4 {{ $dipilih ? '' : 'pointer-events-none opacity-50' }}">
                            <div class="grid gap-3 sm:grid-cols-2">
                                <x-select
                                    name="tindakan[{{ $item->id }}][status]"
                                    label="Status"
                                    :options="$statusOptions"
                                    :value="$status"
                                />

                                <x-input
                                    name="tindakan[{{ $item->id }}][tanggal_mulai]"
                                    label="Tanggal mulai"
                                    type="date"
                                    :value="$mulai"
                                />

                                <x-input
                                    name="tindakan[{{ $item->id }}][tanggal_selesai]"
                                    label="Tanggal selesai"
                                    type="date"
                                    :value="$selesai"
                                />

                                <div class="flex items-end">
                                    <p class="text-[11px] leading-relaxed text-ink-faint">Status proses dan selesai memerlukan tanggal mulai. Status selesai memerlukan tanggal selesai.</p>
                                </div>
                            </div>

                            <x-textarea
                                name="tindakan[{{ $item->id }}][catatan]"
                                label="Catatan tindakan"
                                :value="$catatan"
                                rows="2"
                                placeholder="Bahan, alat, atau hasil yang perlu diingat."
                            />
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <div class="sticky bottom-3 z-20 flex flex-col gap-3 rounded-[4px] border-2 border-ink bg-paper-light p-3 shadow-hard sm:flex-row sm:items-center">
        <p class="px-1 text-xs leading-relaxed text-ink-soft">
            Koleksi, detail kondisi, dan pivot tindakan disimpan dalam satu transaksi.
        </p>
        <div class="flex flex-col-reverse gap-2 sm:ml-auto sm:flex-row">
            <x-button href="{{ $isEdit ? route('koleksi.show', $koleksi) : route('koleksi.index') }}" variant="secondary">
                Batal
            </x-button>
            <x-button type="submit" icon="floppy-disk">
                {{ $isEdit ? 'Simpan perubahan' : 'Simpan koleksi' }}
            </x-button>
        </div>
    </div>
</form>
