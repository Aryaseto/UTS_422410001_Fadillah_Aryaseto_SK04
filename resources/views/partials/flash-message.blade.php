@if (session('success'))
    <div class="mb-6">
        <x-alert type="success" title="Tersimpan" dismissible>
            {{ session('success') }}
        </x-alert>
    </div>
@endif

@if (session('error'))
    <div class="mb-6">
        <x-alert type="error" title="Belum bisa diproses" dismissible>
            {{ session('error') }}
        </x-alert>
    </div>
@endif

@if ($errors->any())
    <div class="mb-6">
        <x-alert type="error" title="Periksa kembali isian">
            <p>Ada {{ $errors->count() }} hal yang perlu diperbaiki sebelum data dapat disimpan.</p>
            <ul class="mt-2 list-inside list-disc space-y-1 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    </div>
@endif
