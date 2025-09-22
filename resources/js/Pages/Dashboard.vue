<template>
  <div class="dashboard relative w-full min-h-screen flex flex-col">
    <!-- Wallpaper -->
    <div class="wallpaper"></div>

    <div class="content-wrapper flex-1 flex flex-col">
      <!-- Header -->
      <div class="header flex-shrink-0 px-4 md:px-6 lg:px-8 py-4 md:py-6">
        <h1 class="dashboard-title">Dashboard Stasiun & Jarak</h1>
        <div class="header-divider"></div>
        <p class="dashboard-subtitle">Visualisasi data distribusi stasiun dan jarak per Daop / Divre</p>
      </div>

      <!-- Main Content - Fixed Height -->
      <div class="main-content flex-1 flex flex-col lg:flex-row gap-4 md:gap-6 px-4 md:px-6 lg:px-8 pb-4 md:pb-6">
        
        <!-- Left Column - Stats -->
        <div class="stats-section lg:w-1/3 flex-shrink-0">
          <div class="stats-grid">
            <!-- Total Stasiun -->
            <div class="stat-card" data-type="stations">
              <div class="stat-icon-wrapper">
                <div class="stat-icon">
                  <svg class="stat-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-6 0h6"/>
                  </svg>
                </div>
              </div>
              <div class="stat-content">
                <p class="stat-label">Total Stasiun</p>
                <div class="stat-number-wrapper">
                  <span class="stat-number">{{ formatNumber(totalStasiun) }}</span>
                </div>
                <p class="stat-unit">{{ stasiunPerDaop.length }} Daop / Divre</p>
              </div>
            </div>
            
            <!-- Total Jarak -->
            <div class="stat-card" data-type="distance">
              <div class="stat-icon-wrapper">
                <div class="stat-icon">
                  <svg class="stat-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
              </div>
              <div class="stat-content">
                <p class="stat-label">Total Jarak</p>
                <div class="stat-number-wrapper">
                  <span class="stat-number">{{ formatNumber(totalJarak) }}</span>
                </div>
                <p class="stat-unit">{{ jarakPerDaop.length }} Daop / Divre</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column - Charts -->
        <div class="charts-section flex-1 flex flex-col gap-2 md:gap-3">
          <!-- Pie Charts Row - 50% HEIGHT -->
          <div class="mini-pies-section" style="flex: 1;">
            <!-- COMBINED PIE + LEGEND CARD - STASIUN -->
            <div class="pie-legend-card" data-type="stations">
              <div class="pie-legend-header">
                <div class="chart-indicator bg-blue-500"></div>
                <h3 class="pie-legend-title">Stasiun per Daop / Divre</h3>
                <p class="pie-legend-subtitle">{{ formatNumber(totalStasiun) }} Stasiun</p>
              </div>
              
              <div class="pie-legend-content">
                <!-- Pie Chart -->
                <div class="pie-chart-container relative">
                  <!-- Loading State -->
                  <div v-if="loading" class="loading-overlay absolute inset-0 flex items-center justify-center bg-white/90">
                    <div class="animate-spin rounded-full h-8 w-8 border-2 border-blue-200 border-t-blue-500"></div>
                  </div>
                  
                  <!-- Empty State -->
                  <div v-else-if="totalStasiun === 0" class="empty-state absolute inset-0 flex items-center justify-center bg-white">
                    <div class="w-6 h-6 bg-gray-200 rounded-full"></div>
                  </div>
                  
                  <!-- Pie Chart -->
                  <div v-else class="pie-wrapper">
                    <Pie :data="stasiunPieData" :options="pieOptions" />
                  </div>
                </div>
                
                <!-- Legend -->
                <div class="pie-legend-container">
                  <div v-if="stasiunPieData.labels.length === 0" class="empty-legend">
                    <p class="text-sm text-gray-500">Tidak ada data stasiun</p>
                  </div>
                  <div v-else class="legend-grid">
                    <div 
                      v-for="(item, index) in stasiunPieData.labels" 
                      :key="`stasiun-${index}`" 
                      class="legend-item"
                    >
                      <div class="legend-color" :style="{ backgroundColor: stasiunPieData.datasets[0].backgroundColor[index] }"></div>
                      <div class="legend-info">
                        <span class="legend-label">{{ item }}</span>
                        <span class="legend-value">{{ formatNumber(stasiunPieData.datasets[0].data[index]) }}</span>
                        <span class="legend-percentage">{{ calculatePercentage(stasiunPieData.datasets[0].data[index], totalStasiun) }}%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- COMBINED PIE + LEGEND CARD - JARAK -->
            <div class="pie-legend-card" data-type="distance">
              <div class="pie-legend-header">
                <div class="chart-indicator bg-green-500"></div>
                <h3 class="pie-legend-title">Jarak per Daop / Divre</h3>
                <p class="pie-legend-subtitle">{{ formatNumber(totalJarak) }} KM</p>
              </div>
              
              <div class="pie-legend-content">
                <!-- Pie Chart -->
                <div class="pie-chart-container relative">
                  <!-- Loading State -->
                  <div v-if="loading" class="loading-overlay absolute inset-0 flex items-center justify-center bg-white/90">
                    <div class="animate-spin rounded-full h-8 w-8 border-2 border-green-200 border-t-green-500"></div>
                  </div>
                  
                  <!-- Empty State -->
                  <div v-else-if="totalJarak === 0" class="empty-state absolute inset-0 flex items-center justify-center bg-white">
                    <div class="w-6 h-6 bg-gray-200 rounded-full"></div>
                  </div>
                  
                  <!-- Pie Chart -->
                  <div v-else class="pie-wrapper">
                    <Pie :data="jarakPieData" :options="pieOptions" />
                  </div>
                </div>
                
                <!-- Legend -->
                <div class="pie-legend-container">
                  <div v-if="jarakPieData.labels.length === 0" class="empty-legend">
                    <p class="text-sm text-gray-500">Tidak ada data jarak</p>
                  </div>
                  <div v-else class="legend-grid">
                    <div 
                      v-for="(item, index) in jarakPieData.labels" 
                      :key="`jarak-${index}`" 
                      class="legend-item"
                    >
                      <div class="legend-color" :style="{ backgroundColor: jarakPieData.datasets[0].backgroundColor[index] }"></div>
                      <div class="legend-info">
                        <span class="legend-label">{{ item }}</span>
                        <span class="legend-value">{{ formatNumber(jarakPieData.datasets[0].data[index]) }} KM</span>
                        <span class="legend-percentage">{{ calculatePercentage(jarakPieData.datasets[0].data[index], totalJarak) }}%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Comprehensive Bar Chart - 50% HEIGHT -->
          <div class="comprehensive-chart-card" style="flex: 1;" data-type="comprehensive">
            <div class="chart-header">
              <div class="chart-title-wrapper">
                <div class="chart-indicator bg-indigo-500"></div>
                <h2 class="chart-title">Analisis Komprehensif: Distribusi Stasiun & Jarak per Daop / Divre</h2>
              </div>
              <div class="chart-legend">
                <span class="legend-item">
                  <div class="legend-color bg-blue-500"></div>
                  <span class="legend-text">Stasiun ({{ formatNumber(totalStasiun) }})</span>
                </span>
                <span class="legend-item">
                  <div class="legend-color bg-green-500"></div>
                  <span class="legend-text">Jarak ({{ formatNumber(totalJarak) }} KM)</span>
                </span>
              </div>
            </div>
            <div class="chart-container relative">
              <!-- Loading State -->
              <div v-if="loading" class="loading-overlay absolute inset-0 flex items-center justify-center bg-white/90">
                <div class="animate-spin rounded-full h-5 w-5 border-2 border-indigo-200 border-t-indigo-500"></div>
              </div>
              
              <!-- Empty State -->
              <div v-else-if="totalStasiun === 0 && totalJarak === 0" class="empty-state absolute inset-0 flex flex-col items-center justify-center text-center bg-white">
                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mb-2">
                  <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                  </svg>
                </div>
                <h3 class="text-xs font-medium text-gray-700 mb-1">Belum ada data</h3>
                <p class="text-xs text-gray-500">Silakan tambahkan data stasiun dan jarak per Daop / Divre terlebih dahulu</p>
              </div>
              
              <!-- Comprehensive Bar Chart -->
              <Bar v-else :data="comprehensiveChartData" :options="comprehensiveChartOptions" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue'
