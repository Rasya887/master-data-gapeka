<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Manajemen Menu</h1>

    <Link href="/menus/create" class="btn btn-primary mb-4">Tambah Menu</Link>

    <table class="table-auto w-full border">
      <thead class="bg-gray-100">
        <tr>
          <th class="p-2 text-left">Nama</th>
          <th class="p-2 text-left">Route</th>
          <th class="p-2 text-left">Urutan</th>
          <th class="p-2 text-left">Status</th>
          <th class="p-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="menu in menus" :key="menu.id" class="border-t">
          <td class="p-2">{{ menu.name }}</td>
          <td class="p-2">{{ menu.route }}</td>
          <td class="p-2">{{ menu.menu_order }}</td>
          <td class="p-2">
            <span :class="menu.is_active ? 'text-green-600' : 'text-red-600'">
              {{ menu.is_active ? 'Aktif' : 'Non Aktif' }}
            </span>
          </td>
          <td class="p-2 space-x-2">
            <Link :href="`/menus/${menu.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
            <button @click="hapus(menu.id)" class="text-red-600 hover:underline">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  menus: Array
})

function hapus(id) {
  if (confirm('Yakin ingin menghapus menu ini?')) {
    router.delete(`/menus/${id}`)
  }
}
</script>
