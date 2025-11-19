<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red-600 font-bold bg-red-100 border-2 border-red-600 px-2 py-1 mt-1 inline-block">
            {{ message }}
        </p>
    </div>
</template>
