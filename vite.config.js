import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // *** Ավելացնում ենք այս բաժինը Vite-ը հանրային դարձնելու համար ***
    server: {
        // Այս պարամետրը թույլ է տալիս արտաքին միացումներ
        host: '0.0.0.0', 
        // Այն պորտը, որտեղ աշխատում է Vite-ը
        port: 5173, 
        // Հնարավորություն է տալիս օգտագործել տեղական IP հասցեն
        hmr: {
            host: '192.168.1.5', // Օգտագործեք Ձեր իսկական IP-ն այստեղ
        },
        // Ծառայության բեռնումը HTTP-ով թույլատրելու համար
        strictPort: true,
    },
});