const { defineConfig } = require('vite');
const laravel = require('laravel-vite-plugin');
const vue = require('@vitejs/plugin-vue');

module.exports = defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/Pages/Auth/Login.vue', // ⬅️ Tambahkan ini jika file tidak termasuk di app.js
      ],
      refresh: true,
    }),
    vue(),
  ],
});