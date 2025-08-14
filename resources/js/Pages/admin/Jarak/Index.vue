<template>
  <Head title="Data Jarak" />

  <div class="app-container">
    <div class="main-container">
      <div class="page-header">
        <h1 class="page-title">Data Jarak</h1>
        <p class="page-subtitle">Kelola data jarak antar stasiun</p>
        <div class="decorative-line"></div>
      </div>

      <div class="data-card">
        <div class="card-header">
          <div class="header-info">
            <div class="header-icon">📏</div>
            <div>
              <h2 class="header-title">Tabel Data Jarak</h2>
              <p class="header-subtitle">Kelola data jarak antar stasiun</p>
            </div>
          </div>
          <div class="form-actions">
            <Link href="/jarak/create" class="btn-primary">
              + Tambah
            </Link>
          </div>
        </div>

        <div class="form-container">
          <div class="filter-container mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
              <div class="form-group">
                <label class="form-label">Cari Stasiun</label>
                <input
                  v-model="search"
                  @keyup.enter="applyFilters"
                  placeholder="Masukkan nama stasiun..."
                  class="form-input"
                />
              </div>
              <div class="form-group">
                <label class="form-label">Daop</label>
                <select v-model="selectedDaop" class="form-select">
                  <option value="">Semua Daop</option>
                  <option v-for="daop in daops" :key="daop.id" :value="daop.id">
                    {{ daop.nama }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Status</label>
                <select v-model="selectedStatus" class="form-select">
                  <option value="">Semua Status</option>
                  <option value="1">✅ Aktif</option>
                  <option value="0">❌ Nonaktif</option>
                </select>
              </div>
              <div class="form-group self-end">
                <button @click="applyFilters" class="btn-primary w-full">
                  Filter
                </button>
              </div>
            </div>
          </div>

          <div class="table-container">
            <table class="w-full text-sm text-left">
              <thead class="text-xs text-gray-700 uppercase">
                <tr>
                  <th class="p-3 border">#</th>
                  <th class="p-3 border">Daop</th>
                  <th class="p-3 border">Stasiun</th>
                  <th class="p-3 border">Stasiun Sebelah</th>
                  <th class="p-3 border">Lintas</th>
                  <th class="p-3 border">Tahun Gapeka</th>
                  <th class="p-3 border">Jarak (km)</th>
                  <th class="p-3 border">Puncak Kecepatan</th>
                  <th class="p-3 border">Taspat</th>
                  <th class="p-3 border">Kec. Barang</th>
                  <th class="p-3 border">Status</th>
                  <th class="p-3 border">Created At</th>
                  <th class="p-3 border">Created By</th>
                  <th class="p-3 border">Updated At</th>
                  <th class="p-3 border">Updated By</th>
                  <th class="p-3 border">Approved At</th>
                  <th class="p-3 border">Approved By</th>
                  <th class="p-3 border">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(jarak, index) in jaraks.data" :key="jarak.id" class="hover:bg-gray-50">
                  <td class="p-3 border">{{ index + 1 + (jaraks.current_page - 1) * jaraks.per_page }}</td>
                  <td class="p-3 border truncate max-w-xs">{{ jarak.daop?.nama || '-' }}</td>
                  <td class="p-3 border truncate max-w-xs">{{ jarak.stasiun?.nama || '-' }}</td>
                  <td class="p-3 border truncate max-w-xs">{{ jarak.stasiun_sebelah?.nama || '-' }}</td>
                  <td class="p-3 border truncate max-w-xs">{{ jarak.lintas?.nama || '-' }}</td>
                  <td class="p-3 border truncate">{{ jarak.tahun_gapeka?.nama || '-' }}</td>
                  <td class="p-3 border">{{ jarak.jarak || 0 }} km</td>
                  <td class="p-3 border truncate">{{ jarak.puncak_kecepatan || '-' }}</td>
                  <td class="p-3 border truncate">{{ jarak.taspat || '-' }}</td>
                  <td class="p-3 border truncate">{{ jarak.puncak_kecepatan_barang || '-' }}</td>
                  <td class="p-3 border">
                    <span :class="jarak.status == 1 ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'">
                      {{ jarak.status == 1 ? '✅ Aktif' : '❌ Nonaktif' }}
                    </span>
                  </td>
                  <td class="p-3 border truncate">{{ formatDate(jarak.created_at) || '-' }}</td>
                  <td class="p-3 border truncate">{{ jarak.created_by || '-' }}</td>
                  <td class="p-3 border truncate">{{ formatDate(jarak.updated_at) || '-' }}</td>
                  <td class="p-3 border truncate">{{ jarak.updated_by || '-' }}</td>
                  <td class="p-3 border truncate">{{ formatDate(jarak.approved_at) || '-' }}</td>
                  <td class="p-3 border truncate">{{ jarak.approved_by || '-' }}</td>
                  <td class="p-3 border flex space-x-2">
                    <Link :href="`/jarak/${jarak.id}/show`" class="btn-primary btn-sm">Lihat</Link>
                    <Link :href="`/jarak/${jarak.id}/edit`" class="btn-yellow btn-sm">Edit</Link>
                    <button @click="hapus(jarak.id)" class="btn-danger btn-sm">Hapus</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="form-actions">
            <div class="pagination-buttons">
              <button
                :disabled="!jaraks.prev_page_url"
                @click="goToPage(jaraks.current_page - 1)"
                class="pagination-btn"
                :class="{ 'pagination-btn-disabled': !jaraks.prev_page_url }"
              >
                ← Sebelumnya
              </button>
              <div class="current-page">
                Halaman {{ jaraks.current_page }}
              </div>
              <button
                :disabled="!jaraks.next_page_url"
                @click="goToPage(jaraks.current_page + 1)"
                class="pagination-btn"
                :class="{ 'pagination-btn-disabled': !jaraks.next_page_url }"
              >
                Selanjutnya →
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router, Link, Head } from '@inertiajs/vue3'

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

