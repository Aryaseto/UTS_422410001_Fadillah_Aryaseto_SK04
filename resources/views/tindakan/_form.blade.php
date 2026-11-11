@php $isEdit = $tindakanRestorasi->exists; @endphp

<form method="POST" action="{{ $isEdit ? route('tindakan.update', $tindakanRestorasi) : route('tindakan.store') }}" class="space-y-6">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <section class="rounded-[6px] border-2 border-ink/20 bg-paper-light">
        <div class="border-b-2 border-ink/10 px-5 py-4 sm:px-6">
            <div class="flex items-center gap-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-[3px] border-2 border-ink/25 bg-cream text-ink">
                    <x-icon name="wrench" class="h-4 w-4" />
                </span>
                <div>
                    <h2 class="text-xl">Data tindakan</h2>
                    <p class="mt-0.5 text-xs text-ink-soft">Nama singkat dan penjelasan prosedur.</p>
                </div>
            </div>
        </div>

        <div class="grid gap-5 p-5 sm:p-6">
            <x-input
                name="nama_tindakan"
                label="Nama tindakan"
                :value="$tindakanRestorasi->nama_tindakan"
                placeholder="Contoh: Pembersihan kering"
                hint="Maksimal 120 karakter dan harus unik."
                required
            />

            <x-textarea
                name="deskripsi"
                label="Deskripsi"
                :value="$tindakanRestorasi->deskripsi"
                placeholder="Jelaskan alat, bahan, atau tahapan singkat tindakan ini."
                rows="6"
                hint="Deskripsi tampil pada formulir koleksi dan lembar detail."
            />
        </div>
    </section>

    @if ($isEdit && $tindakanRestorasi->koleksiPita()->exists())
        <x-alert type="info" title="Tindakan sedang terpasang">
            Tindakan ini terpasang pada {{ $tindakanRestorasi->koleksiPita()->count() }} koleksi. Lepaskan dari semua koleksi sebelum menghapusnya.
        </x-alert>
    @endif

    <div class="sticky bottom-3 z-20 flex flex-col gap-3 rounded-[4px] border-2 border-ink bg-paper-light p-3 shadow-hard sm:flex-row sm:items-center">
        <p class="px-1 text-xs leading-relaxed text-ink-soft">Tindakan baru langsung tersedia pada formulir koleksi.</p>
        <div class="flex flex-col-reverse gap-2 sm:ml-auto sm:flex-row">
            <x-button href="{{ route('tindakan.index') }}" variant="secondary">Batal</x-button>
            <x-button type="submit" icon="floppy-disk">{{ $isEdit ? 'Simpan perubahan' : 'Simpan tindakan' }}</x-button>
        </div>
    </div>
</form>