import { 
  Chart as ChartJS, 
  Title, 
  Tooltip, 
  Legend, 
  ArcElement, 
  BarElement, 
  CategoryScale, 
  LinearScale 
} from 'chart.js'
import { Bar, Pie } from 'vue-chartjs'

// Register Chart.js components
ChartJS.register(Title, Tooltip, Legend, ArcElement, BarElement, CategoryScale, LinearScale)

// Props dari Inertia
const props = defineProps({
  stasiunPerDaop: { 
    type: Array, 
    default: () => [] 
  },
  jarakPerDaop: { 
    type: Array, 
    default: () => [] 
  }
})

// Reactive state
const loading = ref(true)

// Computed properties
const totalStasiun = computed(() =>
  props.stasiunPerDaop.reduce((sum, item) => sum + (item.total || 0), 0)
)

const totalJarak = computed(() =>
  props.jarakPerDaop.reduce((sum, item) => sum + (item.total || 0), 0)
)

// Format number dengan pemisah ribuan
const formatNumber = (num) => {
  if (num === null || num === undefined) return '0'
  return new Intl.NumberFormat('id-ID').format(Math.round(num))
}

// Calculate percentage
const calculatePercentage = (value, total) => {
  if (total === 0) return 0
  return Math.round((value / total) * 100)
}

