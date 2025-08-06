<script setup>
import { useForm } from '@inertiajs/vue3'
import { Head, Link } from '@inertiajs/vue3'

const form = useForm({
  nama: '',
  singkatan: '',
  nomenklatur: '',
  daop: '',
  id_region: '',
  bus_area: '',
})

const submit = () => {
  form.post(route('daops.store'))
}
</script>

<template>
  <Head title="Tambah Daop" />
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Daop</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label>Nama</label>
        <input v-model="form.nama" type="text" class="input" />
        <span class="text-red-500 text-sm" v-if="form.errors.nama">{{ form.errors.nama }}</span>
      </div>
      <div>
        <label>Singkatan</label>
        <input v-model="form.singkatan" type="text" class="input" />
      </div>
      <div>
        <label>Nomenklatur</label>
        <input v-model="form.nomenklatur" type="text" class="input" />
      </div>
      <div>
        <label>Daop</label>
        <input v-model="form.daop" type="text" class="input" />
      </div>
      <div>
        <label>Region</label>
        <select v-model="form.id_region" class="input">
          <option value="">Pilih Region</option>
          <option value="1">Jawa</option>
          <option value="2">Sumatera</option>
        </select>
      </div>
      <div>
        <label>Bus Area</label>
        <input v-model="form.bus_area" type="text" class="input" />
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</template>
