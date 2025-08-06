<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Manajemen User</h1>
    <Link href="/users/create" class="btn btn-primary mb-4">Tambah User</Link>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Role</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
  <tr v-for="user in users" :key="user.id">
    <td>{{ user.name }}</td>
    <td>{{ user.email }}</td>
    <td>{{ user.roles[0]?.name ?? '-' }}</td>
    <td>
      <Link :href="`/users/${user.id}/edit`" class="btn btn-sm btn-warning me-2">Edit</Link>
      <button @click="hapus(user.id)" class="btn btn-sm btn-danger">Hapus</button>
    </td>
  </tr>
</tbody>
    </table>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
defineProps({ users: Array })

function hapus(id) {
  if (confirm('Yakin ingin menghapus user ini?')) {
    router.delete(`/users/${id}`)
  }
}
</script>
