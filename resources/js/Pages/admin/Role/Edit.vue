<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Edit Role</h1>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="form-label">Nama Role</label>
        <input v-model="form.name" type="text" class="form-control" />
        <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
      </div>
      <button type="submit" class="btn btn-warning">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
const props = defineProps({ role: Object })

const form = useForm({
  name: props.role.name
})

function submit() {
  form.put(`/roles/${props.role.id}`)
}
</script>
