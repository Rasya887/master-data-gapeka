<template>
  <div>
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Tambah Stasiun</h1>

    <form @submit.prevent="submit">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label>Nama</label>
          <input v-model="form.nama" type="text" class="input" />
        </div>
        <div>
          <label>Singkatan</label>
          <input v-model="form.singkatan" type="text" class="input" />
        </div>
        <div>
          <label>Kode</label>
          <input v-model="form.kode" type="text" class="input" />
        </div>
        <div>
          <label>DPL</label>
          <input v-model="form.dpl" type="number" class="input" />
        </div>
        <div>
          <label>Daop</label>
          <select v-model="form.id_daop" class="input">
            <option value="">Pilih Daop</option>
            <option v-for="daop in daops" :key="daop.id" :value="daop.id">{{ daop.nama }}</option>
          </select>
        </div>
        <div>
          <label>Status Aktif</label>
          <select v-model="form.aktif" class="input">
            <option value="1">Aktif</option>
            <option value="0">Non Aktif</option>
          </select>
        </div>
        <div>
          <label>Kotak</label>
          <input v-model="form.kotak" type="text" class="input" />
        </div>
        <div>
          <label>Track</label>
          <input v-model="form.track" type="text" class="input" />
        </div>
        <div>
          <label>PPKT</label>
          <input v-model="form.ppkt" type="text" class="input" />
        </div>
      </div>

      <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Simpan
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'

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
.input {
  @apply w-full border rounded px-3 py-2;
}
</style>
