import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/libs.bundle.css",
                "resources/css/theme.bundle.css",
                "resources/js/comparison.js",
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: "public/build",
        rollupOptions: {
            output: {
                entryFileNames: "assets/[name].[hash].js",
                chunkFileNames: "assets/[name].[hash].js",
                assetFileNames: "assets/[name].[hash].[ext]",
            },
        },
    },
});
