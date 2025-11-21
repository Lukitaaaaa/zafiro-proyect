import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/Posts/index.js',
                'resources/js/explore.js',
                'resources/js/profile-edit.js'
            ],
            refresh: true,
        }),
    ],
});
