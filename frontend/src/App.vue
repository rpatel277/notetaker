<template>
  <Header />
  <Toast />

  <div class="bg-blue-50 p-10 m-10 mt-20 border-dashed border-blue-500 border-2 full-height rounded-lg overflow-scroll">
    <RouterView />
  </div>
</template>
<script setup>
import { RouterLink, RouterView } from "vue-router";
import Header from "./components/Header.vue";
import Toast from "./components/widgets/Toast.vue";
</script>
<style scoped>
.full-height {
  height: calc(100vh - 10rem);
}
</style>
