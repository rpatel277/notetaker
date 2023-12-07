<template>
  <section class="flex flex-col h-full">
    <div class="text-center mb-4">
      <p class="font-semibold">Created {{ getFormattedDateTime(timeStamp.created_at) }}</p>
      <span class="flex items-center">
        <span class="h-px flex-1 bg-black"></span>
        <span class="shrink-0 px-6 text-xs">Updated {{ getFormattedDateTime(timeStamp.updated_at) }}</span>
        <span class="h-px flex-1 bg-black"></span>
      </span>
    </div>
    <NoteForm :form="form" :form-errors="formErrors"></NoteForm>
    <div class="mt-auto flex gap-2">
      <RouterLink to="/"><Button label="Back" variant="secondary" /></RouterLink>
      <Button label="Delete" variant="danger" class="ml-auto" @click="deleteNoteAction" />
      <Button label="Save" variant="primary" @click="editNoteAction" />
    </div>
  </section>
</template>
<script setup>
import { onMounted, ref } from "vue";

import NoteForm from "@/components/NoteForm.vue";
import Button from "@/components/widgets/Button.vue";
import { useToast } from "@/stores/toast";
import moment from "moment";
import { getNote, editNote, deleteNote } from "@/services";
import router from "@/router";

const toast = useToast();
const props = defineProps({
  note_id: String,
});
const form = ref({
  title: null,
  content: null,
  autosave: false,
});

const timeStamp = ref({
  created_at: new Date(),
  updated_at: new Date(),
});

const formErrors = ref({
  title: null,
});

onMounted(() => {
  fetchNote();
});

async function fetchNote() {
  try {
    const response = await getNote(props.note_id);

    form.value.title = response.title;
    form.value.content = response.content;
    form.value.autosave = response.autosave;
    timeStamp.value.created_at = response.created_at;
    timeStamp.value.updated_at = response.updated_at;
  } catch (error) {
    toast.notify("Error message", "Unexpected error fetching note", "error");
  }
}

async function editNoteAction() {
  try {
    const response = await editNote(props.note_id, form.value);
    timeStamp.value.updated_at = new Date(); //updating timestamp
    toast.notify("Success message", response.message, "success");
  } catch (error) {
    if (error?.response?.status == 400) {
      formErrors.value.title = error.response.data.errors?.title?.[0] ?? null;
      toast.notify("Error message", error.response.data.message, "error");
    } else if (error?.response?.status == 401) {
      toast.notify("Error message", error.response.data.message, "error");
    } else toast.notify("Error message", "Unexpected error editing note", "error");
  }
}

async function deleteNoteAction() {
  try {
    const response = await deleteNote(props.note_id);
    toast.notify("Success message", response.message, "success");
    router.push("/");
  } catch (error) {
    if (error?.response?.status == 401) {
      toast.notify("Error message", error.response.data.message, "error");
    } else toast.notify("Error message", "Unexpected error deleting note", "error");
  }
}

function getFormattedDateTime(dateTime) {
  return moment(dateTime).fromNow();
}
</script>
