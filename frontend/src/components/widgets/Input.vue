<template>
  <label
    :for="inputId"
    class="relative block overflow-hidden rounded-md bg-white border border-gray-200 px-3 pt-3 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600"
  >
    <input
      :id="inputId"
      :placeholder="placeholder"
      class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm text-gray-800 font-semibold"
      v-model="inputValue"
      @input="handleInput"
    />

    <span
      class="absolute start-3 top-3 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-3 peer-focus:text-xs"
    >
      {{ label }}
    </span>
  </label>
  <small v-if="error" class="text-red-500">{{ error }}</small>
</template>

<script setup>
import { ref, computed, watch } from "vue";

const emits = defineEmits(["update:modelValue"]);

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: "",
  },
  label: {
    type: String,
    default: "Input",
  },
  placeholder: {
    type: String,
    default: "",
  },
  inputId: {
    type: String,
    default: "custom-input",
  },
  error: {
    type: String,
    default: null,
  },
});

const inputValue = ref(props.modelValue);

watch(
  () => props.modelValue,
  async (newValue) => {
    inputValue.value = newValue;
  }
);

const handleInput = (event) => {
  emits("update:modelValue", event.target.value);
};
</script>
