<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Tambah Data Jarak</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <!-- ID Daop -->
      <div>
        <label class="block font-semibold">ID Daop</label>
        <input v-model="form.id_daop" type="text" class="input" />
        <div v-if="form.errors.id_daop" class="text-red-500">{{ form.errors.id_daop }}</div>
      </div>

      <!-- ID Stasiun -->
      <div>
        <label class="block font-semibold">ID Stasiun</label>
        <input v-model="form.id_stasiun" type="text" class="input" />
        <div v-if="form.errors.id_stasiun" class="text-red-500">{{ form.errors.id_stasiun }}</div>
      </div>

      <!-- ID Stasiun Sebelah -->
      <div>
        <label class="block font-semibold">ID Stasiun Sebelah</label>
        <input v-model="form.id_stasiun_sebelah" type="text" class="input" />
        <div v-if="form.errors.id_stasiun_sebelah" class="text-red-500">{{ form.errors.id_stasiun_sebelah }}</div>
      </div>

      <!-- ID Lintas -->
      <div>
        <label class="block font-semibold">ID Lintas (Opsional)</label>
        <input v-model="form.id_lintas" type="text" class="input" />
        <div v-if="form.errors.id_lintas" class="text-red-500">{{ form.errors.id_lintas }}</div>
      </div>

      <!-- Tahun Gapeka -->
      <div>
        <label class="block font-semibold">Tahun Gapeka</label>
        <input v-model="form.id_tahun_gapeka" type="text" class="input" />
        <div v-if="form.errors.id_tahun_gapeka" class="text-red-500">{{ form.errors.id_tahun_gapeka }}</div>
      </div>

      <!-- Jarak -->
      <div>
        <label class="block font-semibold">Jarak (km)</label>
        <input v-model="form.jarak" type="number" step="0.01" class="input" />
        <div v-if="form.errors.jarak" class="text-red-500">{{ form.errors.jarak }}</div>
      </div>

      <!-- Puncak Kecepatan -->
      <div>
        <label class="block font-semibold">Puncak Kecepatan</label>
        <input v-model="form.puncak_kecepatan" type="number" class="input" />
        <div v-if="form.errors.puncak_kecepatan" class="text-red-500">{{ form.errors.puncak_kecepatan }}</div>
      </div>

      <!-- Taspat -->
      <div>
        <label class="block font-semibold">Taspat</label>
        <input v-model="form.taspat" type="text" class="input" />
        <div v-if="form.errors.taspat" class="text-red-500">{{ form.errors.taspat }}</div>
      </div>

      <!-- Kecepatan Barang -->
      <div>
        <label class="block font-semibold">Puncak Kecepatan Barang</label>
        <input v-model="form.kec_barang" type="number" class="input" />
        <div v-if="form.errors.kec_barang" class="text-red-500">{{ form.errors.kec_barang }}</div>
      </div>

      <!-- Status -->
      <div>
        <label class="block font-semibold">Status</label>
        <select v-model="form.status" class="input">
          <option :value="1">Aktif</option>
          <option :value="0">Non Aktif</option>
        </select>
        <div v-if="form.errors.status" class="text-red-500">{{ form.errors.status }}</div>
      </div>

      <!-- Created At (Auto, hidden) -->
      <input type="hidden" v-model="form.created_at" />

      <!-- Created By (Auto, hidden) -->
      <input type="hidden" v-model="form.created_by" />

      <!-- Updated At (Auto, hidden) -->
      <input type="hidden" v-model="form.updated_at" />

      <!-- Updated By (Auto, hidden) -->
      <input type="hidden" v-model="form.updated_by" />

      <!-- Approved At (Auto, hidden) -->
      <input type="hidden" v-model="form.approved_at" />

      <!-- Approved By (Auto, hidden) -->
      <input type="hidden" v-model="form.approved_by" />

      <!-- Tombol Submit -->
      <div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          Simpan
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

// Form data
const form = useForm({
  id_daop: '',
  id_stasiun: '',
  id_stasiun_sebelah: '',
  id_lintas: '',
  id_tahun_gapeka: '',
  jarak: '',
  puncak_kecepatan: '',
  taspat: '',
  kec_barang: '',
  status: 1,
  created_at: '',
  created_by: '',
  updated_at: '',
  updated_by: '',
  approved_at: '',
  approved_by: '',
})

// Submit
const submit = () => {
  form.post(route('jarak.store'), {
    onSuccess: () => alert('✅ Data berhasil disimpan.'),
    onError: (errors) => {
      console.error('Gagal menyimpan data:', errors)
      const allErrors = Object.values(errors).flat().join('\n')
      alert('❌ Gagal menyimpan data:\n' + allErrors)
    },
  })
}
</script>

<style scoped>
.input {
  @apply w-full px-3 py-2 border border-gray-300 rounded;
}
</style>
