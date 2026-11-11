@extends('layouts.app')

@section('title', 'Catat Koleksi')

@section('content')
    <x-page-header
        eyebrow="Formulir koleksi · Langkah 1 dari 3"
        title="Catat koleksi baru"
        description="Satu formulir untuk identitas koleksi, detail kondisi awal, dan pilihan tindakan restorasi."
    >
        <x-slot name="actions">
            <x-button href="{{ route('koleksi.index') }}" variant="secondary" icon="arrow-left">Kembali ke daftar</x-button>
        </x-slot>
    </x-page-header>

    @include('koleksi._form', [
        'koleksi' => $koleksi,
        'kategori' => $kategori,
        'tindakan' => $tindakan,
    ])
@endsection
