import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/map.css',
                'resources/js/api.js',
                'resources/js/app.js',
                'resources/js/burned.js',
                'resources/js/create_message.js',
                'resources/js/create_spot.js',
                'resources/js/dashboard.js',
                'resources/js/functions.js',
                'resources/js/index.js',
                'resources/js/kara_kira.js',
                'resources/js/mapConfig.js',
                'resources/js/map_read.js',
                'resources/js/map_throw.js',
                'resources/js/model.js',
                'resources/js/reading_message.js',
                'resources/js/top.js',
                'resources/js/typing.js',
            ],
            refresh: true,
        }),
    ],
});
