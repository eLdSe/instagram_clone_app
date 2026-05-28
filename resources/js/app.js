import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// ── Auto-resize textareas ───────────────────────────────────────
document.addEventListener('DOMContentLoaded', initUI);
document.addEventListener('livewire:load', initUI);
document.addEventListener('livewire:update', initUI);

function initUI() {
    // Auto-grow textareas
    document.querySelectorAll('textarea').forEach(ta => {
        if (ta._autoGrowInit) return;
        ta._autoGrowInit = true;
        const resize = () => {
            ta.style.height = 'auto';
            ta.style.height = ta.scrollHeight + 'px';
        };
        ta.addEventListener('input', resize);
        resize();
    });

    // Heart pop animation on like buttons
    document.querySelectorAll('[wire\\:click="toggle_like"]').forEach(btn => {
        if (btn._heartInit) return;
        btn._heartInit = true;
        btn.addEventListener('click', () => {
            const icon = btn.querySelector('i');
            if (icon) {
                icon.classList.remove('heart-pop');
                void icon.offsetWidth; // reflow
                icon.classList.add('heart-pop');
            }
        });
    });
}

// ── Smooth page transitions ────────────────────────────────────
document.addEventListener('click', e => {
    const a = e.target.closest('a[href]');
    if (!a) return;
    const href = a.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('javascript') || a.target === '_blank') return;
    if (a.hasAttribute('wire:click') || a.hasAttribute('@click')) return;
    // Only internal links
    try {
        const url = new URL(href, window.location.href);
        if (url.hostname !== window.location.hostname) return;
    } catch { return; }

    document.body.style.transition = 'opacity 0.15s ease';
    document.body.style.opacity = '0';
});

window.addEventListener('pageshow', () => {
    document.body.style.opacity = '1';
});
