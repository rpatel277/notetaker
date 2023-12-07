<template>
  <header class="bg-white fixed top-0 left-0 w-full flex items-center justify-between h-16 gap-8 px-10 z-50">
    <RouterLink to="/">
      <span class="sr-only">Home</span>
      <p class="text-4xl font-extrabold text-blue-500 font-mono">notetaker.</p>
    </RouterLink>

    <RouterLink to="/note/create"><Button label="Create" variant="primary" /></RouterLink>
  </header>
</template>

<script setup>
import Button from "./widgets/Button.vue";
</script>
