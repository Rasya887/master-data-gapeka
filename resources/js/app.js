import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import AppLayout from './Layouts/AppLayout.vue'
import './Pages/Auth/Login.vue'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page = pages[`./Pages/${name}.vue`].default

    // Jika tidak ditentukan, pakai AppLayout
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
