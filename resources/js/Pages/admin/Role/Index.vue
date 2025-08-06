<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Manajemen Role</h1>
    <Link href="/roles/create" class="btn btn-primary mb-4">Tambah Role</Link>
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="role in roles" :key="role.id">
          <td>{{ role.name }}</td>
          <td>
            <Link :href="`/roles/${role.id}/edit`" class="btn btn-sm btn-warning me-2">Edit</Link>
            <button @click="hapus(role.id)" class="btn btn-sm btn-danger">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
defineProps({ roles: Array })

function hapus(id) {
  if (confirm('Yakin ingin menghapus role ini?')) {
    router.delete(`/roles/${id}`)
  }
}
</script>
