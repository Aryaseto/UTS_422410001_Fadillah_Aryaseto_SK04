@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi halaman" class="mt-8 flex flex-col gap-4 border-t-2 border-ink/15 pt-5 sm:flex-row sm:items-center sm:justify-between">
        <p class="font-mono text-[10px] uppercase tracking-[0.1em] text-ink-faint">
            Menampilkan
            <span class="text-ink">{{ $paginator->firstItem() }}</span>
            sampai
            <span class="text-ink">{{ $paginator->lastItem() }}</span>
            dari
            <span class="text-ink">{{ $paginator->total() }}</span>
        </p>

        <div class="flex flex-wrap items-center gap-1.5">
            @if ($paginator->onFirstPage())
                <span class="inline-flex h-11 items-center gap-1 sm:h-9 rounded-[3px] border-2 border-ink/15 px-2.5 font-mono text-[10px] uppercase tracking-wider text-ink-faint">
                    <x-icon name="arrow-left" class="h-3.5 w-3.5" />
                    Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex h-11 items-center gap-1 sm:h-9 rounded-[3px] border-2 border-ink/25 bg-paper-light px-2.5 font-mono text-[10px] uppercase tracking-wider text-ink-soft transition hover:border-ink hover:text-ink">
                    <x-icon name="arrow-left" class="h-3.5 w-3.5" />
                    Sebelumnya
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="inline-flex h-11 w-11 sm:h-9 sm:w-9 items-center justify-center font-mono text-xs text-ink-faint">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="inline-flex h-11 w-11 sm:h-9 sm:w-9 items-center justify-center rounded-[3px] border-2 border-ink bg-ink font-mono text-xs font-semibold text-paper-light shadow-hard-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="inline-flex h-11 w-11 sm:h-9 sm:w-9 items-center justify-center rounded-[3px] border-2 border-ink/25 bg-paper-light font-mono text-xs text-ink-soft transition hover:border-ink hover:text-ink">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex h-11 items-center gap-1 sm:h-9 rounded-[3px] border-2 border-ink/25 bg-paper-light px-2.5 font-mono text-[10px] uppercase tracking-wider text-ink-soft transition hover:border-ink hover:text-ink">
                    Berikutnya
                    <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                </a>
            @else
                <span class="inline-flex h-11 items-center gap-1 sm:h-9 rounded-[3px] border-2 border-ink/15 px-2.5 font-mono text-[10px] uppercase tracking-wider text-ink-faint">
                    Berikutnya
                    <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                </span>
            @endif
        </div>
    </nav>
@endif
