<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-neo-yellow pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <ApplicationLogo
                    class="h-24 w-24 fill-current text-black drop-shadow-[4px_4px_0px_rgba(255,255,255,1)]"
                />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden border-3 border-black bg-white px-8 py-8 shadow-neo-lg sm:max-w-md sm:rounded-none"
        >
            <slot />
        </div>
    </div>
</template>
