<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Edit Menu</h1>
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
        <select v-model="form.is_active" class="form-select w-full">
          <option :value="1">Aktif</option>
          <option :value="0">Non Aktif</option>
        </select>
      </div>
      <button type="submit" class="btn btn-warning">Update</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  menu: Object
})

const form = useForm({
  name: props.menu.name,
  route: props.menu.route,
  menu_order: props.menu.menu_order,
  is_active: props.menu.is_active
})

function submit() {
  form.put(`/menus/${props.menu.id}`)
}
</script>