// Mini Pie Chart Data - Stasiun
const stasiunPieData = computed(() => {
  const hasData = props.stasiunPerDaop.some(item => (item.total || 0) > 0)
  
  if (!hasData) {
    return {
      labels: [],
      datasets: [{
        data: [1],
        backgroundColor: ['#e5e7eb']
      }]
    }
  }

  const filteredData = props.stasiunPerDaop
    .filter(item => (item.total || 0) > 0)
    .slice(0, 6)

  return {
    labels: filteredData.map(item => `Daop / Divre ${item.id_daop}`),
    datasets: [{
      data: filteredData.map(item => item.total),
      backgroundColor: [
        '#3B82F6', '#8B5CF6', '#EC4899', '#F59E0B', 
        '#10B981', '#06B6D4'
      ],
      borderWidth: 0,
      hoverOffset: 4
    }]
  }
})

// Mini Pie Chart Data - Jarak
const jarakPieData = computed(() => {
  const hasData = props.jarakPerDaop.some(item => (item.total || 0) > 0)
  
  if (!hasData) {
    return {
      labels: [],
      datasets: [{
        data: [1],
        backgroundColor: ['#e5e7eb']
      }]
    }
  }

  const filteredData = props.jarakPerDaop
    .filter(item => (item.total || 0) > 0)
    .slice(0, 6)

  return {
    labels: filteredData.map(item => `Daop / Divre ${item.id_daop}`),
    datasets: [{
      data: filteredData.map(item => item.total),
      backgroundColor: [
        '#3B82F6', '#8B5CF6', '#EC4899', '#F59E0B', 
        '#10B981', '#06B6D4'
      ],
      borderWidth: 0,
      hoverOffset: 4
    }]
  }
})

// Comprehensive Chart Data - Combined Analysis
const comprehensiveChartData = computed(() => {
  const hasData = props.stasiunPerDaop.some(item => (item.total || 0) > 0) || 
                  props.jarakPerDaop.some(item => (item.total || 0) > 0)
  
  if (!hasData) {
    return {
      labels: [],
      datasets: []
    }
  }

  const labels = props.stasiunPerDaop.map(item => `Daop / Divre ${item.id_daop}`)
  
  return {
    labels,
    datasets: [
      {
        label: 'Stasiun',
        data: props.stasiunPerDaop.map(item => item.total || 0),
        backgroundColor: [
          'rgba(59, 130, 246, 0.9)', 'rgba(59, 130, 246, 0.8)', 
          'rgba(59, 130, 246, 0.7)', 'rgba(59, 130, 246, 0.6)',
          'rgba(59, 130, 246, 0.5)', 'rgba(59, 130, 246, 0.4)',
          'rgba(59, 130, 246, 0.3)', 'rgba(59, 130, 246, 0.2)'
        ],
        borderColor: '#3B82F6',
        borderWidth: 1,
        borderRadius: 3,
        borderSkipped: false,
        yAxisID: 'y',
        order: 2
      },
      {
        label: 'Jarak (KM)',
        data: props.jarakPerDaop.map(item => item.total || 0),
        backgroundColor: [
          'rgba(34, 197, 94, 0.9)', 'rgba(34, 197, 94, 0.8)', 
          'rgba(34, 197, 94, 0.7)', 'rgba(34, 197, 94, 0.6)',
          'rgba(34, 197, 94, 0.5)', 'rgba(34, 197, 94, 0.4)',
          'rgba(34, 197, 94, 0.3)', 'rgba(34, 197, 94, 0.2)'
        ],
        borderColor: '#22C55E',
        borderWidth: 1,
        borderRadius: 3,
        borderSkipped: false,
        yAxisID: 'y1',
        order: 1
      }
    ]
  }
})

