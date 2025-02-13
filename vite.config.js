import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/admin/js/helper.js',
                
                // Brand
                'resources/admin/js/pages/brand/index.js',
            ],
            refresh: true,
        }),
    ],
});
