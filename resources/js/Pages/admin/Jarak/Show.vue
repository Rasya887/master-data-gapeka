<template>
  <Head title="Detail Data Jarak" />

  <div class="app-container">
    <div class="main-container">
      <div class="page-header">
        <h1 class="page-title">Detail Data Jarak</h1>
        <div class="decorative-line"></div>
      </div>

      <div class="data-card">
        <div class="card-header">
          <div class="header-info">
            <div class="header-icon">📏</div>
            <div>
              <h2 class="header-title">Informasi Jarak</h2>
              <p class="header-subtitle">Detail data jarak antar stasiun</p>
            </div>
          </div>
        </div>

        <div class="form-container">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group">
              <strong class="form-label">Daop:</strong>
              <span class="form-text">{{ jarak.daop?.nama ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Stasiun:</strong>
              <span class="form-text">{{ jarak.stasiun?.nama ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Stasiun Sebelah:</strong>
              <span class="form-text">{{ jarak.stasiun_sebelah?.nama ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Lintas:</strong>
              <span class="form-text">{{ jarak.lintas?.nama ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Tahun Gapeka:</strong>
              <span class="form-text">{{ jarak.tahun_gapeka?.nama ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Jarak (km):</strong>
              <span class="form-text">{{ jarak.jarak ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Puncak Kecepatan:</strong>
              <span class="form-text">{{ jarak.puncak_kecepatan ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Taspat:</strong>
              <span class="form-text">{{ jarak.taspat ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Kec. Barang:</strong>
              <span class="form-text">{{ jarak.puncak_kecepatan_barang ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Status:</strong>
              <span class="form-text" :class="jarak.status === 1 ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'">
                {{ jarak.status === 1 ? 'Aktif' : 'Nonaktif' }}
              </span>
            </div>
            <div class="form-group">
              <strong class="form-label">Created At:</strong>
              <span class="form-text">{{ formatDate(jarak.created_at) ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Created By:</strong>
              <span class="form-text">{{ jarak.created_by ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Updated At:</strong>
              <span class="form-text">{{ formatDate(jarak.updated_at) ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Updated By:</strong>
              <span class="form-text">{{ jarak.updated_by ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Approved At:</strong>
              <span class="form-text">{{ formatDate(jarak.approved_at) ?? '-' }}</span>
            </div>
            <div class="form-group">
              <strong class="form-label">Approved By:</strong>
              <span class="form-text">{{ jarak.approved_by ?? '-' }}</span>
            </div>
          </div>

          <div class="mt-6">
            <Link href="/jarak" class="btn-primary">
              ← Kembali ke Daftar Jarak
            </Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/vue3'

const props = defineProps({
  jarak: Object,
})

function formatDate(date) {
  if (!date) return null
  const d = new Date(date)
  return d.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' })
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

.form-text {
  font-size: 1rem;
  color: #1E3A8A;
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

  .form-label,
  .form-text {
    font-size: 0.9rem;
  }

  .btn-primary {
    width: 100%;
    justify-content: center;
  }

  .grid {
    grid-template-columns: 1fr;
  }
}
</style>