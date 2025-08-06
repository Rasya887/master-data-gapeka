<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Tambah Role</h1>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="form-label">Nama Role</label>
        <input v-model="form.name" type="text" class="form-control" />
        <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: ''
})

function submit() {
  form.post('/roles')
}
</script>
