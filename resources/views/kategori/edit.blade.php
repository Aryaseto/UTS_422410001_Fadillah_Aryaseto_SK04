@extends('layouts.app')

@section('title', 'Sunting Kategori')

@section('content')
    <x-page-header
        eyebrow="Master data · Kategori format"
        title="Sunting kategori"
        description="Perbarui nama atau deskripsi format. Nama format harus tetap unik."
    >
        <x-slot name="actions">
            <x-button href="{{ route('kategori.index') }}" variant="secondary" icon="arrow-left">Kembali</x-button>
        </x-slot>
    </x-page-header>

    @include('kategori._form', ['kategoriFormat' => $kategoriFormat])
@endsection
