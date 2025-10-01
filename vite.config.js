import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', 
        emptyOutDir: true, 
    },
    //for localhost
    // server: {
    //     host: '192.168.68.100',
    //     port: 5353,
    // },
});