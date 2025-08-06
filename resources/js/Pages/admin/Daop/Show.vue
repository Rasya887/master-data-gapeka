<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js' // ← Tambahkan ini

const props = defineProps({
  daop: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <Head title="Detail Daop" />

  <div class="p-6">
    <h1 class="text-2xl font-bold text-orange-600 mb-6 border-b pb-2">Detail Daop</h1>

    <div class="space-y-3 text-base">
      <p><strong>Nama:</strong> {{ daop.nama }}</p>
      <p><strong>Singkatan:</strong> {{ daop.singkatan }}</p>
      <p><strong>Nomenklatur:</strong> {{ daop.nomenklatur }}</p>
      <p><strong>Daop:</strong> {{ daop.daop }}</p>
      <p><strong>Region:</strong> {{ daop.id_region == 1 ? 'Jawa' : 'Sumatera' }}</p>
      <p><strong>Bus Area:</strong> {{ daop.bus_area }}</p>
    </div>

    <Link :href="route('daops.index')" class="mt-6 inline-block text-blue-600 hover:underline">
      ← Kembali ke Daftar Daop
    </Link>
  </div>
</template>
