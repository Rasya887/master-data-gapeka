<template>
  <Head title="Manajemen Role" />

  <div class="app-container">
    <div class="main-container">
      <div class="page-header">
        <h1 class="page-title">Manajemen Role</h1>
        <div class="decorative-line"></div>
      </div>

      <div class="data-card">
        <div class="card-header">
          <div class="header-info">
            <div class="header-icon">🔐</div>
            <div>
              <h2 class="header-title">Tabel Data Role</h2>
              <p class="header-subtitle">Kelola peran pengguna sistem</p>
            </div>
          </div>
          <Link href="/roles/create" class="btn-primary">
            + Tambah Role
          </Link>
        </div>

        <div class="form-container">
          <div class="table-container">
            <table class="w-full text-sm text-left">
              <thead class="bg-gray-100 text-xs text-gray-700 uppercase">
                <tr>
                  <th class="p-2 border w-12">#</th>
                  <th class="p-2 border">Nama</th>
                  <th class="p-2 border w-32">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(role, index) in roles" :key="role.id" class="hover:bg-gray-50">
                  <td class="p-2 border">{{ index + 1 }}</td>
                  <td class="p-2 border truncate">{{ role.name || '-' }}</td>
                  <td class="p-2 border space-x-2">
                    <Link :href="`/roles/${role.id}/edit`" class="btn-primary btn-sm bg-yellow-600 hover:bg-yellow-700">Edit</Link>
                    <button @click="hapus(role.id)" class="btn-danger-sm">Hapus</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router, Head } from '@inertiajs/vue3'

defineProps({
  roles: Array
})

function hapus(id) {
  if (confirm('Yakin ingin menghapus role ini?')) {
    router.delete(`/roles/${id}`)
  }
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

.table-container {
  overflow-x: auto;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th,
td {
  border: 1px solid #E2E8F0;
  padding: 8px;
  text-align: left;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

th {
  background: #F8FAFC;
  font-weight: 600;
  color: #1E3A8A;
  text-transform: uppercase;
}

tr:hover {
  background: #F1F5F9;
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

.btn-sm {
  padding: 6px 12px;
  font-size: 0.8rem;
  min-width: 80px;
}

.btn-danger-sm {
  padding: 6px 12px;
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

  .btn-primary,
  .btn-danger-sm {
    width: 100%;
    justify-content: center;
  }

  .space-x-2 > * + * {
    margin-top: 8px;
    margin-left: 0;
  }
}
</style>