import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import react from '@vitejs/plugin-react'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: true,
        }),
        react(),
    ],
    server: {
        host: true,
        hmr: {
            host: 'localhost',
            protocol: 'ws',
            port: parseInt(process.env.VITE_PORT ?? '5173'),
        },
        watch: { usePolling: true },
    },
})
