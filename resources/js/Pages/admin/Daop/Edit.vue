<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-600">Edit Data Daop</h1>

    <form @submit.prevent="submit">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
  <label class="font-semibold">Nama</label>
  <input v-model="form.nama" type="text" class="w-full border rounded p-2" />
  <div v-if="form.errors.nama" class="text-red-500 text-sm">{{ form.errors.nama }}</div>
</div>

<div>
  <label>Singkatan</label>
  <input v-model="form.singkatan" type="text" class="w-full border rounded p-2" />
  <div v-if="form.errors.singkatan" class="text-red-500 text-sm">{{ form.errors.singkatan }}</div>
</div>

<div>
  <label>Nomenklatur</label>
  <input v-model="form.nomenklatur" type="text" class="w-full border rounded p-2" />
  <div v-if="form.errors.nomenklatur" class="text-red-500 text-sm">{{ form.errors.nomenklatur }}</div>
</div>

<div>
  <label>Daop</label>
  <input v-model="form.daop" type="text" class="w-full border rounded p-2" />
  <div v-if="form.errors.daop" class="text-red-500 text-sm">{{ form.errors.daop }}</div>
</div>

<div>
  <label>Region</label>
  <select v-model="form.id_region" class="w-full border rounded p-2">
    <option value="">-- Pilih Region --</option>
    <option value="1">Jawa</option>
    <option value="2">Sumatera</option>
  </select>
  <div v-if="form.errors.id_region" class="text-red-500 text-sm">{{ form.errors.id_region }}</div>
</div>

<div>
  <label>Bus Area</label>
  <input v-model="form.bus_area" type="text" class="w-full border rounded p-2" />
  <div v-if="form.errors.bus_area" class="text-red-500 text-sm">{{ form.errors.bus_area }}</div>
</div>
      </div>

      <div class="mt-4">
        <button
          type="submit"
          :disabled="form.processing"
          class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded disabled:opacity-50"
        >
          Update
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
  daop: Object, // <- Harus sama dengan nama dari controller
})

const form = useForm({
  nama: props.daop.nama ?? '',
  singkatan: props.daop.singkatan ?? '',
  nomenklatur: props.daop.nomenklatur ?? '',
  daop: props.daop.daop ?? '', // nama field di DB = 'daop'
  id_region: props.daop.id_region ?? '',
  bus_area: props.daop.bus_area ?? '',
})

function submit() {
  form.put(`/daops/${props.daop.id}`)
}
</script>