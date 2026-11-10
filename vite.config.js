import { defineConfig } from 'vite';

// Vite at the project root, sources in app/client/src, build to app/client/dist
// (manifest read by atwx/silverstripe-vitehelper). Works locally and in DDEV.
export default defineConfig(() => {
    const primaryUrl = process.env.DDEV_PRIMARY_URL || 'http://localhost';
    const origin = `${primaryUrl.replace(/:\d+$/, '')}:5173`;

    return {
        base: './',
        publicDir: false,
        server: {
            host: '0.0.0.0',
            port: 5173,
            strictPort: true,
            origin,
            cors: {
                origin: /https?:\/\/([A-Za-z0-9\-.]+)?(\.ddev\.site|localhost)(?::\d+)?$/,
            },
        },
        css: {
            preprocessorOptions: {
                scss: {
                    // Bootstrap 5.3 still uses @import and global functions.
                    quietDeps: true,
                    silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'if-function'],
                },
            },
        },
        build: {
            outDir: 'app/client/dist',
            emptyOutDir: true,
            manifest: true,
            sourcemap: false,
            cssCodeSplit: true,
            assetsInlineLimit: 0,
            rollupOptions: {
                input: [
                    'app/client/src/js/app.js',
                    'app/client/src/scss/app.scss',
                    'app/client/src/scss/editor.scss',
                ],
            },
        },
    };
});
