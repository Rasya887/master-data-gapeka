<template>
  <div class="p-6 bg-white rounded-xl shadow">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold text-blue-800">Data Jarak</h1>
      <Link href="/jarak/create" class="bg-green-600 text-white px-4 py-2 rounded-lg">+ Tambah</Link>
    </div>

    <div class="mb-4 flex flex-wrap gap-2">
      <input
        v-model="search"
        @keyup.enter="applyFilters"
        placeholder="Cari stasiun..."
        class="border border-gray-300 px-3 py-2 rounded-lg"
      />
      <select v-model="selectedDaop" class="border border-gray-300 px-3 py-2 rounded-lg">
        <option value="">Semua Daop</option>
        <option v-for="daop in daops" :key="daop.id" :value="daop.id">{{ daop.nama }}</option>
      </select>
      <select v-model="selectedStatus" class="border border-gray-300 px-3 py-2 rounded-lg">
        <option value="">Semua Status</option>
        <option value="1">Aktif</option>
        <option value="0">Nonaktif</option>
      </select>
      <button @click="applyFilters" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        Filter
      </button>
    </div>

    <table class="w-full border text-sm text-left">
      <thead class="bg-gray-100 text-xs text-gray-700 uppercase">
        <tr>
          <th class="p-2 border">#</th>
          <th class="p-2 border">Daop</th>
          <th class="p-2 border">Stasiun</th>
          <th class="p-2 border">Stasiun Sebelah</th>
          <th class="p-2 border">Lintas</th>
          <th class="p-2 border">Tahun Gapeka</th>
          <th class="p-2 border">Jarak (km)</th>
          <th class="p-2 border">Puncak Kecepatan</th>
          <th class="p-2 border">Taspat</th>
          <th class="p-2 border">Kec. Barang</th>
          <th class="p-2 border">Status</th>
          <th class="p-2 border">Created At</th>
          <th class="p-2 border">Created By</th>
          <th class="p-2 border">Updated At</th>
          <th class="p-2 border">Updated By</th>
          <th class="p-2 border">Approved At</th>
          <th class="p-2 border">Approved By</th>
          <th class="p-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(jarak, index) in jaraks.data" :key="jarak.id" class="hover:bg-gray-50">
          <td class="p-2 border">{{ index + 1 + ((jaraks.current_page - 1) * jaraks.per_page) }}</td>
          <td class="p-2 border">{{ jarak.daop?.nama || '-' }}</td>
          <td class="p-2 border">{{ jarak.stasiun?.nama || '-' }}</td>
          <td class="p-2 border">{{ jarak.stasiun_sebelah?.nama || '-' }}</td>
          <td class="p-2 border">{{ jarak.lintas?.nama || '-' }}</td>
          <td class="p-2 border">{{ jarak.tahun_gapeka?.nama || '-' }}</td>
          <td class="p-2 border">{{ jarak.jarak || 0 }} km</td>
          <td class="p-2 border">{{ jarak.puncak_kecepatan || '-' }}</td>
          <td class="p-2 border">{{ jarak.taspat || '-' }}</td>
          <td class="p-2 border">{{ jarak.puncak_kecepatan_barang || '-' }}</td>
          <td class="p-2 border">
  <span v-if="jarak.status == 1" class="text-green-600 font-semibold">Aktif</span>
  <span v-else class="text-red-600 font-semibold">Nonaktif</span>
</td>

          <td class="p-2 border">{{ jarak.created_at || '-' }}</td>
          <td class="p-2 border">{{ jarak.created_by || '-' }}</td>
          <td class="p-2 border">{{ jarak.updated_at || '-' }}</td>
          <td class="p-2 border">{{ jarak.updated_by || '-' }}</td>
          <td class="p-2 border">{{ jarak.approved_at || '-' }}</td>
          <td class="p-2 border">{{ jarak.approved_by || '-' }}</td>
          <td class="p-2 border space-x-1">
            <Link :href="`/jarak/${jarak.id}/show`" class="text-blue-600 hover:underline">Lihat</Link>
            <Link :href="`/jarak/${jarak.id}/edit`" class="text-yellow-600 hover:underline">Edit</Link>
            <button
              @click="hapus(jarak.id)"
              class="text-red-600 hover:underline"
            >
              Hapus
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="mt-4">
      <Pagination :links="jaraks.links" />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
  jaraks: Object,
  daops: Array,
  stasiuns: Array,
  filters: Object,
})

const search = ref(props.filters.search || '')
const selectedDaop = ref(props.filters.daop || '')
const selectedStatus = ref(props.filters.status || '')

function applyFilters() {
  router.get('/jarak', {
    search: search.value,
    daop: selectedDaop.value,
    status: selectedStatus.value,
  }, {
    preserveState: true,
    replace: true
  })
}

function hapus(id) {
  if (confirm('Yakin ingin menghapus data ini?')) {
    router.delete(`/jarak/${id}`)
  }
}
</script>
