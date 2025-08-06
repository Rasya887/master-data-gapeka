<!-- resources/js/Components/Pagination.vue -->
<template>
  <div v-if="links.length > 3" class="mt-4 flex flex-wrap gap-1">
    <template v-for="(link, key) in links" :key="key">
      <div v-if="link.url === null" class="px-3 py-1 text-sm text-gray-400" v-html="link.label" />
      <Link
        v-else
        class="px-3 py-1 text-sm border rounded hover:bg-gray-200"
        :class="{ 'bg-orange-500 text-white': link.active }"
        :href="link.url"
        v-html="link.label"
      />
    </template>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({ links: Array })
</script>
