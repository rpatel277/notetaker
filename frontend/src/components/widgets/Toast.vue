<template>
  <div v-if="toasts.length" class="fixed bottom-0 right-0 p-4 z-50">
    <div
      v-for="(toast, index) in toasts"
      :key="index"
      role="alert"
      :class="['rounded-xl p-4 mt-4', getTypeColor(toast.type)]"
    >
      <div class="flex items-start gap-4">
        <div class="flex-1">
          <strong class="block font-medium text-white">{{ toast.title }}</strong>
          <p class="mt-1 text-sm text-white">{{ toast.message }}</p>
        </div>
        <button @click="dismissToast(toast)" class="text-white transition hover:text-slate-50">
          <!-- Dismiss button icon -->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useToast } from "@/stores/toast";
import { storeToRefs } from "pinia";

const toast = useToast();
const { toasts } = storeToRefs(toast);

const getTypeColor = (type) => {
  switch (type) {
    case "success":
      return "bg-green-600";
    case "warning":
      return "bg-yellow-500";
    case "error":
      return "bg-red-600";
    case "info":
      return "bg-blue-500";
    default:
      return "bg-gray-500";
  }
};

function dismissToast(toastObject) {
  toast.removeNotification(toastObject);
}
</script>
