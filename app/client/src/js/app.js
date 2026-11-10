// Bootstrap components used by the theme (imported individually).
import Dropdown from 'bootstrap/js/dist/dropdown';
import Offcanvas from 'bootstrap/js/dist/offcanvas';

import { initStickyHeader } from './modules/sticky-header.js';
import { initReveal } from './modules/reveal.js';
import { initMapConsent } from './modules/map-consent.js';
import { initOffcanvasNav } from './modules/offcanvas-nav.js';

// Keep references so tree-shaking does not drop the data-API registrations.
window.bootstrap = { Dropdown, Offcanvas };

const ready = (fn) => {
    if (document.readyState !== 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn, { once: true });
    }
};

ready(() => {
    initStickyHeader();
    initReveal();
    initMapConsent();
    initOffcanvasNav(Offcanvas);
});
