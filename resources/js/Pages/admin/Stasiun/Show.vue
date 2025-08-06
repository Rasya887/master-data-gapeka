<template>
  <div>
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Detail Stasiun</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div><strong>Nama:</strong> {{ stasiun.nama }}</div>
      <div><strong>Singkatan:</strong> {{ stasiun.singkatan }}</div>
      <div><strong>Kode:</strong> {{ stasiun.kode }}</div>
      <div><strong>DPL:</strong> {{ stasiun.dpl }}</div>
      <div><strong>Daop:</strong> {{ stasiun.daop?.nama ?? '-' }}</div>
      <div><strong>Region:</strong> {{ stasiun.daop?.region ?? '-' }}</div>
      <div><strong>Status:</strong> {{ stasiun.aktif === 1 ? 'Aktif' : 'Non Aktif' }}</div>
      <div><strong>Kotak:</strong> {{ stasiun.kotak }}</div>
      <div><strong>Track:</strong> {{ stasiun.track }}</div>
      <div><strong>PPKT:</strong> {{ stasiun.ppkt }}</div>
      <div><strong>Garis Tipis:</strong> {{ stasiun.garis_tipis }}</div>
      <div><strong>Garis Tebal:</strong> {{ stasiun.garis_tebal }}</div>
      <div><strong>Perhentian:</strong> {{ stasiun.perhentian }}</div>
      <div><strong>Batas Daop:</strong> {{ stasiun.batas_daop }}</div>
      <div><strong>Created At:</strong> {{ stasiun.created_at }}</div>
      <div><strong>Updated At:</strong> {{ stasiun.updated_at }}</div>
      <div><strong>Created By:</strong> {{ stasiun.created_by ?? '-' }}</div>
      <div><strong>Updated By:</strong> {{ stasiun.updated_by ?? '-' }}</div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js' // ← Tambahkan ini
const props = defineProps({
  stasiun: Object,
})
</script>
