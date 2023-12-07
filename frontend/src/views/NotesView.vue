<template>
  <div class="container p-2 flex flex-wrap gap-5">
    <div
      class="w-60 h-60 flex flex-col justify-between bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-400 mb-6 py-5 px-4"
      v-for="note of notes"
    >
      <div>
        <h4 class="text-gray-800 dark:text-gray-100 font-bold mb-3 truncate">{{ note.title }}</h4>
        <p class="text-gray-800 dark:text-gray-100 text-sm line-clamp-[5]">
          {{ note.content }}
        </p>
      </div>
      <div>
        <div class="flex items-center justify-between text-gray-800 dark:text-gray-100">
          <p class="text-xs text-yellow-800">Created {{ getFormattedDateTime(note.created_at) }}</p>
          <RouterLink :to="'note/' + note.note_id"
            ><Button label="Edit" variant="primary" class="bg-yellow-500 hover:bg-yellow-600"
          /></RouterLink>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { getAllNotes } from "@/services";
import { onMounted, ref } from "vue";
import moment from "moment";
import Button from "@/components/widgets/Button.vue";

const notes = ref([]);

onMounted(() => {
  fetchAllNotes();
});

async function fetchAllNotes() {
  try {
    const response = await getAllNotes();
    notes.value = response;
  } catch (error) {
    toast.notify("Error message", "Unexpected error fetching all note. Please try again!", "error");
  }
}

function getFormattedDateTime(dateTime) {
  return moment(dateTime).fromNow();
}
</script>
