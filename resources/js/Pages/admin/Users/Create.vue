<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Tambah User</h1>
    <form @submit.prevent="submit">
      <div class="mb-3">
        <label>Nama</label>
        <input v-model="form.name" type="text" class="form-control" />
        <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input v-model="form.email" type="email" class="form-control" />
        <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input v-model="form.password" type="password" class="form-control" />
        <div v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</div>
      </div>

      <div class="mb-3">
        <label>Role</label>
                <select v-model="form.role" class="form-select">
            <option value="">-- Pilih Role --</option>
            <option v-for="role in roles" :key="role.id" :value="role.id.toString()">
                {{ role.name }}
            </option>
            </select>
        <div v-if="form.errors.role" class="text-danger">{{ form.errors.role }}</div>
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <Link href="/users" class="btn btn-secondary ms-2">Batal</Link>
    </form>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({ roles: Array })

const form = useForm({
  name: '',
  email: '',
  password: '',
  role: '',
})

function submit() {
  form.post('/users')
}
</script>
