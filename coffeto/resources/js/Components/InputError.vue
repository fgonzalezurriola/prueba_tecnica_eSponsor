<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p
            class="mt-1 inline-block border-2 border-red-600 bg-red-100 px-2 py-1 text-sm font-bold text-red-600"
        >
            {{ message }}
        </p>
    </div>
</template>
