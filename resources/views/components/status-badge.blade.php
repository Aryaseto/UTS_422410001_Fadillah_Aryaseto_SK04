@props([
    'status',
    'type' => 'tindakan',
])

@php
    $maps = [
        'tindakan' => [
            'rencana' => ['Rencana', 'border-ink/25 bg-paper text-ink-soft'],
            'proses' => ['Proses', 'border-ochre/45 bg-ochre-light text-ochre'],
            'selesai' => ['Selesai', 'border-sage bg-sage-light text-ink'],
            'belum' => ['Belum ada', 'border-ink/20 bg-paper text-ink-faint'],
        ],
        'kerusakan' => [
            'ringan' => ['Ringan', 'border-sage bg-sage-light text-ink'],
            'sedang' => ['Sedang', 'border-ochre/45 bg-ochre-light text-ochre'],
            'berat' => ['Berat', 'border-rust/45 bg-rust-light text-rust'],
        ],
    ];

    $map = $maps[$type] ?? $maps['tindakan'];
    [$label, $classes] = $map[$status] ?? [ucfirst((string) $status), 'border-ink/20 bg-paper text-ink-soft'];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 rounded-[3px] border px-2 py-1 font-mono text-[10px] font-semibold uppercase leading-none tracking-[0.1em] '.$classes]) }}>
    <span class="h-1.5 w-1.5 rounded-full bg-current" aria-hidden="true"></span>
    {{ $label }}
</span>
