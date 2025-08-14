<template>
  <div class="app-container">
    <div class="main-container">
      <div class="page-header">
        <h1 class="page-title">Data Stasiun</h1>
        <p class="page-subtitle">Kelola Data Stasiun</p>
        <div class="decorative-line"></div>
      </div>

      <div class="data-card">
        <!-- Header -->
        <div class="card-header">
          <div class="header-info">
            <div class="header-icon">📊</div>
            <div>
              <h2 class="header-title">Data Stasiun</h2>
              <p class="header-subtitle">Kelola Data Stasiun</p>
            </div>
          </div>
          
          <Link
            href="/stasiuns/create"
            class="btn-primary"
          >
            ➕ Tambah Stasiun
          </Link>
        </div>

        <!-- Filter Section -->
        <div class="search-filter-section">
          <div class="search-container">
            <div class="search-box">
              <input
                type="text"
                v-model="filterForm.search"
                @input="updateFilter"
                class="search-input"
                placeholder="🔍 Cari stasiun..."
              />
            </div>
            <select
              v-model="filterForm.daop"
              @change="updateFilter"
              class="form-select"
            >
              <option value="">🌍 Semua Daop</option>
              <option v-for="daop in props.daops" :key="daop.id" :value="daop.id">
                {{ daop.nama }}
              </option>
            </select>
            <select
              v-model="filterForm.aktif"
              @change="updateFilter"
              class="form-select"
            >
              <option value="">🌍 Semua Status</option>
              <option value="1">✅ Aktif</option>
              <option value="0">❌ Non Aktif</option>
            </select>
          </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <div class="table-scroll">
            <table class="data-table">
              <thead class="table-header">
                <tr>
                  <th class="table-th table-th-first">#</th>
                  <th class="table-th">Daop</th>
                  <th class="table-th">Singkatan</th>
                  <th class="table-th">Nama</th>
                  <th class="table-th">DPL</th>
                  <th class="table-th">Kode</th>
                  <th class="table-th">Status</th>
                  <th class="table-th">Kotak</th>
                  <th class="table-th">Garis Tipis</th>
                  <th class="table-th">Garis Tebal</th>
                  <th class="table-th">Perhentian</th>
                  <th class="table-th">Batas Daop</th>
                  <th class="table-th">Created</th>
                  <th class="table-th">Updated</th>
                  <th class="table-th">Created By</th>
                  <th class="table-th">Updated By</th>
                  <th class="table-th">Track</th>
                  <th class="table-th">PPKT</th>
                  <th class="table-th table-th-last">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(s, index) in stasiuns.data"
                  :key="s.id"
                  class="table-row"
                >
                  <td class="table-td table-td-first">
                    {{ (stasiuns.current_page - 1) * stasiuns.per_page + index + 1 }}
                  </td>
                  <td class="table-td">{{ s.daop?.nama || '-' }}</td>
                  <td class="table-td">{{ s.singkatan }}</td>
                  <td class="table-td table-td-name">{{ s.nama }}</td>
                  <td class="table-td">{{ s.dpl }}</td>
                  <td class="table-td">{{ s.kode }}</td>
                  <td class="table-td">
                    <span
                      v-if="s.aktif"
                      class="region-badge region-jawa"
                    >
                      ✅ Aktif
                    </span>
                    <span
                      v-else
                      class="region-badge region-sumatera"
                    >
                      ❌ Non Aktif
                    </span>
                  </td>
                  <td class="table-td">{{ s.kotak ? '✓' : '-' }}</td>
                  <td class="table-td">{{ s.garis_tipis ? '✓' : '-' }}</td>
                  <td class="table-td">{{ s.garis_tebal ? '✓' : '-' }}</td>
                  <td class="table-td">{{ s.perhentian ? '✓' : '-' }}</td>
                  <td class="table-td">{{ s.batas_daop ? '✓' : '-' }}</td>
                  <td class="table-td">{{ s.created_at }}</td>
                  <td class="table-td">{{ s.updated_at }}</td>
                  <td class="table-td">{{ s.created_by }}</td>
                  <td class="table-td">{{ s.updated_by }}</td>
                  <td class="table-td">{{ s.track }}</td>
                  <td class="table-td">{{ s.ppkt ? '✓' : '-' }}</td>
                  <td class="table-td table-td-last">
                    <div class="action-buttons">
                      <Link :href="`/stasiuns/${s.id}/show`" class="btn-info-sm">
                        👁️
                      </Link>
                      <Link :href="`/stasiuns/${s.id}/edit`" class="btn-warning-sm">
                        ✏️
                      </Link>
                      <button @click="destroy(s.id)" class="btn-danger-sm">
                        🗑️
                      </button>
                    </div>
                  </td>
                </tr>
                <tr v-if="stasiuns.data.length === 0">
                  <td colspan="19" class="empty-state">
                    <div class="empty-icon">📋</div>
                    <div class="empty-title">Tidak ada data ditemukan</div>
                    <div class="empty-message">Belum ada data Stasiun yang tersedia</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
          <div class="pagination-info">
            📈 Menampilkan <strong>{{ stasiuns.from }}</strong> - <strong>{{ stasiuns.to }}</strong> dari <strong>{{ stasiuns.total }}</strong> data
          </div>
          <div class="pagination-buttons">
            <button
              :disabled="!stasiuns.prev_page_url"
              @click="goToPage(stasiuns.current_page - 1)"
              class="pagination-btn"
              :class="{ 'pagination-btn-disabled': !stasiuns.prev_page_url }"
            >
              ← Sebelumnya
            </button>
            <div class="current-page">
              Halaman {{ stasiuns.current_page }}
            </div>
            <button
              :disabled="!stasiuns.next_page_url"
              @click="goToPage(stasiuns.current_page + 1)"
              class="pagination-btn"
              :class="{ 'pagination-btn-disabled': !stasiuns.next_page_url }"
            >
              Selanjutnya →
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router, usePage, Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

