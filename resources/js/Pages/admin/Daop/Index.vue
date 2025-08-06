<template>
  <div>
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Data Daop</h1>
      <!-- Tombol tambah Daop selalu muncul, akses dibatasi di controller -->
      <Link href="/daops/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Tambah Daop
      </Link>
    </div>

    <!-- Filter -->
    <div class="flex flex-wrap gap-4 mb-6">
      <input
        type="text"
        v-model="filters.search"
        @input="applyFilters"
        class="border px-3 py-2 rounded-md shadow-sm w-64"
        placeholder="Cari nama atau singkatan"
      />
      <select
        v-model="filters.region"
        @change="applyFilters"
        class="border px-3 py-2 rounded-md shadow-sm"
      >
        <option value="">Semua Region</option>
        <option value="1">Jawa</option>
        <option value="2">Sumatera</option>
      </select>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
      <table class="min-w-full text-sm text-left border">
        <thead class="bg-blue-800 text-white">
          <tr>
            <th class="px-4 py-2 border">#</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Singkatan</th>
            <th class="px-4 py-2 border">Nomenklatur</th>
            <th class="px-4 py-2 border">Daop</th>
            <th class="px-4 py-2 border">Region</th>
            <th class="px-4 py-2 border">Bus Area</th>
            <th class="px-4 py-2 border w-40">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(daop, index) in daops.data" :key="daop.id" class="hover:bg-gray-100">
            <td class="px-4 py-2 border">
              {{ (daops.current_page - 1) * daops.per_page + index + 1 }}
            </td>
            <td class="px-4 py-2 border">{{ daop.nama }}</td>
            <td class="px-4 py-2 border">{{ daop.singkatan }}</td>
            <td class="px-4 py-2 border">{{ daop.nomenklatur ?? '-' }}</td>
            <td class="px-4 py-2 border">{{ daop.daop ?? '-' }}</td>
            <td class="px-4 py-2 border">
              {{ daop.id_region == 1 ? 'Jawa' : daop.id_region == 2 ? 'Sumatera' : '-' }}
            </td>
            <td class="px-4 py-2 border">{{ daop.bus_area ?? '-' }}</td>
            <td class="px-4 py-2 border space-x-2">
              <Link :href="`/daops/${daop.id}/show`" class="text-blue-600 hover:underline">
                Lihat
              </Link>
              <Link :href="`/daops/${daop.id}/edit`" class="text-yellow-600 hover:underline">
                Edit
              </Link>
              <button @click="destroy(daop.id)" class="text-red-600 hover:underline">
                Hapus
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-between items-center">
      <span class="text-sm text-gray-600">
        Menampilkan {{ daops.from }} - {{ daops.to }} dari {{ daops.total }}
      </span>

      <div class="space-x-2">
        <button :disabled="!daops.prev_page_url" @click="goToPage(daops.current_page - 1)" class="px-3 py-1 border rounded disabled:opacity-50">
          &laquo;
        </button>
        <button :disabled="!daops.next_page_url" @click="goToPage(daops.current_page + 1)" class="px-3 py-1 border rounded disabled:opacity-50">
          &raquo;
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router, usePage, Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const page = usePage()
const daops = page.props.daops

const filters = ref({
  search: page.props.filters?.search || '',
  region: page.props.filters?.region || '',
})

const applyFilters = () => {
  router.get('/daops', filters.value, {
    preserveState: true,
    replace: true,
  })
}

const destroy = (id) => {
  if (confirm('Yakin ingin menghapus data ini?')) {
    router.delete(`/daops/${id}`)
  }
}

const goToPage = (pageNumber) => {
  router.get('/daops', {
    ...filters.value,
    page: pageNumber,
  })
}
</script>
