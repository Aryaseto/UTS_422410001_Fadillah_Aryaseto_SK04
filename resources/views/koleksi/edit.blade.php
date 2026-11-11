@extends('layouts.app')

@section('title', 'Sunting '.$koleksi->kode_koleksi)

@section('content')
    <x-page-header
        :eyebrow="'Lembar '.$koleksi->kode_koleksi.' · Sunting'"
        title="Sunting koleksi"
        description="Perbarui identitas, kondisi awal, atau susunan tindakan restorasi. Semua perubahan disimpan dalam satu transaksi."
    >
        <x-slot name="actions">
            <x-button href="{{ route('koleksi.show', $koleksi) }}" variant="secondary" icon="arrow-left">Kembali ke detail</x-button>
        </x-slot>
    </x-page-header>

    @include('koleksi._form', [
        'koleksi' => $koleksi,
        'kategori' => $kategori,
        'tindakan' => $tindakan,
    ])
@endsection
