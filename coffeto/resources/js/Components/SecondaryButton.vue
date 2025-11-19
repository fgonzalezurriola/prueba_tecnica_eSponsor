<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center justify-center rounded-none border-2 border-black bg-white px-4 py-2 text-xs font-bold uppercase tracking-widest text-black shadow-neo transition-all duration-200 hover:-translate-y-0.5 hover:translate-x-0.5 hover:bg-neo-yellow hover:shadow-neo-lg focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 active:translate-x-[2px] active:translate-y-[2px] active:shadow-none disabled:opacity-25"
    >
        <slot />
    </button>
</template>