function formatDate(date) {
  if (!date) return null
  const d = new Date(date)
  return d.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' })
}

function goToPage(page) {
  router.get('/jarak', {
    page,
    search: search.value,
    daop: selectedDaop.value,
    status: selectedStatus.value,
  }, {
    preserveState: true,
    replace: true
  })
}
</script>

<style scoped>
.app-container {
  background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 50%, #FF6B35 100%);
  min-height: 100vh;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.main-container {
  padding: 40px 20px;
  min-height: 100vh;
}

.page-header {
  text-align: center;
  margin-bottom: 40px;
  position: relative;
}

.page-title {
  color: #FFFFFF;
  font-size: 3rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 3px;
  margin-bottom: 10px;
  text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
}

.page-subtitle {
  color: rgba(255, 255, 255, 0.9);
  font-size: 1.2rem;
  font-weight: 400;
  margin-bottom: 30px;
}

.decorative-line {
  width: 120px;
  height: 4px;
  background: linear-gradient(90deg, #FF6B35 0%, #FFFFFF 100%);
  margin: 20px auto;
  border-radius: 2px;
}

.data-card {
  background: #FFFFFF;
  border-radius: 25px;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
  overflow: hidden;
  max-width: 1400px;
  margin: 0 auto;
  position: relative;
  backdrop-filter: blur(10px);
}

.data-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 6px;
  background: linear-gradient(90deg, #FF6B35 0%, #1E3A8A 25%, #FF6B35 50%, #1E3A8A 75%, #FF6B35 100%);
}

.card-header {
  background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
  color: #FFFFFF;
  padding: 30px 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
}

.header-info {
  display: flex;
  align-items: center;
  gap: 15px;
}

.header-icon {
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, #FF6B35 0%, #FFFFFF 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
}

.header-title {
  font-size: 1.5rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin: 0;
}

.header-subtitle {
  margin: 0;
  opacity: 0.9;
  font-size: 0.9rem;
}

.form-container {
  padding: 30px 40px;
  background: linear-gradient(135deg, #F8FAFC 0%, rgba(59, 130, 246, 0.05) 100%);
}

.filter-container {
  margin-bottom: 30px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-label {
  font-size: 1rem;
  font-weight: 600;
  color: #1E3A8A;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.form-input,
.form-select {
  width: 100%;
  padding: 12px 20px;
  border: 2px solid #E2E8F0;
  border-radius: 10px;
  font-size: 1rem;
  color: #1E3A8A;
  background: #FFFFFF;
  transition: all 0.3s ease;
}

.form-input:focus,
.form-select:focus {
  outline: none;
  border-color: #FF6B35;
  box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
}

.form-select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%231E3A8A'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 1.5em;
}

.table-container {
  overflow-x: auto;
  border: 2px solid #E2E8F0;
  border-radius: 10px;
  background: #FFFFFF;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th,
td {
  border: 1px solid #E2E8F0;
  padding: 12px 20px;
  text-align: left;
  font-size: 0.9rem;
  color: #1E3A8A;
}

th {
  background: #F8FAFC;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

tr:hover {
  background: #F1F5F9;
}

.btn-primary,
.btn-yellow,
.btn-danger {
  padding: 12px 25px;
  border: none;
  border-radius: 20px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
  cursor: pointer;
  font-size: 0.9rem;
  min-width: 120px;
  justify-content: center;
}

.btn-primary {
  background: linear-gradient(135deg, #FF6B35 0%, #FF8A65 100%);
  color: #FFFFFF;
  box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
  text-decoration: none;
  color: #FFFFFF;
}

.btn-yellow {
  background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%);
  color: #FFFFFF;
  box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
}

.btn-yellow:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
  text-decoration: none;
  color: #FFFFFF;
}

.btn-danger {
  background: linear-gradient(135deg, #EF4444 0%, #F87171 100%);
  color: #FFFFFF;
  box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
  text-decoration: none;
  color: #FFFFFF;
}

.btn-sm {
  padding: 6px 12px;
  font-size: 0.8rem;
  min-width: 80px;
}

.pagination-buttons {
  display: flex;
  gap: 15px;
  align-items: center;
  justify-content: flex-end;
  flex-wrap: wrap;
}

.pagination-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 20px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  cursor: pointer;
  font-size: 0.9rem;
  min-width: 120px;
  background: linear-gradient(135deg, #FF6B35 0%, #FF8A65 100%);
  color: #FFFFFF;
  box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
}

.pagination-btn:hover:not(.pagination-btn-disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
}

.pagination-btn-disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
  box-shadow: none;
}

.current-page {
  font-size: 1rem;
  font-weight: 600;
  color: #1E3A8A;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  padding: 10px 20px;
  background: #F8FAFC;
  border: 2px solid #E2E8F0;
  border-radius: 10px;
}

.form-actions {
  display: flex;
  gap: 15px;
  margin-top: 30px;
  flex-wrap: wrap;
  justify-content: flex-end;
}

/* Responsive design */
@media (max-width: 768px) {
  .page-title {
    font-size: 2rem;
  }

  .card-header {
    flex-direction: column;
    text-align: center;
  }

  .form-container {
    padding: 20px;
  }

  .form-group {
    gap: 6px;
  }

  .form-input,
  .form-select {
    padding: 10px 15px;
    font-size: 0.9rem;
  }

  .filter-container .grid {
    grid-template-columns: 1fr;
  }

  .btn-primary,
  .btn-yellow,
  .btn-danger,
  .pagination-btn {
    width: 100%;
    max-width: 300px;
    padding: 10px 20px;
  }

  th,
  td {
    padding: 10px 15px;
    font-size: 0.85rem;
  }

  .form-actions {
    justify-content: center;
  }

  .pagination-buttons {
    justify-content: center;
    flex-direction: column;
    align-items: center;
  }

  .current-page {
    padding: 8px 16px;
    font-size: 0.9rem;
  }
}
</style>