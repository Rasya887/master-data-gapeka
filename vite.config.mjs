import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js' // ganti dengan 'app.njs' jika file kamu memang .njs
      ],
      refresh: true, // otomatis refresh Blade saat JS/CSS berubah
    }),
    vue(),
  ],
})
