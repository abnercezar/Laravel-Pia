import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

const host = 'localhost'; 

export default defineConfig(({ ssrBuild }) => {
    let build;

    if (! ssrBuild)
        build = {
            sourcemap: false,
            chunkSizeWarningLimit: 1000,
            rollupOptions: {
                output: {
                    manualChunks: {
                        vendor: [
                            'vue',
                            '@inertiajs/inertia',
                            '@inertiajs/inertia-vue3',
                            '@inertiajs/progress'
                        ],
                        axios: ['axios'],
                        lodash: ['lodash'],
                    },
                },
            }
        };

    return {
            build,
            plugins: [
            laravel({
                input: "resources/js/app.js",
                ssr: 'resources/js/ssr.js',
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        server: {
            hmr: {
                host: "localhost",
            },
        },
        ssr: {
            noExternal: [
                '@inertiajs/server',
            ],
        },
    };
});
