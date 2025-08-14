<template>
  <div class="layout-wrapper">
    <aside class="sidebar" :class="{ 'sidebar-open': sidebarOpen }">
      <nav class="sidebar-nav">
        <div class="sidebar-top">
          <div class="sidebar-header">
            <h3 class="logo-text">Menu Admin</h3>
          </div>
          <ul class="sidebar-menu">
            <li><Link href="/users" class="sidebar-link">Manajemen User</Link></li>
            <li><Link href="/roles" class="sidebar-link">Manajemen Role</Link></li>
            <li><Link href="/menus" class="sidebar-link">Manajemen Menu</Link></li>
            <li class="menu-divider"></li>
            <li><Link href="/daops" class="sidebar-link">Data Daop</Link></li>
            <li><Link href="/stasiuns" class="sidebar-link">Data Stasiun</Link></li>
            <li><Link href="/jarak" class="sidebar-link">Data Jarak</Link></li>
            <li class="menu-divider"></li>
            <li><Link href="/export" class="sidebar-link">Export Excel/Pdf</Link></li>
          </ul>
        </div>
        <div class="logout-container">
          <Link href="/logout" method="post" as="button" type="button" class="logout-btn">
            Logout
          </Link>
        </div>
      </nav>
    </aside>

    <div class="main-content" :class="{ 'content-shifted': sidebarOpen }">
      <button class="hamburger" @click="sidebarOpen = !sidebarOpen">
        &#9776;
      </button>
      <slot />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const sidebarOpen = ref(true)
const page = usePage()

const showSidebar = computed(() => page.url.startsWith('/admin'))
</script>


<style scoped>
:root {
  --primary-orange: #ff7e1d;
  --link-hover-bg: #ffe0c2;
}

.layout-wrapper {
  display: flex;
  height: 100vh;
}

.sidebar {
  width: 280px;
  background: #ffffff;
  padding: 1rem 0;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 0 10px 10px 0;
  position: fixed;
  top: 5rem;
  left: 0;
  height: calc(100vh - 5rem);
  z-index: 100;
  transform: translateX(-100%);
  transition: transform 0.3s ease;
  display: flex;
  flex-direction: column;
}

.sidebar-open {
  transform: translateX(0);
}

.sidebar-nav {
  display: flex;
  flex-direction: column;
  height: 100%;
  justify-content: space-between;
}

.sidebar-top {
  flex-grow: 1;
}

.sidebar-header {
  padding: 0 1.5rem 1rem;
  border-bottom: 1px solid #e0e0e0;
}

.logo-text {
  margin: 0;
  color: #333;
}

.sidebar-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar-menu li {
  padding: 0.5rem 1.5rem;
}

.sidebar-link {
  display: block;
  text-decoration: none;
  color: #555;
  padding: 0.75rem 1rem;
  border-radius: 5px;
  transition: background-color 0.2s ease, color 0.2s ease;
}

.sidebar-link:hover {
  background-color: var(--link-hover-bg);
  color: var(--primary-orange);
}

.menu-divider {
  height: 1px;
  background-color: #e0e0e0;
  margin: 1rem 1.5rem;
}

.logout-container {
  padding: 1rem 1.5rem;
  border-top: 1px solid #ffffff;
}

.logout-btn {
  width: 100%;
  background-color: var(--primary-orange);
  color: #e36a11;
  border: none;
  padding: 0.75rem 1rem;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1rem;
  font-weight: bold;
  transition: background-color 0.2s ease, transform 0.2s ease;
  /* Tambahan: Pastikan tombol tidak disembunyikan */
  opacity: 1;
  visibility: visible;
}

.logout-btn:hover {
  background-color: #1c009b;
  transform: translateY(-2px);
}

.main-content {
  flex: 1;
  position: relative;
  background: #f8f9fa;
  transition: margin-left 0.3s ease;
}

.content-shifted {
  margin-left: 280px;
}

.hamburger {
  position: fixed;
  top: 1rem;
  left: 1rem;
  z-index: 101;
  background: #333;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 0.5rem 0.75rem;
  font-size: 1.5rem;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.hamburger:hover {
  background-color: #555;
}
</style>