@php $isEdit = $kategoriFormat->exists; @endphp

<form method="POST" action="{{ $isEdit ? route('kategori.update', $kategoriFormat) : route('kategori.store') }}" class="space-y-6">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <section class="rounded-[6px] border-2 border-ink/20 bg-paper-light">
        <div class="border-b-2 border-ink/10 px-5 py-4 sm:px-6">
            <div class="flex items-center gap-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-[3px] border-2 border-ink/25 bg-cream text-ink">
                    <x-icon name="tag" class="h-4 w-4" />
                </span>
                <div>
                    <h2 class="text-xl">Data format</h2>
                    <p class="mt-0.5 text-xs text-ink-soft">Nama singkat dan keterangan yang membantu identifikasi.</p>
                </div>
            </div>
        </div>

        <div class="grid gap-5 p-5 sm:p-6">
            <x-input
                name="nama_format"
                label="Nama format"
                :value="$kategoriFormat->nama_format"
                placeholder="Contoh: Kaset Compact"
                hint="Maksimal 100 karakter dan harus unik."
                required
            />

            <x-textarea
                name="deskripsi"
                label="Deskripsi"
                :value="$kategoriFormat->deskripsi"
                placeholder="Jelaskan ukuran pita, periode populer, atau ciri khas format ini."
                rows="5"
                hint="Boleh dikosongkan, tetapi deskripsi membantu pengguna baru."
            />
        </div>
    </section>

    @if ($isEdit && $kategoriFormat->koleksiPita()->exists())
        <x-alert type="info" title="Kategori sedang dipakai">
            Kategori ini terhubung dengan {{ $kategoriFormat->koleksiPita()->count() }} koleksi. Selama masih dipakai, kategori tidak dapat dihapus.
        </x-alert>
    @endif

    <div class="sticky bottom-3 z-20 flex flex-col gap-3 rounded-[4px] border-2 border-ink bg-paper-light p-3 shadow-hard sm:flex-row sm:items-center">
        <p class="px-1 text-xs leading-relaxed text-ink-soft">Nama format dipakai sebagai rujukan pada formulir koleksi.</p>
        <div class="flex flex-col-reverse gap-2 sm:ml-auto sm:flex-row">
            <x-button href="{{ route('kategori.index') }}" variant="secondary">Batal</x-button>
            <x-button type="submit" icon="floppy-disk">{{ $isEdit ? 'Simpan perubahan' : 'Simpan kategori' }}</x-button>
        </div>
    </div>
</form>
