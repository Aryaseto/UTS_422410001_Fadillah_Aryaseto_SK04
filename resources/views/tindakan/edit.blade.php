@extends('layouts.app')

@section('title', 'Sunting Tindakan')

@section('content')
    <x-page-header
        eyebrow="Master data · Tindakan restorasi"
        title="Sunting tindakan"
        description="Perbarui nama atau deskripsi tindakan. Nama tindakan harus tetap unik."
    >
        <x-slot name="actions">
            <x-button href="{{ route('tindakan.index') }}" variant="secondary" icon="arrow-left">Kembali</x-button>
        </x-slot>
    </x-page-header>

    @include('tindakan._form', ['tindakanRestorasi' => $tindakanRestorasi])
@endsection
