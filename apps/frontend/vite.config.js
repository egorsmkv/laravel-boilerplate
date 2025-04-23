import {defineConfig} from 'vite';
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: [
                '**/node_modules/**',
                '**/vendor/**',
                '**/.git/**',
            ]
        },
        hmr: {
            host: process.env.HMR_HOST,
        },
    },
});
