<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#2d2821">
    <meta name="description" content="Pita Lestari, ruang kerja pendataan dan restorasi koleksi pita rekaman analog.">
    <title>@yield('title', 'Ruang Kerja') · {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-dvh font-sans text-ink antialiased">
    <div class="noise-overlay" aria-hidden="true"></div>

    <a href="#konten" class="sr-only z-[70] rounded-[4px] border-2 border-ink bg-cream px-4 py-2 font-mono text-xs uppercase tracking-wider text-ink focus:not-sr-only focus:fixed focus:left-4 focus:top-4">
        Lompat ke konten
    </a>

    @include('partials.sidebar')

    <div class="flex min-h-dvh flex-col lg:pl-72">
        @include('partials.navbar')

        <main id="konten" class="mx-auto w-full max-w-[1440px] flex-1 px-4 py-7 sm:px-6 sm:py-9 lg:px-10 lg:py-10">
            @include('partials.flash-message')
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    @include('partials.confirm-dialog')
</body>
</html>