// Comprehensive Chart Options
const comprehensiveChartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  layout: {
    padding: {
      top: 8,
      bottom: 8,
      left: 4,
      right: 4
    }
  },
  plugins: {
    legend: {
      display: true,
      position: 'top',
      align: 'center',
      labels: {
        font: {
          size: 9,
          family: 'Inter, -apple-system, BlinkMacSystemFont, sans-serif',
          weight: '500'
        },
        color: '#374151',
        padding: 8,
        usePointStyle: true,
        pointStyle: 'rectRounded',
        boxWidth: 5,
        boxHeight: 3,
        generateLabels: function(chart) {
          const original = ChartJS.defaults.plugins.legend.labels.generateLabels
          const labels = original.call(this, chart)
          labels.forEach((label) => {
            if (label.text.includes('Stasiun')) {
              label.text = `${label.text} • Total: ${formatNumber(totalStasiun)} stasiun`
            } else {
              label.text = `${label.text} • Total: ${formatNumber(totalJarak)} KM`
            }
          })
          return labels
        }
      }
    },
    tooltip: { 
      enabled: true,
      backgroundColor: 'rgba(255, 255, 255, 0.98)',
      titleColor: '#1F2937',
      bodyColor: '#6B7280',
      borderColor: '#E5E7EB',
      borderWidth: 1,
      cornerRadius: 6,
      padding: 8,
      displayColors: true,
      titleFont: {
        size: 11,
        weight: '600'
      },
      bodyFont: {
        size: 10,
        weight: '500'
      },
      callbacks: {
        title: function(context) {
          return `Daerah Operasi / Divre ${context[0].label.replace('Daop / Divre ', '')}`;
        },
        label: function(context) {
          const daopIndex = context.dataIndex
          const stasiunValue = props.stasiunPerDaop[daopIndex]?.total || 0
          const jarakValue = props.jarakPerDaop[daopIndex]?.total || 0
          
          if (context.datasetIndex === 0) {
            return [
              `📍 ${context.dataset.label}: ${formatNumber(context.parsed.y)} stasiun`,
              `📏 Jarak: ${formatNumber(jarakValue)} KM`,
              `📊 Persentase Stasiun: ${calculatePercentage(stasiunValue, totalStasiun)}%`,
              `📊 Persentase Jarak: ${calculatePercentage(jarakValue, totalJarak)}%`
            ]
          } else {
            return [
              `📏 ${context.dataset.label}: ${formatNumber(context.parsed.y)} KM`,
              `📍 Stasiun: ${formatNumber(stasiunValue)} stasiun`,
              `📊 Persentase Jarak: ${calculatePercentage(jarakValue, totalJarak)}%`,
              `📊 Persentase Stasiun: ${calculatePercentage(stasiunValue, totalStasiun)}%`
            ]
          }
        },
        afterBody: function(context) {
          const daopIndex = context[0].dataIndex
          const daopName = props.stasiunPerDaop[daopIndex]?.nama_daop || `Daop / Divre ${context[0].label.replace('Daop / Divre ', '')}`
          return `\n📋 ${daopName}`
        }
      }
    },
  },
  scales: {
    x: {
      grid: {
        display: false,
        drawBorder: false
      },
      ticks: {
        color: '#9CA3AF',
        font: {
          size: 8,
          family: 'Inter, -apple-system, BlinkMacSystemFont, sans-serif',
          weight: '500'
        },
        padding: 4,
        maxRotation: 45,
        maxTicksLimit: 8
      },
      border: {
        display: false
      }
    },
    y: {
      type: 'linear',
      display: true,
      position: 'left',
      beginAtZero: true,
      title: {
        display: true,
        text: 'Stasiun',
        color: '#3B82F6',
        font: {
          size: 9,
          weight: '500',
          family: 'Inter, -apple-system, BlinkMacSystemFont, sans-serif'
        }
      },
      grid: {
        color: '#F3F4F6',
        drawBorder: false,
        lineWidth: 1,
        drawOnChartArea: true
      },
      ticks: {
        color: '#3B82F6',
        font: {
          size: 8,
          family: 'Inter, -apple-system, BlinkMacSystemFont, sans-serif',
          weight: '500'
        },
        padding: 4,
        callback: function(value) {
          return formatNumber(value);
        },
        maxTicksLimit: 4
      },
      border: {
        display: false
      }
    },
    y1: {
      type: 'linear',
      display: true,
      position: 'right',
      beginAtZero: true,
      title: {
        display: true,
        text: 'KM',
        color: '#22C55E',
        font: {
          size: 9,
          weight: '500',
          family: 'Inter, -apple-system, BlinkMacSystemFont, sans-serif'
        }
      },
      grid: {
        drawOnChartArea: false,
      },
      ticks: {
        color: '#22C55E',
        font: {
          size: 8,
          family: 'Inter, -apple-system, BlinkMacSystemFont, sans-serif',
          weight: '500'
        },
        padding: 4,
        callback: function(value) {
          return formatNumber(value);
        },
        maxTicksLimit: 4
      },
      border: {
        display: false
      }
    }
  },
  animation: {
    duration: 800,
    easing: 'easeOutQuart',
    delay: 100
  },
  interaction: {
    intersect: false,
    mode: 'index'
  },
  barPercentage: 0.6,
  categoryPercentage: 0.7,
  elements: {
    bar: {
      borderSkipped: false,
      borderRadius: 2
    }
  }
}

