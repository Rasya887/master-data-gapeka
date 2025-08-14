<template>
  <Head title="Export Data" />

  <div class="app-container">
    <div class="main-container">
      <div class="page-header">
        <h1 class="page-title">Export Data</h1>
        <div class="decorative-line"></div>
      </div>

      <div class="flex flex-col items-center space-y-6">
        <!-- Export Daop -->
        <div class="data-card w-full max-w-md">
          <div class="card-header">
            <div class="header-info">
              <div class="header-icon">📊</div>
              <div>
                <h2 class="header-title">Export Daop</h2>
                <p class="header-subtitle">Unduh data Daop dalam format Excel atau PDF</p>
              </div>
            </div>
          </div>
          <div class="form-container">
            <div class="flex flex-col space-y-2">
              <a href="/export/daop/excel" class="btn-primary bg-green-600 hover:bg-green-700">
                Excel
              </a>
              <a href="/export/daop/pdf" class="btn-primary bg-red-600 hover:bg-red-700">
                PDF
              </a>
            </div>
          </div>
        </div>

        <!-- Export Stasiun -->
        <div class="data-card w-full max-w-md">
          <div class="card-header">
            <div class="header-info">
              <div class="header-icon">🚉</div>
              <div>
                <h2 class="header-title">Export Stasiun</h2>
                <p class="header-subtitle">Unduh data Stasiun dalam format Excel atau PDF</p>
              </div>
            </div>
          </div>
          <div class="form-container">
            <div class="flex flex-col space-y-2">
              <a href="/export/stasiun/excel" class="btn-primary bg-green-600 hover:bg-green-700">
                Excel
              </a>
              <a href="/export/stasiun/pdf" class="btn-primary bg-red-600 hover:bg-red-700">
                PDF
              </a>
            </div>
          </div>
        </div>

        <!-- Export Jarak -->
        <div class="data-card w-full max-w-md">
          <div class="card-header">
            <div class="header-info">
              <div class="header-icon">📏</div>
              <div>
                <h2 class="header-title">Export Jarak</h2>
                <p class="header-subtitle">Unduh data Jarak dalam format Excel atau PDF</p>
              </div>
            </div>
          </div>
          <div class="form-container">
            <div class="flex flex-col space-y-2">
              <a href="/export/jarak/excel" class="btn-primary bg-green-600 hover:bg-green-700">
                Excel
              </a>
              <a href="/export/jarak/pdf" class="btn-primary bg-red-600 hover:bg-red-700">
                PDF
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'
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
  max-height: calc(100vh - 120px);
  overflow-y: auto;
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
  padding: 20px 30px;
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
  padding: 20px 30px;
  background: linear-gradient(135deg, #F8FAFC 0%, rgba(59, 130, 246, 0.05) 100%);
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
  color: #FFFFFF;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.btn-primary.bg-green-600 {
  background: linear-gradient(135deg, #16A34A 0%, #22C55E 100%);
}

.btn-primary.bg-green-600:hover {
  background: linear-gradient(135deg, #15803D 0%, #16A34A 100%);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(22, 163, 74, 0.4);
}

.btn-primary.bg-red-600 {
  background: linear-gradient(135deg, #EF4444 0%, #F87171 100%);
}

.btn-primary.bg-red-600:hover {
  background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
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
    padding: 15px;
  }

  .btn-primary {
    width: 100%;
    justify-content: center;
  }
}
</style>