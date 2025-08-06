<script setup>
const props = defineProps({
  jarak: Object,
})
</script>

<template>
  <div class="p-6 space-y-4">
    <h1 class="text-2xl font-bold text-blue-900">Detail Data Jarak</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div><strong>Daop:</strong> {{ jarak.daop?.nama ?? '-' }}</div>
      <div><strong>Stasiun:</strong> {{ jarak.stasiun?.nama ?? '-' }}</div>
      <div><strong>Stasiun Sebelah:</strong> {{ jarak.stasiun_sebelah?.nama ?? '-' }}</div>
      <div><strong>Lintas:</strong> {{ jarak.lintas?.nama ?? '-' }}</div>
      <div><strong>Tahun Gapeka:</strong> {{ jarak.tahun_gapeka?.nama ?? '-' }}</div>
      <div><strong>Jarak (km):</strong> {{ jarak.jarak }}</div>
      <div><strong>Puncak Kecepatan:</strong> {{ jarak.puncak_kecepatan }}</div>
      <div><strong>Taspat:</strong> {{ jarak.taspat ?? '-' }}</div>
      <div><strong>Kec. Barang:</strong> {{ jarak.puncak_kecepatan_barang ?? '-' }}</div>
      <div><strong>Status:</strong> 
        <span v-if="jarak.status === 1">Aktif</span>
        <span v-else>Non Aktif</span>
      </div>
      <div><strong>Created At:</strong> {{ jarak.created_at }}</div>
      <div><strong>Created By:</strong> {{ jarak.created_by ?? '-' }}</div>
      <div><strong>Updated At:</strong> {{ jarak.updated_at }}</div>
      <div><strong>Updated By:</strong> {{ jarak.updated_by ?? '-' }}</div>
      <div><strong>Approved At:</strong> {{ jarak.approved_at ?? '-' }}</div>
      <div><strong>Approved By:</strong> {{ jarak.approved_by ?? '-' }}</div>
    </div>

    <div class="mt-6">
      <Link href="/jarak" class="text-blue-500 hover:underline">← Kembali ke daftar jarak</Link>
    </div>
  </div>
</template>
