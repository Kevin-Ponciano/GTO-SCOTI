import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/dark-mode.js',
                'resources/adminLTE/plugins/fontawesome-free/css/all.min.css',
                'resources/adminLTE/dist/css/adminlte.css',
                'resources/adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
                'resources/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
            ],
            refresh: true,
        }),
    ],
});
