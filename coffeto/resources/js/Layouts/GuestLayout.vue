<script setup>
import HomeLink from '@/Components/HomeLink.vue';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-neo-yellow pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <HomeLink />
        </div>

        <div
            class="mt-6 w-full overflow-hidden border-3 border-black bg-white px-8 py-8 shadow-neo-lg sm:max-w-md sm:rounded-none"
        >
            <slot />
        </div>
    </div>
</template>
