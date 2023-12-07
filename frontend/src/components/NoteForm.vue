<template>
  <Input v-model="form.title" label="Title" placeholder="Title" :error="formErrors.title" />
  <TextArea v-model="form.content" placeholder="Start taking your notes.." />
</template>
<script setup>
import Input from "./widgets/Input.vue";
import TextArea from "./widgets/TextArea.vue";
const props = defineProps({
  form: {
    type: Object,
    default: {
      title: null,
      content: null,
    },
  },
  formErrors: {
    type: Object,
    default: {
      title: null,
    },
  },
});
</script>
