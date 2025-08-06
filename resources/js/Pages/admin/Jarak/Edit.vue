<script setup>
import { useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  jarak: Object,
  daops: Array,
  stasiuns: Array,
  id_lintas: Array,
  tahun_gapeka: Array,
  errors: Object
})

const form = useForm({
  id_daop: props.jarak.id_daop || '',
  id_stasiun: props.jarak.id_stasiun || '',
  id_stasiun_sebelah: props.jarak.id_stasiun_sebelah || '',
  id_lintas: props.jarak.id_lintas ?? '',
  id_tahun_gapeka: props.jarak.id_tahun_gapeka ?? '',
  jarak: props.jarak.jarak || '',
  puncak_kecepatan: props.jarak.puncak_kecepatan || '',
  taspat: props.jarak.taspat ?? '',
  puncak_kecepatan_barang: props.jarak.puncak_kecepatan_barang ?? '',
  status: props.jarak.status ?? 1,
})

const submit = () => {
  form.put(route('jarak.update', props.jarak.id), {
    onSuccess: () => alert('Data berhasil diperbarui.'),
    onError: () => alert('Gagal menyimpan perubahan. Silakan periksa kembali input.')
  })
}
</script>

<template>
  <div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold">Edit Data Jarak</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <div v-for="field in [
        { label: 'Daop', model: 'id_daop', options: daops },
        { label: 'Stasiun', model: 'id_stasiun', options: stasiuns },
        { label: 'Stasiun Sebelah', model: 'id_stasiun_sebelah', options: stasiuns },
        { label: 'Lintas', model: 'id_lintas', options: lintas },
        { label: 'Tahun Gapeka', model: 'id_tahun_gapeka', options: tahun_gapeka },
      ]" :key="field.model">
        <label>{{ field.label }}:</label>
        <select v-model="form[field.model]" class="form-select">
          <option value="">-- Pilih {{ field.label }} --</option>
          <option v-for="item in field.options" :key="item.id" :value="item.id">{{ item.nama }}</option>
        </select>
        <div v-if="form.errors[field.model]" class="text-red-500 text-sm">{{ form.errors[field.model] }}</div>
      </div>

      <div>
        <label>Jarak (km):</label>
        <input type="number" step="0.01" v-model="form.jarak" class="form-input" />
        <div v-if="form.errors.jarak" class="text-red-500 text-sm">{{ form.errors.jarak }}</div>
      </div>

      <div>
        <label>Puncak Kecepatan:</label>
        <input type="number" v-model="form.puncak_kecepatan" class="form-input" />
        <div v-if="form.errors.puncak_kecepatan" class="text-red-500 text-sm">{{ form.errors.puncak_kecepatan }}</div>
      </div>

      <div>
        <label>Taspat:</label>
        <input type="number" v-model="form.taspat" class="form-input" />
        <div v-if="form.errors.taspat" class="text-red-500 text-sm">{{ form.errors.taspat }}</div>
      </div>

      <div>
        <label>Puncak Kecepatan Barang:</label>
        <input type="number" v-model="form.puncak_kecepatan_barang" class="form-input" />
        <div v-if="form.errors.puncak_kecepatan_barang" class="text-red-500 text-sm">{{ form.errors.puncak_kecepatan_barang }}</div>
      </div>

      <div>
        <label>Status:</label>
        <select v-model="form.status" class="form-select">
          <option :value="1">Aktif</option>
          <option :value="0">Non-Aktif</option>
        </select>
        <div v-if="form.errors.status" class="text-red-500 text-sm">{{ form.errors.status }}</div>
      </div>

      <div class="mt-4">
        <button :disabled="form.processing" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped>
.form-select, .form-input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 0.375rem;
  margin-top: 0.25rem;
}
</style>
