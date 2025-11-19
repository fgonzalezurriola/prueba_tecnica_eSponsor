<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-none border-2 border-black bg-white shadow-neo-sm transition-all focus:border-black focus:bg-neo-yellow/20 focus:shadow-neo focus:ring-0"
        v-model="model"
        ref="input"
    />
</template>
