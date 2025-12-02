import { defineConfig } from "vite";
import { resolve } from "path";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  build: {
    rollupOptions: {
      input: {
        main: resolve(__dirname, "index.html"),
        packages: resolve(__dirname, "packages.html"),
        contact: resolve(__dirname, "contact.html"),
        about: resolve(__dirname, "about.html"),
        blog: resolve(__dirname, "blog.html"),
        refund: resolve(__dirname, "refundpolicy.html"),
        privacy: resolve(__dirname, "privacypolicy.html"),
      },
    },
  },
});
