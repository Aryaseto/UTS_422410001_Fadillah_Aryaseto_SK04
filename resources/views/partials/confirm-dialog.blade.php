<dialog
    id="confirm-dialog"
    class="m-auto w-[min(92vw,30rem)] rounded-[6px] border-0 bg-transparent p-0 backdrop:bg-ink/65"
    aria-labelledby="confirm-dialog-title"
>
    <div class="border-2 border-ink bg-paper-light p-6 shadow-hard-lg">
        <div class="flex items-start gap-4">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-[4px] border-2 border-rust bg-rust-light text-rust">
                <x-icon name="warning" class="h-5 w-5" />
            </span>
            <div class="min-w-0 flex-1">
                <p class="font-mono text-[9px] font-semibold uppercase tracking-[0.2em] text-ink-faint">Konfirmasi</p>
                <h2 id="confirm-dialog-title" data-confirm-title class="mt-1 text-xl text-ink">Hapus data ini?</h2>
                <p data-confirm-message class="mt-2 text-sm leading-relaxed text-ink-soft">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <form method="dialog">
                <button
                    type="submit"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-[3px] text-ink-soft transition hover:bg-ink/10 hover:text-ink"
                    aria-label="Tutup dialog"
                >
                    <x-icon name="x" class="h-4 w-4" />
                </button>
            </form>
        </div>

        <div class="mt-6 flex flex-col-reverse gap-2.5 border-t-2 border-ink/10 pt-5 sm:flex-row sm:justify-end">
            <form method="dialog">
                <x-button variant="secondary" size="md" class="w-full sm:w-auto">Batal</x-button>
            </form>
            <x-button type="button" variant="danger" size="md" data-confirm-submit class="w-full sm:w-auto">
                Ya, hapus
            </x-button>
        </div>
    </div>
</dialog>
