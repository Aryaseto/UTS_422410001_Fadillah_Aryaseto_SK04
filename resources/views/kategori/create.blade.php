@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <x-page-header
        eyebrow="Master data · Kategori format"
        title="Tambah kategori"
        description="Buat kelompok format media baru agar koleksi lebih mudah ditelusuri."
    >
        <x-slot name="actions">
            <x-button href="{{ route('kategori.index') }}" variant="secondary" icon="arrow-left">Kembali</x-button>
        </x-slot>
    </x-page-header>

    @include('kategori._form', ['kategoriFormat' => $kategoriFormat])
@endsection
