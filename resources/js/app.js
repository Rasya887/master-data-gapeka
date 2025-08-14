import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import AppLayout from './Layouts/AppLayout.vue'

// Import CSS utama
import '../css/app.css'

// Optional: import global components atau page tertentu jika ingin
// import './Pages/Auth/Login.vue' // sebenarnya tidak perlu jika pakai import.meta.glob

createInertiaApp({
  // resolve nama halaman sesuai folder Pages
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`].default

    // Jika halaman tidak memiliki layout, gunakan AppLayout
    if (!page.layout) {
      page.layout = AppLayout
    }

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})
