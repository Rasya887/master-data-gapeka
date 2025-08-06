<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Tambah Menu</h1>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label>Nama</label>
        <input v-model="form.name" type="text" class="form-input w-full" />
        <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
      </div>
      <div class="mb-4">
        <label>Route</label>
        <input v-model="form.route" type="text" class="form-input w-full" />
      </div>
      <div class="mb-4">
        <label>Urutan</label>
        <input v-model="form.menu_order" type="number" class="form-input w-full" />
      </div>
      <div class="mb-4">
        <label>Status</label>
        <select v-model="form.status" class="form-select w-full">
          <option :value="1">Aktif</option>
          <option :value="0">Non Aktif</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  route: '',
  menu_order: 0,
  status: 1
})

function submit() {
  form.post('/menus')
}
</script>