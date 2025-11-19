<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link
        href="/"
        class="fixed left-8 top-8 z-50 flex h-12 items-center justify-center gap-3 border-3 border-black bg-white px-4 text-black shadow-neo transition-all hover:-translate-y-1 hover:bg-neo-yellow hover:shadow-neo-lg"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="h-6 w-6"
        >
            <path d="M18.1 8.1a2 2 0 0 1 0 4H17" />
            <path d="M2 8h15v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
            <line x1="6" y1="1" x2="6" y2="4" />
            <line x1="10" y1="1" x2="10" y2="4" />
            <line x1="14" y1="1" x2="14" y2="4" />
        </svg>
        <span class="text-xl font-black uppercase tracking-tighter"
            >COFFETO</span
        >
    </Link>
</template>
