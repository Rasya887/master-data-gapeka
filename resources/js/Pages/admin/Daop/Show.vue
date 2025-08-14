<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const props = defineProps({
  daop: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <Head title="Detail Daop" />

  <div class="app-container">
    <div class="main-container">
      <div class="page-header">
        <h1 class="page-title">Detail Daop</h1>
        <p class="page-subtitle">Informasi Daerah Operasi</p>
        <div class="decorative-line"></div>
      </div>

      <div class="data-card">
        <div class="card-header">
          <div class="header-info">
            <div class="header-icon">📋</div>
            <div>
              <h2 class="header-title">Informasi Daop</h2>
              <p class="header-subtitle">Detail data Daerah Operasi</p>
            </div>
          </div>
          <Link :href="route('daops.index')" class="btn-primary">
            ⬅ Kembali ke Daftar
          </Link>
        </div>

        <div class="form-container">
          <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="form-group">
                <label class="form-label">Nama</label>
                <p class="form-input bg-gray-100">{{ daop.nama }}</p>
              </div>
              <div class="form-group">
                <label class="form-label">Singkatan</label>
                <p class="form-input bg-gray-100">{{ daop.singkatan }}</p>
              </div>
              <div class="form-group">
                <label class="form-label">Nomenklatur</label>
                <p class="form-input bg-gray-100">{{ daop.nomenklatur }}</p>
              </div>
              <div class="form-group">
                <label class="form-label">Daop</label>
                <p class="form-input bg-gray-100">{{ daop.daop }}</p>
              </div>
              <div class="form-group">
                <label class="form-label">Region</label>
                <p class="form-input bg-gray-100">{{ daop.id_region == 1 ? 'Jawa' : 'Sumatera' }}</p>
              </div>
              <div class="form-group">
                <label class="form-label">Bus Area</label>
                <p class="form-input bg-gray-100">{{ daop.bus_area }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

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

.form-input {
  width: 100%;
  padding: 12px 20px;
  border: 2px solid #E2E8F0;
  border-radius: 10px;
  font-size: 1rem;
  color: #1E3A8A;
  background: #FFFFFF;
  transition: all 0.3s ease;
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

  .form-input {
    font-size: 0.9rem;
  }

  .btn-primary {
    width: 100%;
    justify-content: center;
  }
}
</style>