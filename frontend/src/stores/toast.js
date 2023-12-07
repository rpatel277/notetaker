import { defineStore } from "pinia";
import { ref } from "vue";

// Define a Pinia store named "toast" to manage toast notifications
export const useToast = defineStore("toast", () => {
  const toasts = ref([]);

  // Function to add a new notification
  function notify(title, message, type) {
    const toast = { title, message, type, notifyTime: Date.now() };
    toasts.value.push(toast);
    setTimeout(removeNotification, 5000, toast);
  }

  // Function to remove a notification from the toasts array
  function removeNotification(toast) {
    toasts.value = toasts.value.filter((n) => n.notifyTime != toast.notifyTime);
  }

  return { toasts, notify, removeNotification };
});
