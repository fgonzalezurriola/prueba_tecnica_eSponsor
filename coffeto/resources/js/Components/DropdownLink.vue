<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-4 py-2 text-start text-sm font-bold uppercase leading-5 text-gray-600 transition duration-150 ease-in-out hover:bg-neo-yellow hover:text-black focus:bg-neo-yellow focus:text-black focus:outline-none"
    >
        <slot />
    </Link>
</template>
