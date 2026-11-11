@extends('layouts.app')

@section('title', 'Tambah Tindakan')

@section('content')
    <x-page-header
        eyebrow="Master data · Tindakan restorasi"
        title="Tambah tindakan"
        description="Catat satu langkah restorasi yang dapat dipilih pada formulir koleksi."
    >
        <x-slot name="actions">
            <x-button href="{{ route('tindakan.index') }}" variant="secondary" icon="arrow-left">Kembali</x-button>
        </x-slot>
    </x-page-header>

    @include('tindakan._form', ['tindakanRestorasi' => $tindakanRestorasi])
@endsection
