<template>
  <div class="app-container">
    <div class="main-container">
      <div class="page-header">
        <h1 class="page-title">Tambah Stasiun</h1>
        <p class="page-subtitle">Formulir untuk menambahkan stasiun baru</p>
        <div class="decorative-line"></div>
      </div>

      <div class="data-card">
        <div class="card-header">
          <div class="header-info">
            <div class="header-icon">➕</div>
            <div>
              <h2 class="header-title">Tambah Stasiun</h2>
              <p class="header-subtitle">Lengkapi data stasiun di bawah ini</p>
            </div>
          </div>
        </div>

        <form @submit.prevent="submit" class="form-container">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
              <label class="form-label">Nama</label>
              <input
                v-model="form.nama"
                type="text"
                class="form-input"
                placeholder="Masukkan nama stasiun"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Singkatan</label>
              <input
                v-model="form.singkatan"
                type="text"
                class="form-input"
                placeholder="Masukkan singkatan stasiun"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Kode</label>
              <input
                v-model="form.kode"
                type="text"
                class="form-input"
                placeholder="Masukkan kode stasiun"
              />
            </div>
            <div class="form-group">
              <label class="form-label">DPL</label>
              <input
                v-model="form.dpl"
                type="number"
                class="form-input"
                placeholder="Masukkan DPL"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Daop</label>
              <select v-model="form.id_daop" class="form-select">
                <option value="">Pilih Daop</option>
                <option v-for="daop in daops" :key="daop.id" :value="daop.id">
                  {{ daop.nama }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Status Aktif</label>
              <select v-model="form.aktif" class="form-select">
                <option value="1">✅ Aktif</option>
                <option value="0">❌ Non Aktif</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Kotak</label>
              <input
                v-model="form.kotak"
                type="text"
                class="form-input"
                placeholder="Masukkan kotak"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Track</label>
              <input
                v-model="form.track"
                type="text"
                class="form-input"
                placeholder="Masukkan track"
              />
            </div>
            <div class="form-group">
              <label class="form-label">PPKT</label>
              <input
                v-model="form.ppkt"
                type="text"
                class="form-input"
                placeholder="Masukkan PPKT"
              />
            </div>
          </div>

          <div class="form-actions">
            <button
              type="submit"
              class="btn-primary"
            >
              💾 Simpan
            </button>
            <Link
              href="/stasiuns"
              class="btn-secondary"
            >
              ← Kembali
            </Link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
  daops: Array,
})

const form = useForm({
  nama: '',
  singkatan: '',
  kode: '',
  dpl: '',
  id_daop: '',
  aktif: 1,
  kotak: '',
  track: '',
  ppkt: '',
})

function submit() {
  form.post('/stasiuns')
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

.form-input, .form-select {
  width: 100%;
  padding: 12px 20px;
  border: 2px solid #E2E8F0;
  border-radius: 10px;
  font-size: 1rem;
  color: #1E3A8A;
  background: #FFFFFF;
  transition: all 0.3s ease;
}

.form-input:focus, .form-select:focus {
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

.form-actions {
  display: flex;
  gap: 15px;
  margin-top: 30px;
  flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
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

.btn-secondary {
  background: linear-gradient(135deg, #64748B 0%, #94A3B8 100%);
  color: #FFFFFF;
  box-shadow: 0 5px 15px rgba(100, 116, 139, 0.3);
}

.btn-secondary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(100, 116, 139, 0.4);
  text-decoration: none;
  color: #FFFFFF;
}

/* Responsive design */
@media (max-width: 768px) {
  .page-title {
    font-size: 2rem;
  }

  .form-container {
    padding: 20px;
  }

  .form-group {
    gap: 6px;
  }

  .form-input, .form-select {
    padding: 10px 15px;
    font-size: 0.9rem;
  }

  .form-actions {
    flex-direction: column;
    align-items: center;
  }

  .btn-primary, .btn-secondary {
    width: 100%;
    max-width: 300px;
    padding: 10px 20px;
  }
}
</style>