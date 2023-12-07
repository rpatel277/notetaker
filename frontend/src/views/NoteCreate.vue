<template>
  <section class="flex flex-col h-full">
    <NoteForm :form="form" :form-errors="formErrors"></NoteForm>
    <div class="flex mt-auto justify-between">
      <RouterLink to="/"><Button label="Back" variant="secondary" /></RouterLink>
      <Button label="Add" variant="primary" @click="addNewNote" />
    </div>
  </section>
</template>
<script setup>
import { ref } from "vue";

import NoteForm from "@/components/NoteForm.vue";
import Button from "@/components/widgets/Button.vue";
import { useToast } from "@/stores/toast";
import { createNote } from "@/services";
import router from "@/router";

const toast = useToast();

const form = ref({
  title: null,
  content: null,
  autosave: false,
});

const formErrors = ref({
  title: null,
});

async function addNewNote() {
  try {
    // Call the createNote function with the noteData payload
    const response = await createNote(form.value);

    toast.notify("Success message", response.message, "success");
    router.push("/note/" + response.note_id);
  } catch (error) {
    if (error?.response?.status == 400) {
      formErrors.value.title = error.response.data.errors?.title?.[0] ?? null;
      toast.notify("Error message", error.response.data.message, "error");
    } else toast.notify("Error message", "Unexpected error creating note", "error");
  }
}
</script>
