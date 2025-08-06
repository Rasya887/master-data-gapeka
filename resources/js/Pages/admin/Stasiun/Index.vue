<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Data Stasiun</h1>
     <div class="flex justify-between items-center mb-4">
    <Link
      href="/stasiuns/create"
      class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition"
    >
      + Tambah Stasiun
    </Link>
  </div>

    <!-- Filter & Search -->
    <!-- 🔎 Search -->
<div class="mb-4">
  <input
    type="text"
    v-model="filterForm.search"
    @keyup.enter="updateFilter"
    placeholder="Cari stasiun..."
    class="border rounded px-3 py-2 w-full"
  />
</div>

<!-- 🔽 Filter DAOP -->
<div class="mb-4">
  <label class="block text-sm font-medium mb-1">Filter Daop</label>
  <select
    v-model="filterForm.daop"
    @change="updateFilter"
    class="border rounded px-3 py-2 w-full"
  >
    <option value="">Semua Daop</option>
    <option v-for="daop in props.daops" :key="daop.id" :value="daop.id">
      {{ daop.nama }}
    </option>
  </select>
</div>

<!-- ✅ Filter Status -->
<div class="mb-4">
  <label class="block text-sm font-medium mb-1">Status</label>
  <select
    v-model="filterForm.aktif"
    @change="updateFilter"
    class="border rounded px-3 py-2 w-full"
  >
    <option value="">Semua Status</option>
    <option value="1">Aktif</option>
    <option value="0">Non Aktif</option>
  </select>
</div>

    <!-- Tabel -->
    <div class="overflow-auto">
      <table class="min-w-full border">
        <thead class="bg-blue-900 text-white">
          <tr>
            <th class="px-3 py-2 border">ID</th>
            <th class="px-3 py-2 border">Daop</th>
            <th class="px-3 py-2 border">Singkatan</th>
            <th class="px-3 py-2 border">Nama</th>
            <th class="px-3 py-2 border">DPL</th>
            <th class="px-3 py-2 border">Kode</th>
            <th class="px-3 py-2 border">Status</th>
            <th class="px-3 py-2 border">Kotak</th>
            <th class="px-3 py-2 border">Garis Tipis</th>
            <th class="px-3 py-2 border">Garis Tebal</th>
            <th class="px-3 py-2 border">Perhentian</th>
            <th class="px-3 py-2 border">Batas Daop</th>
            <th class="px-3 py-2 border">Created</th>
            <th class="px-3 py-2 border">Updated</th>
            <th class="px-3 py-2 border">Created By</th>
            <th class="px-3 py-2 border">Updated By</th>
            <th class="px-3 py-2 border">Track</th>
            <th class="px-3 py-2 border">PPKT</th>
            <th class="px-3 py-2 border">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="s in stasiuns.data" :key="s.id" class="hover:bg-gray-100">
            <td class="px-3 py-2 border">{{ s.id }}</td>
            <td class="px-3 py-2 border">{{ s.daop?.nama || '-' }}</td>
            <td class="px-3 py-2 border">{{ s.singkatan }}</td>
            <td class="px-3 py-2 border">{{ s.nama }}</td>
            <td class="px-3 py-2 border">{{ s.dpl }}</td>
            <td class="px-3 py-2 border">{{ s.kode }}</td>
            <td class="px-3 py-2 border">{{ s.aktif ? 'Aktif' : 'Non Aktif' }}</td>
            <td class="px-3 py-2 border">{{ s.kotak ? '✓' : '-' }}</td>
            <td class="px-3 py-2 border">{{ s.garis_tipis ? '✓' : '-' }}</td>
            <td class="px-3 py-2 border">{{ s.garis_tebal ? '✓' : '-' }}</td>
            <td class="px-3 py-2 border">{{ s.perhentian ? '✓' : '-' }}</td>
            <td class="px-3 py-2 border">{{ s.batas_daop ? '✓' : '-' }}</td>
            <td class="px-3 py-2 border">{{ s.created_at }}</td>
            <td class="px-3 py-2 border">{{ s.updated_at }}</td>
            <td class="px-3 py-2 border">{{ s.created_by }}</td>
            <td class="px-3 py-2 border">{{ s.updated_by }}</td>
            <td class="px-3 py-2 border">{{ s.track }}</td>
            <td class="px-3 py-2 border">{{ s.ppkt ? '✓' : '-' }}</td>
            <td class="whitespace-nowrap space-x-2">
  <Link :href="`/stasiuns/${s.id}/show`" class="text-green-600 hover:underline">Lihat</Link>
  <Link :href="`/stasiuns/${s.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
  <button @click="destroy(s.id)" class="text-red-600 hover:underline">Hapus</button>
</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
      <Pagination :links="stasiuns.links" />
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import Pagination from '@/Components/Pagination.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  stasiuns: Object,
  daops: Array,
  filters: Object,
})

// Filter form state
const filterForm = ref({
  search: props.filters.search || '',
  daop: props.filters.daop || '',
  aktif: props.filters.aktif || '',
})

// Submit filter ke backend
const updateFilter = () => {
  router.get('/stasiuns', {
    search: filterForm.value.search,
    daop: filterForm.value.daop,
    aktif: filterForm.value.aktif,
  }, {
    preserveState: true,
    preserveScroll: true,
  })
}

// Hapus data stasiun
const destroy = (id) => {
  if (confirm('Yakin ingin menghapus data ini?')) {
    router.delete(`/stasiuns/${id}`)
  }
}
</script>
