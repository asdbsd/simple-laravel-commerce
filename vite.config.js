import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/home-layout.css', 'resources/css/auth.css', 'resources/css/checkout.css', 'resources/js/app.js', 'resources/js/add-product.js'],
            refresh: true,
        }),
    ],
});
