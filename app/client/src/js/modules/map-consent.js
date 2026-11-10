/**
 * Two-click map: the Google Maps iframe is only created after explicit consent (DSGVO).
 */
export function initMapConsent() {
    document.querySelectorAll('[data-map-consent]').forEach((box) => {
        const button = box.querySelector('[data-map-consent-button]');
        const src = box.dataset.src;
        if (!button || !src) {
            return;
        }

        button.addEventListener('click', () => {
            const iframe = document.createElement('iframe');
            iframe.src = src;
            iframe.title = box.dataset.title || 'Karte';
            iframe.loading = 'lazy';
            iframe.referrerPolicy = 'no-referrer-when-downgrade';
            iframe.allowFullscreen = true;

            box.replaceChildren(iframe);
            box.classList.add('is-loaded');
            iframe.focus();
        });
    });
}
