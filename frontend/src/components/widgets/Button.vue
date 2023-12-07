<template>
  <button :class="computedClasses" @click="handleClick" :disabled="disabled">
    {{ label }}
  </button>
</template>

<script setup>
import { computed, ref } from "vue";

const emit = defineEmits(["click"]);
const props = defineProps({
  label: {
    type: String,
    default: "Button",
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  variant: {
    type: String,
    default: "primary",
  },
});

const buttonVariantClasses = {
  primary: "bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full",
  secondary: "bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-full",
  danger: "bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full",
  info: "bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-full",
};

const computedClasses = computed(() => {
  return `inline-block ${buttonVariantClasses[props.variant]}`;
});

const handleClick = () => {
  emit("click");
};
</script>
