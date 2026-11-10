/**
 * Subtle fade-in for content sections. Skipped for prefers-reduced-motion
 * and for the first section (LCP must not be delayed).
 */
export function initReveal() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || !('IntersectionObserver' in window)) {
        return;
    }

    const targets = [...document.querySelectorAll('main .element')].slice(1);
    if (!targets.length) {
        return;
    }

    document.documentElement.classList.add('js-reveal');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -10% 0px', threshold: 0.05 });

    targets.forEach((el) => {
        const rect = el.getBoundingClientRect();
        el.setAttribute('data-reveal', '');
        if (rect.top < window.innerHeight) {
            el.classList.add('is-visible');
        } else {
            observer.observe(el);
        }
    });
}