// Mini Pie Chart Options - PIE LEBIH BESAR
const pieOptions = {
  responsive: true,
  maintainAspectRatio: true,
  plugins: {
    legend: {
      display: false
    },
    tooltip: {
      enabled: false
    }
  },
  animation: {
    animateRotate: true,
    duration: 1000,
    easing: 'easeOutQuart'
  },
  cutout: '40%', // LEBIH KECIL CENTER HOLE - PIE LEBIH BESAR
  elements: {
    arc: {
      borderWidth: 0
    }
  },
  layout: {
    padding: {
      left: 0,
      right: 0,
      top: 0,
      bottom: 0
    }
  },
  aspectRatio: 1,
  devicePixelRatio: 2
}

// Lifecycle
onMounted(() => {
  setTimeout(() => {
    loading.value = false
  }, 800)
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

* {
  box-sizing: border-box;
}

.dashboard {
  position: relative;
  height: 100vh;
  background: linear-gradient(135deg, 
    #f8fafc 0%, 
    #f1f5f9 25%, 
    #e2e8f0 50%, 
    #cbd5e1 75%, 
    #94a3b8 100%);
  overflow: hidden;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

.content-wrapper {
  position: relative;
  z-index: 1;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  display: flex;
  flex-direction: column;
  height: 100vh;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.wallpaper {
  position: absolute;
  inset: 0;
  background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80');
  background-size: cover;
  background-position: center;
  opacity: 0.08;
  z-index: 0;
  filter: blur(2px);
}

/* Header - Clean White */
.header {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid #e2e8f0;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  position: relative;
  z-index: 2;
  flex-shrink: 0;
}

.dashboard-title {
  font-size: clamp(1.25rem, 3.5vw, 2rem);
  font-weight: 300;
  color: #1e293b;
  letter-spacing: -0.025em;
  line-height: 1.1;
  margin: 0 0 0.5rem 0;
}

.dashboard-subtitle {
  font-size: 0.8125rem;
  color: #64748b;
  margin: 0;
  line-height: 1.4;
  font-weight: 400;
  max-width: 24rem;
}

.header-divider {
  width: 40px;
  height: 2px;
  background: linear-gradient(90deg, 
    #3b82f6, 
    #22c55e, 
    #3b82f6);
  margin: 0.5rem auto 0;
  border-radius: 2px;
}

/* Main Content - Fixed Layout */
.main-content {
  flex: 1;
  display: flex;
  gap: 1.5rem;
  overflow: hidden;
  position: relative;
  z-index: 2;
}

/* Stats Section - White Minimalist */
.stats-section {
  display: flex;
  flex-direction: column;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 1rem;
  gap: 0.75rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  flex-shrink: 0;
}

.stats-grid {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  height: 100%;
}

.stat-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 0.875rem;
  transition: all 0.2s ease;
  position: relative;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  flex: 1;
  min-height: 0;
}

.stat-card:hover {
  background: #f1f5f9;
  border-color: #cbd5e1;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.stat-card[data-type="stations"] {
  border-left: 4px solid #3b82f6;
}

.stat-card[data-type="distance"] {
  border-left: 4px solid #22c55e;
}

.stat-icon-wrapper {
  flex-shrink: 0;
}

.stat-icon {
  width: 2rem;
  height: 2rem;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  background: #f1f5f9;
  border: 1px solid #e2e8f0;
}

.stat-icon:hover {
  transform: scale(1.05);
}

.stat-icon-svg {
  width: 0.75rem;
  height: 0.75rem;
  color: #475569;
}

.stat-content {
  flex: 1;
  text-align: left;
  overflow: hidden;
}

.stat-label {
  font-size: 0.6875rem;
  font-weight: 500;
  color: #64748b;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 0.25rem;
  line-height: 1.2;
}

.stat-number-wrapper {
  display: inline-block;
  margin-bottom: 0.125rem;
}

.stat-number {
  font-size: clamp(1.125rem, 3.5vw, 1.625rem);
  font-weight: 600;
  color: #1e293b;
  letter-spacing: -0.015em;
  line-height: 1;
}

.stat-unit {
  font-size: 0.625rem;
  font-weight: 400;
  color: #94a3b8;
  text-transform: uppercase;
  letter-spacing: 0.025em;
  margin: 0;
  line-height: 1;
}

/* Charts Section - 50:50 LAYOUT */
.charts-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  min-width: 0;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 1rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

/* Pie Charts Section - 50% HEIGHT */
.mini-pies-section {
  display: flex;
  gap: 1rem;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 1rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  flex: 1;
  min-height: 0;
  overflow: hidden;
}

/* COMBINED PIE + LEGEND CARD */
.pie-legend-card {
  flex: 1;
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 0.75rem;
  transition: all 0.2s ease;
  position: relative;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.pie-legend-card:hover {
  border-color: #cbd5e1;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.pie-legend-card[data-type="stations"] {
  border-left: 4px solid #3b82f6;
}

.pie-legend-card[data-type="distance"] {
  border-left: 4px solid #22c55e;
}

.pie-legend-header {
  margin-bottom: 0.75rem;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.pie-legend-title {
  font-size: 0.8125rem;
  font-weight: 600;
  color: #1e293b;
  margin: 0;
  line-height: 1.3;
  flex: 1;
}

.pie-legend-subtitle {
  font-size: 0.6875rem;
  color: #64748b;
  margin: 0;
  line-height: 1.3;
  font-weight: 500;
  text-align: right;
}

.chart-indicator {
  width: 0.375rem;
  height: 0.375rem;
  border-radius: 50%;
  flex-shrink: 0;
}

.pie-legend-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
  height: 100%;
}

/* PIE CHART CONTAINER */
.pie-chart-container {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  min-height: 0;
}

.pie-wrapper {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.pie-wrapper canvas {
  max-width: 95% !important;
  max-height: 95% !important;
  width: 95% !important;
  height: 95% !important;
}

/* LEGEND CONTAINER - DALAM CARD YANG SAMA */
.pie-legend-container {
  flex-shrink: 0;
  padding-top: 0.5rem;
}

.empty-legend {
  text-align: center;
  padding: 0.75rem;
  color: #94a3b8;
  font-size: 0.8125rem;
}

.legend-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 0.375rem;
  min-height: 4.5rem;
}

.legend-item {
  display: flex;
  align-items: flex-start;
  gap: 0.375rem;
  padding: 0.375rem;
  background: #ffffff;
  border-radius: 4px;
  border: 1px solid #f1f5f9;
  transition: all 0.2s ease;
  font-size: 0.6875rem;
  min-height: 2.25rem;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.legend-item:hover {
  background: #f8fafc;
  border-color: #e2e8f0;
  transform: translateY(-1px);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
}

.legend-color {
  width: 0.75rem;
  height: 0.75rem;
  border-radius: 3px;
  flex-shrink: 0;
  margin-top: 0.125rem;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.legend-info {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.125rem;
  min-width: 0;
}

.legend-label {
  font-size: 0.625rem;
  font-weight: 600;
  color: #374151;
  line-height: 1.1;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.legend-value {
  font-size: 0.5625rem;
  font-weight: 500;
  color: #6b7280;
  line-height: 1.1;
}

.legend-percentage {
  font-size: 0.5625rem;
  font-weight: 600;
  color: #3b82f6;
  line-height: 1.1;
}

/* Comprehensive Chart Card - 50% HEIGHT */
.comprehensive-chart-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.2s ease;
  position: relative;
  display: flex;
  flex-direction: column;
  flex: 1;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.comprehensive-chart-card:hover {
  border-color: #cbd5e1;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.chart-header {
  padding: 0.625rem 0.75rem 0.5rem;
  border-bottom: 1px solid #f1f5f9;
  flex-shrink: 0;
  background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.chart-title-wrapper {
  display: flex;
  align-items: center;
  gap: 0.375rem;
  margin-bottom: 0.375rem;
}

.chart-indicator {
  width: 0.375rem;
  height: 0.375rem;
  border-radius: 50%;
  flex-shrink: 0;
}

.chart-title {
  font-size: 0.8125rem;
  font-weight: 600;
  color: #1e293b;
  margin: 0;
  line-height: 1.2;
  letter-spacing: -0.01em;
}

.chart-legend {
  display: flex;
  gap: 1rem;
  margin-top: 0.25rem;
  flex-wrap: wrap;
}

.legend-item {
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.legend-color {
  width: 0.375rem;
  height: 0.375rem;
  border-radius: 50%;
  flex-shrink: 0;
}

.legend-text {
  font-size: 0.625rem;
  font-weight: 500;
  color: #64748b;
}

.chart-container {
  flex: 1;
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 0;
  position: relative;
  background: #fafbfc;
}

/* Loading & Empty States */
.loading-overlay {
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: inherit;
  z-index: 10;
  backdrop-filter: blur(4px);
}

.empty-state {
  position: absolute;
  inset: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #94a3b8;
  padding: 0.5rem;
}

.empty-state h3 {
  font-size: 0.6875rem;
  font-weight: 500;
  color: #64748b;
  margin-bottom: 0.375rem;
}

.empty-state p {
  font-size: 0.625rem;
  color: #94a3b8;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .main-content {
    flex-direction: column;
    gap: 1rem;
  }
  
  .stats-section {
    width: 100%;
    order: 2;
  }
  
  .charts-section {
    order: 1;
  }
  
  .stats-grid {
    flex-direction: row;
    justify-content: space-between;
    gap: 0.5rem;
  }
  
  .stat-card {
    flex: 1;
    max-width: calc(50% - 0.25rem);
    padding: 0.75rem;
  }
  
  .mini-pies-section {
    flex-direction: column;
    gap: 0.75rem;
    padding: 0.75rem;
  }
  
  .pie-legend-card {
    padding: 0.75rem;
  }
  
  .pie-wrapper canvas {
    max-width: 95% !important;
    max-height: 95% !important;
    width: 95% !important;
    height: 95% !important;
  }
  
  .legend-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 0.25rem;
  }
  
  .chart-container {
    padding: 0.375rem;
  }
}

@media (max-width: 768px) {
  .header {
    padding: 0.75rem 0.75rem 0.5rem;
  }
  
  .dashboard-title {
    font-size: 1.25rem;
  }
  
  .dashboard-subtitle {
    font-size: 0.75rem;
    max-width: 100%;
  }
  
  .stats-grid {
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .stat-card {
    max-width: 100%;
    padding: 0.75rem;
  }
  
  .stat-number {
    font-size: 1rem;
  }
  
  .main-content {
    padding: 0 0.5rem;
    gap: 0.75rem;
  }
  
  .charts-section {
    padding: 0.75rem;
    gap: 0.25rem;
  }
  
  .chart-title {
    font-size: 0.75rem;
  }
  
  .mini-pies-section {
    padding: 0.75rem;
    gap: 0.5rem;
  }
  
  .pie-legend-card {
    padding: 0.5rem;
  }
  
  .pie-legend-header {
    gap: 0.375rem;
  }
  
  .pie-legend-title {
    font-size: 0.75rem;
  }
  
  .pie-legend-subtitle {
    font-size: 0.625rem;
  }
  
  .pie-wrapper canvas {
    max-width: 95% !important;
    max-height: 95% !important;
    width: 95% !important;
    height: 95% !important;
  }
  
  .legend-grid {
    grid-template-columns: 1fr;
    gap: 0.25rem;
  }
  
  .chart-legend {
    gap: 0.75rem;
    justify-content: center;
  }
  
  .legend-text {
    font-size: 0.5625rem;
  }
  
  .comprehensive-chart-card .chart-header {
    padding: 0.5rem 0.625rem 0.375rem;
  }
  
  .comprehensive-chart-card .chart-container {
    padding: 0.375rem;
  }
}

@media (max-width: 480px) {
  .dashboard-title {
    font-size: 1.125rem;
  }
  
  .header-divider {
    width: 32px;
  }
  
  .stat-icon {
    width: 1.75rem;
    height: 1.75rem;
  }
  
  .stat-icon-svg {
    width: 0.6875rem;
    height: 0.6875rem;
  }
  
  .stat-number {
    font-size: 0.9375rem;
  }
  
  .chart-indicator {
    width: 0.3125rem;
    height: 0.3125rem;
  }
  
  .charts-section {
    padding: 0.5rem;
    gap: 0.25rem;
  }
  
  .pie-legend-card {
    padding: 0.5rem;
  }
  
  .pie-legend-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.25rem;
  }
  
  .pie-legend-title {
    font-size: 0.6875rem;
  }
  
  .pie-legend-subtitle {
    text-align: left;
    font-size: 0.625rem;
  }
  
  .pie-wrapper canvas {
    max-width: 95% !important;
    max-height: 95% !important;
    width: 95% !important;
    height: 95% !important;
  }
  
  .comprehensive-chart-card .chart-container {
    padding: 0.25rem;
  }
  
  .chart-title {
    font-size: 0.6875rem;
  }
  
  .chart-legend {
    flex-direction: column;
    gap: 0.25rem;
    align-items: center;
  }
  
  .legend-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.125rem;
    padding: 0.25rem;
  }
  
  .legend-info {
    width: 100%;
    gap: 0.0625rem;
  }
  
  .legend-grid {
    grid-template-columns: 1fr;
    gap: 0.125rem;
  }
}

/* FIXED HEIGHT - NO SCROLLING */
html, body {
  overflow: hidden;
  height: 100vh;
}

.chart-container ::v-deep canvas,
.pie-chart-container ::v-deep canvas,
.pie-wrapper ::v-deep canvas {
  max-height: 100%;
  width: 100% !important;
  height: 100% !important;
}

/* Custom scrollbar - Hidden for fixed layout */
::-webkit-scrollbar {
  display: none;
}

/* Loading Animation */
@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.animate-spin {
  animation: spin 1s linear infinite;
}

/* Subtle animations */
.stat-card,
.pie-legend-card,
.comprehensive-chart-card {
  transition: all 0.2s ease;
}

.stat-icon:hover {
  transform: scale(1.05);
}

.pie-legend-card:hover {
  transform: translateY(-1px);
}

.comprehensive-chart-card:hover {
  transform: translateY(-1px);
}

/* Focus states */
.stat-card:focus,
.pie-legend-card:focus,
.comprehensive-chart-card:focus {
  outline: 2px solid #3b82f6;
  outline-offset: 2px;
}
</style>