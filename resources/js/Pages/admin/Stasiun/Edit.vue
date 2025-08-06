<template>
  <form @submit.prevent="submit" class="p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-xl font-bold mb-4">Edit Data Stasiun</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label>Nama</label>
        <input v-model="form.nama" type="text" class="input" />
        <div v-if="form.errors.nama" class="text-red-500 text-sm">{{ form.errors.nama }}</div>
      </div>

      <div>
        <label>Singkatan</label>
        <input v-model="form.singkatan" type="text" class="input" />
        <div v-if="form.errors.singkatan" class="text-red-500 text-sm">{{ form.errors.singkatan }}</div>
      </div>

      <div>
        <label>Kode</label>
        <input v-model="form.kode" type="text" class="input" />
        <div v-if="form.errors.kode" class="text-red-500 text-sm">{{ form.errors.kode }}</div>
      </div>

      <div>
        <label>DPL</label>
        <input v-model="form.dpl" type="text" class="input" />
        <div v-if="form.errors.dpl" class="text-red-500 text-sm">{{ form.errors.dpl }}</div>
      </div>

      <div>
        <label>Aktif</label>
        <select v-model.number="form.aktif" class="input">
          <option :value="1">Aktif</option>
          <option :value="0">Non Aktif</option>
        </select>
        <div v-if="form.errors.aktif" class="text-red-500 text-sm">{{ form.errors.aktif }}</div>
      </div>

      <div>
        <label>Kotak</label>
        <input v-model="form.kotak" type="text" class="input" />
        <div v-if="form.errors.kotak" class="text-red-500 text-sm">{{ form.errors.kotak }}</div>
      </div>

      <div>
        <label>Garis Tipis</label>
        <input v-model="form.garis_tipis" type="text" class="input" />
        <div v-if="form.errors.garis_tipis" class="text-red-500 text-sm">{{ form.errors.garis_tipis }}</div>
      </div>

      <div>
        <label>Garis Tebal</label>
        <input v-model="form.garis_tebal" type="text" class="input" />
        <div v-if="form.errors.garis_tebal" class="text-red-500 text-sm">{{ form.errors.garis_tebal }}</div>
      </div>

      <div>
        <label>Perhentian</label>
        <input v-model="form.perhentian" type="text" class="input" />
        <div v-if="form.errors.perhentian" class="text-red-500 text-sm">{{ form.errors.perhentian }}</div>
      </div>

      <div>
        <label>Batas Daop</label>
        <input v-model="form.batas_daop" type="text" class="input" />
        <div v-if="form.errors.batas_daop" class="text-red-500 text-sm">{{ form.errors.batas_daop }}</div>
      </div>

      <div>
        <label>Track</label>
        <input v-model="form.track" type="text" class="input" />
        <div v-if="form.errors.track" class="text-red-500 text-sm">{{ form.errors.track }}</div>
      </div>

      <div>
        <label>PPKT</label>
        <input v-model="form.ppkt" type="text" class="input" />
        <div v-if="form.errors.ppkt" class="text-red-500 text-sm">{{ form.errors.ppkt }}</div>
      </div>

      <div>
        <label>Created At</label>
        <input :value="form.created_at" type="text" class="input bg-gray-100" readonly />
      </div>

      <div>
        <label>Updated At</label>
        <input :value="form.updated_at" type="text" class="input bg-gray-100" readonly />
      </div>

      <div>
        <label>Created By</label>
        <input :value="form.created_by" type="text" class="input bg-gray-100" readonly />
      </div>

      <div>
        <label>Updated By</label>
        <input :value="form.updated_by" type="text" class="input bg-gray-100" readonly />
      </div>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">Update</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  stasiun: Object
})

const form = useForm({
  id_daop: String(props.stasiun.id_daop ?? ''),
  singkatan: String(props.stasiun.singkatan ?? ''),
  nama: String(props.stasiun.nama ?? ''),
  dpl: String(props.stasiun.dpl ?? ''),
  kode: String(props.stasiun.kode ?? ''),
  aktif: props.stasiun.aktif ?? 1,
  kotak: String(props.stasiun.kotak ?? ''),
  garis_tipis: String(props.stasiun.garis_tipis ?? ''),
  garis_tebal: String(props.stasiun.garis_tebal ?? ''),
  perhentian: String(props.stasiun.perhentian ?? ''),
  batas_daop: String(props.stasiun.batas_daop ?? ''),
  track: String(props.stasiun.track ?? ''),
  ppkt: String(props.stasiun.ppkt ?? ''),
  created_at: props.stasiun.created_at ?? '',
  updated_at: props.stasiun.updated_at ?? '',
  created_by: props.stasiun.created_by ?? '',
  updated_by: props.stasiun.updated_by ?? '',
})

const submit = () => {
  form.put(`/stasiuns/${props.stasiun.id}`)
}
</script>


<style scoped>
.input {
  @apply w-full border border-gray-300 rounded px-3 py-2;
}
</style>
