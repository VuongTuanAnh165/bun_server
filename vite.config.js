import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import { fileURLToPath, URL } from "node:url";
import fg from "fast-glob";

export default defineConfig({
    resolve: {
        alias: {
            "@assets": fileURLToPath(
                new URL("./resources/assets", import.meta.url)
            ),
            "@": fileURLToPath(new URL("./resources", import.meta.url)),
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/assets/css/mediox.css",
                "resources/assets/js/mediox.js",
                ...fg.sync("resources/assets/vendors/**/*.{css,js}"),
            ],
            refresh: ["resources/views/**", "resources/assets/**"],
        }),
        tailwindcss(),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
});
