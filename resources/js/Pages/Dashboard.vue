<template>
  <div class="dashboard">
    <div class="wallpaper"></div>
  </div>
</template>

<script setup>
// Tidak perlu isi karena layout sudah otomatis handle
</script>

<style scoped>
.dashboard {
  position: relative;
  width: 100%;
  height: 100%;
}

.wallpaper {
  position: absolute;
  inset: 0;
  background-image: url('/images/fotokai7.jpg');
  background-size: cover;
  background-position: center;
  background-color: white;
  opacity: 0.3;
  z-index: 0;
}
</style>
