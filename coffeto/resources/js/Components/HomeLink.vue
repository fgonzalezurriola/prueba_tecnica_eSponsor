<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link
        href="/"
        class="flex items-center justify-center gap-2 border-3 border-black bg-white px-4 py-2 text-black shadow-neo transition-all hover:-translate-y-1 hover:bg-neo-yellow hover:shadow-neo-lg sm:gap-3 sm:px-6 sm:py-3"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="3"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="h-5 w-5 sm:h-6 sm:w-6"
        >
            <path d="M18 8h1a4 4 0 0 1 0 8h-1" />
            <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
            <line x1="6" y1="1" x2="6" y2="4" />
            <line x1="10" y1="1" x2="10" y2="4" />
            <line x1="14" y1="1" x2="14" y2="4" />
        </svg>
        <span class="text-lg font-black uppercase tracking-tighter sm:text-xl"
            >COFFETO</span
        >
    </Link>
</template>