const page = usePage()
const props = defineProps({
  stasiuns: Object,
  daops: Array,
  filters: Object,
})

const filterForm = ref({
  search: props.filters.search || '',
  daop: props.filters.daop || '',
  aktif: props.filters.aktif || '',
})

const updateFilter = () => {
  router.get('/stasiuns', {
    search: filterForm.value.search,
    daop: filterForm.value.daop,
    aktif: filterForm.value.aktif,
  }, {
    preserveState: true,
    replace: true,
  })
}

const destroy = (id) => {
  if (confirm('⚠️ Apakah Anda yakin ingin menghapus data ini?\n\nData yang sudah dihapus tidak dapat dikembalikan.')) {
    router.delete(`/stasiuns/${id}`)
  }
}

const goToPage = (pageNumber) => {
  router.get('/stasiuns', {
    ...filterForm.value,
    page: pageNumber,
  })
}

onMounted(() => {
  const tableRows = document.querySelectorAll('.table-row');
  tableRows.forEach((row, index) => {
    row.style.opacity = '0';
    row.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
      row.style.transition = 'all 0.5s ease';
      row.style.opacity = '1';
      row.style.transform = 'translateY(0)';
    }, index * 100);
  });
})
</script>

<style>
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
  position: relative;
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

.btn-primary {
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

.search-filter-section {
  padding: 30px 40px;
  background: linear-gradient(135deg, #F8FAFC 0%, rgba(59, 130, 246, 0.05) 100%);
  border-bottom: 1px solid #E2E8F0;
}

.search-container {
  display: flex;
  gap: 20px;
  align-items: center;
  flex-wrap: wrap;
}

.search-box {
  flex: 1;
  min-width: 300px;
  position: relative;
}

.search-input, .form-select {
  width: 100%;
  padding: 12px 20px;
  border: 2px solid #E2E8F0;
  border-radius: 10px;
  font-size: 1rem;
  color: #1E3A8A;
  background: #FFFFFF;
  transition: all 0.3s ease;
}

.search-input:focus, .form-select:focus {
  outline: none;
  border-color: #FF6B35;
  box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
}

.form-select {
  min-width: 150px;
}

.table-responsive {
  background: #FFFFFF;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.table-scroll {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  max-width: 100%;
}

.data-table {
  margin-bottom: 0;
  width: 100%;
  min-width: 1600px; /* Ensure table is wide enough to trigger horizontal scroll */
  border-collapse: collapse;
}

.table-header {
  background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
  color: #FFFFFF;
}

.table-th {
  padding: 20px 15px;
  text-align: left;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 0.9rem;
  position: relative;
  white-space: nowrap;
  border: none;
}

.table-th-first {
  padding-left: 30px;
}

.table-th-last {
  padding-right: 30px;
  text-align: center;
}

.table-row {
  transition: all 0.3s ease;
  border-bottom: 1px solid #E2E8F0;
}

.table-row:hover {
  background: linear-gradient(135deg, #F8FAFC 0%, rgba(59, 130, 246, 0.05) 100%);
  transform: scale(1.002);
}

.table-row:nth-child(even) {
  background: rgba(248, 250, 252, 0.5);
}

.table-row:nth-child(even):hover {
  background: linear-gradient(135deg, #F8FAFC 0%, rgba(59, 130, 246, 0.05) 100%);
}

.table-td {
  padding: 15px;
  font-size: 1rem;
  color: #1E3A8A;
  vertical-align: middle;
  border: none;
  white-space: nowrap;
}

.table-td-first {
  padding-left: 30px;
  font-weight: 600;
  color: #FF6B35;
}

.table-td-last {
  padding-right: 30px;
  text-align: center;
}

.table-td-name {
  font-weight: 600;
  color: #1E40AF;
}

.region-badge {
  padding: 4px 12px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 0.85rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}

.region-jawa {
  background: linear-gradient(135deg, #10B981 0%, #34D399 100%);
  color: #FFFFFF;
}

.region-sumatera {
  background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%);
  color: #FFFFFF;
}

.action-buttons {
  display: flex;
  gap: 5px;
  justify-content: center;
  align-items: center;
}

.btn-info-sm, .btn-warning-sm, .btn-danger-sm {
  padding: 8px 16px;
  font-size: 0.8rem;
  min-width: 80px;
  border: none;
  border-radius: 15px;
  font-weight: 600;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  cursor: pointer;
}

.btn-info-sm {
  background: linear-gradient(135deg, #3B82F6 0%, #1E3A8A 100%);
  color: #FFFFFF;
  box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
}

.btn-info-sm:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
  text-decoration: none;
  color: #FFFFFF;
}

.btn-warning-sm {
  background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%);
  color: #FFFFFF;
  box-shadow: 0 3px 10px rgba(245, 158, 11, 0.3);
}

.btn-warning-sm:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
  text-decoration: none;
  color: #FFFFFF;
}

.btn-danger-sm {
  background: linear-gradient(135deg, #EF4444 0%, #F87171 100%);
  color: #FFFFFF;
  box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
}

.btn-danger-sm:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
  text-decoration: none;
  color: #FFFFFF;
}

.pagination-wrapper {
  padding: 30px 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
  background: #F8FAFC;
}

.pagination-info {
  color: #64748B;
  font-weight: 500;
}

.pagination-buttons {
  display: flex;
  gap: 10px;
  align-items: center;
}

.pagination-btn {
  padding: 10px 15px;
  border: 2px solid #E2E8F0;
  background: #FFFFFF;
  color: #1E3A8A;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 5px;
}

.pagination-btn:hover:not(.pagination-btn-disabled) {
  background: #1E3A8A;
  color: #FFFFFF;
  border-color: #1E3A8A;
  transform: translateY(-1px);
  text-decoration: none;
}

.pagination-btn-disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.current-page {
  background: #FF6B35;
  color: #FFFFFF;
  border-color: #FF6B35;
  font-weight: 700;
  padding: 10px 15px;
  border: 2px solid #FF6B35;
  border-radius: 10px;
}

.empty-state {
  text-align: center;
  padding: 60px 40px;
  color: #64748B;
}

.empty-icon {
  font-size: 4rem;
  margin-bottom: 20px;
  opacity: 0.5;
}

.empty-title {
  font-size: 1.5rem;
  font-weight: 600;
  margin-bottom: 10px;
}

.empty-message {
  font-size: 1rem;
  opacity: 0.8;
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
  
  .search-container {
    flex-direction: column;
  }
  
  .search-box {
    min-width: 100%;
  }
  
  .data-table {
    font-size: 0.8rem;
  }
  
  .table-th, .table-td {
    padding: 10px 8px;
  }
  
  .action-buttons {
    flex-direction: column;
    gap: 3px;
  }
  
  .btn-info-sm, .btn-warning-sm, .btn-danger-sm {
    min-width: 60px;
    padding: 6px 12px;
  }

  .pagination-wrapper {
    flex-direction: column;
    text-align: center;
  }
}
</style>