import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/admin/master_data/rayons/script.js',
                'resources/js/admin/master_data/rombels/script.js',
            ],
            refresh: true,
        }),
    ],
});
