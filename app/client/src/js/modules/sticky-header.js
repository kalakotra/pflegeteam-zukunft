/**
 * Adds .is-scrolled to the sticky header once the page has scrolled.
 */
export function initStickyHeader() {
    const header = document.querySelector('[data-sticky-header]');
    if (!header) {
        return;
    }

    const sentinel = document.createElement('div');
    sentinel.setAttribute('aria-hidden', 'true');
    sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;';
    document.body.prepend(sentinel);

    const observer = new IntersectionObserver(([entry]) => {
        header.classList.toggle('is-scrolled', !entry.isIntersecting);
    }, { rootMargin: '120px 0px 0px 0px' });

    observer.observe(sentinel);
}
