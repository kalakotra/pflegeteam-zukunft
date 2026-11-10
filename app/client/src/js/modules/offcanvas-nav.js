/**
 * Closes the mobile offcanvas menu when an in-page link inside it is followed,
 * and when the viewport grows to desktop width.
 *
 * @param {typeof import('bootstrap/js/dist/offcanvas').default} Offcanvas
 */
export function initOffcanvasNav(Offcanvas) {
    const el = document.getElementById('site-nav');
    if (!el) {
        return;
    }

    el.addEventListener('click', (event) => {
        const link = event.target.closest('a[href^="#"]');
        if (link) {
            Offcanvas.getInstance(el)?.hide();
        }
    });

    const desktop = window.matchMedia('(min-width: 992px)');
    desktop.addEventListener('change', (event) => {
        if (event.matches) {
            Offcanvas.getInstance(el)?.hide();
        }
    });
}
