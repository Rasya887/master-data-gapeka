<template>
  <Head title="Tambah User" />

  <div class="app-container">
    <div class="main-container">
      <div class="page-header">
        <h1 class="page-title">Tambah User</h1>
        <div class="decorative-line"></div>
      </div>

      <div class="data-card">
        <div class="card-header">
          <div class="header-info">
            <div class="header-icon">👤</div>
            <div>
              <h2 class="header-title">Formulir Tambah User</h2>
              <p class="header-subtitle">Tambah pengguna baru ke sistem</p>
            </div>
          </div>
        </div>

        <div class="form-container">
          <form @submit.prevent="submit" class="space-y-6">
            <div class="form-group">
              <label class="form-label">Nama:</label>
              <input v-model="form.name" type="text" class="form-input" />
              <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
            </div>

            <div class="form-group">
              <label class="form-label">Email:</label>
              <input v-model="form.email" type="email" class="form-input" />
              <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
            </div>

            <div class="form-group">
              <label class="form-label">Password:</label>
              <input v-model="form.password" type="password" class="form-input" />
              <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
            </div>

            <div class="form-group">
              <label class="form-label">Role:</label>
              <select v-model="form.role" class="form-select">
                <option value="">-- Pilih Role --</option>
                <option v-for="role in roles" :key="role.id" :value="role.id.toString()">
                  {{ role.name }}
                </option>
              </select>
              <div v-if="form.errors.role" class="text-red-500 text-sm mt-1">{{ form.errors.role }}</div>
            </div>

            <div class="mt-6 flex space-x-4">
              <button type="submit" :disabled="form.processing" class="btn-primary">
                Simpan
              </button>
              <Link href="/users" class="btn-primary bg-gray-500 hover:bg-gray-600">
                Batal
              </Link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link, Head } from '@inertiajs/vue3'

const props = defineProps({
  roles: Array,
  errors: Object
})

const form = useForm({
  name: '',
  email: '',
  password: '',
  role: '',
})

function submit() {
  form.post('/users', {
    onSuccess: () => alert('✅ Data user berhasil disimpan.'),
    onError: (errors) => {
      console.error('Gagal menyimpan data:', errors)
      const allErrors = Object.values(errors).flat().join('\n')
      alert('❌ Gagal menyimpan data:\n' + allErrors)
    },
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
  height: 48px;
  box-sizing: border-box;
}

.form-input:focus,
.form-select:focus {
  outline: none;
  border-color: #FF6B35;
  box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
}

.form-select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%231E3A8A' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 1.5em;
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

.btn-primary:disabled {
  background: #E2E8F0;
  color: #6B7280;
  cursor: not-allowed;
  box-shadow: none;
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

  .form-input,
  .form-select {
    font-size: 0.9rem;
  }

  .btn-primary {
    width: 100%;
    justify-content: center;
  }

  .form-group {
    gap: 6px;
  }
}
</style>