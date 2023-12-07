<template>
  <textarea
    :id="inputId"
    class="mt-2 p-3 w-full rounded-lg bg-gradient-to-r from-yellow-50 to-yellow-100 border-gray-200 align-top shadow-sm sm:text-sm text-gray-800"
    rows="4"
    :placeholder="placeholder"
    v-model="inputValue"
    @input="handleInput"
  ></textarea>
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
