<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input ref="input" class="hover:border-gray-300 focus:border-gray-900 focus:ring-0 shadow-sm" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)">
</template>
