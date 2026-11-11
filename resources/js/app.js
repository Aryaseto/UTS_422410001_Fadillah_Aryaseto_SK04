import './bootstrap';

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/**
 * Sidebar bergaya punggung kaset: panel geser untuk layar kecil.
 */
const sidebar = document.getElementById('app-sidebar');
const sidebarOverlay = document.getElementById('sidebar-overlay');
const sidebarOpen = document.getElementById('sidebar-open');
const sidebarClosers = document.querySelectorAll('[data-sidebar-close]');

const setSidebar = (open) => {
    if (!sidebar) return;

    sidebar.classList.toggle('-translate-x-full', !open);
    sidebar.classList.toggle('translate-x-0', open);
    sidebarOverlay?.classList.toggle('hidden', !open);
    sidebarOpen?.setAttribute('aria-expanded', open ? 'true' : 'false');
    document.body.classList.toggle('overflow-hidden', open);
    document.body.classList.toggle('lg:overflow-auto', open);

    if (open) {
        window.setTimeout(() => sidebar.querySelector('a, button')?.focus(), prefersReducedMotion ? 0 : 120);
    } else {
        sidebarOpen?.focus({ preventScroll: true });
    }
};

sidebarOpen?.addEventListener('click', () => setSidebar(true));
sidebarClosers.forEach((el) => el.addEventListener('click', () => setSidebar(false)));
sidebarOverlay?.addEventListener('click', () => setSidebar(false));

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && sidebar && !sidebar.classList.contains('-translate-x-full')) {
        setSidebar(false);
    }
});

window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
    if (event.matches) {
        sidebarOverlay?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        sidebarOpen?.setAttribute('aria-expanded', 'false');
    }
});

/**
 * Dialog konfirmasi hapus. Memakai <dialog> agar Escape dan focus trap
 * ditangani browser. Form tetap bisa dikirim tanpa JavaScript.
 */
const confirmDialog = document.getElementById('confirm-dialog');
const confirmTitle = confirmDialog?.querySelector('[data-confirm-title]');
const confirmMessage = confirmDialog?.querySelector('[data-confirm-message]');
const confirmSubmit = confirmDialog?.querySelector('[data-confirm-submit]');
let pendingForm = null;

document.addEventListener('submit', (event) => {
    const form = event.target.closest('form[data-confirm]');

    if (!form || form.dataset.confirmed === 'true') {
        return;
    }

    if (!confirmDialog || typeof confirmDialog.showModal !== 'function') {
        if (!window.confirm(form.dataset.confirm || 'Lanjutkan tindakan ini?')) {
            event.preventDefault();
        }

        return;
    }

    event.preventDefault();
    pendingForm = form;
    confirmTitle.textContent = form.dataset.confirmTitle || 'Konfirmasi tindakan';
    confirmMessage.textContent = form.dataset.confirm || 'Tindakan ini tidak dapat dibatalkan.';
    confirmDialog.showModal();
});

confirmSubmit?.addEventListener('click', () => {
    if (!pendingForm) return;

    const form = pendingForm;
    pendingForm = null;
    form.dataset.confirmed = 'true';
    confirmDialog.close();
    form.submit();
});

confirmDialog?.addEventListener('close', () => {
    pendingForm = null;
});

/**
 * Kartu tindakan restorasi: field hanya aktif saat tindakan dicentang.
 */
const updateActionCount = () => {
    const count = document.querySelectorAll('[data-action-toggle]:checked').length;
    document.querySelectorAll('[data-action-count]').forEach((el) => {
        el.textContent = String(count);
    });
};

document.querySelectorAll('[data-action-card]').forEach((card) => {
    const toggle = card.querySelector('[data-action-toggle]');
    const fields = card.querySelector('[data-action-fields]');

    if (!toggle || !fields) return;

    const sync = () => {
        const active = toggle.checked;

        fields.querySelectorAll('input, select, textarea').forEach((field) => {
            field.disabled = !active;
            if (field.dataset.required === 'true') {
                field.required = active;
            }
        });

        card.dataset.active = active ? 'true' : 'false';
        card.classList.toggle('border-ink', active);
        card.classList.toggle('border-ink/20', !active);
        card.classList.toggle('bg-cream/70', active);
        card.classList.toggle('bg-paper-light', !active);
        fields.classList.toggle('opacity-50', !active);
        fields.classList.toggle('pointer-events-none', !active);
    };

    toggle.addEventListener('change', () => {
        sync();
        updateActionCount();
    });

    sync();
});

updateActionCount();

/**
 * Flash message bisa ditutup.
 */
document.querySelectorAll('[data-flash-close]').forEach((button) => {
    button.addEventListener('click', () => {
        button.closest('[data-flash]')?.remove();
    });
});

/**
 * Salin kode koleksi ke clipboard.
 */
document.querySelectorAll('[data-copy]').forEach((button) => {
    button.addEventListener('click', async () => {
        const value = button.dataset.copy;
        const label = button.querySelector('[data-copy-label]') || button;

        try {
            await navigator.clipboard.writeText(value);
            const previous = label.textContent;
            label.textContent = 'Tersalin';
            window.setTimeout(() => {
                label.textContent = previous;
            }, 1600);
        } catch {
            label.textContent = 'Gagal menyalin';
        }
    });
});

/**
 * Tombol "/" memfokuskan pencarian global.
 */
const globalSearch = document.querySelector('[data-global-search]');

document.addEventListener('keydown', (event) => {
    const tag = document.activeElement?.tagName;
    const isTyping = ['INPUT', 'TEXTAREA', 'SELECT'].includes(tag);

    if (event.key === '/' && !isTyping && globalSearch) {
        event.preventDefault();
        globalSearch.focus();
    }
});
