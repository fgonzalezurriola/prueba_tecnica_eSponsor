<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    page: Object,
});
</script>

<template>
    <Head :title="page.title" />

    <div class="min-h-screen bg-yellow-50 dark:bg-gray-900 flex flex-col items-center justify-center p-4 font-mono">
        <div class="w-full max-w-md">
            <!-- Profile Card -->
            <div class="bg-white dark:bg-gray-800 border-4 border-black dark:border-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 mb-8 text-center">
                <!-- Avatar -->
                <div class="w-32 h-32 mx-auto mb-6 bg-gray-200 dark:bg-gray-700 border-4 border-black dark:border-white overflow-hidden relative">
                    <img
                        v-if="page.avatar_path"
                        :src="page.avatar_path"
                        :alt="page.title"
                        class="w-full h-full object-cover"
                    />
                    <div v-else class="w-full h-full flex items-center justify-center text-4xl font-black text-gray-400">
                        ?
                    </div>
                </div>

                <!-- Name -->
                <h1 class="text-3xl font-black uppercase mb-2 tracking-tighter break-words">
                    {{ page.title }}
                </h1>

                <!-- Bio -->
                <p class="text-gray-600 dark:text-gray-300 font-bold mb-0 border-t-4 border-black dark:border-white pt-4">
                    {{ page.bio || 'No bio yet.' }}
                </p>
            </div>

            <!-- Links List -->
            <div class="space-y-4 mb-8">
                <a
                    v-for="link in page.links"
                    :key="link.id"
                    :href="link.url"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="block w-full bg-white dark:bg-gray-800 border-4 border-black dark:border-white p-4 text-center font-black uppercase hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"
                >
                    {{ link.title }}
                </a>
                
                <div v-if="page.links.length === 0" class="text-center font-bold text-gray-500 italic">
                    No links added yet.
                </div>
            </div>

            <!-- Support Button (Placeholder for Phase 4) -->
            <button
                class="w-full bg-pink-500 border-4 border-black text-white p-6 text-xl font-black uppercase shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:bg-pink-400 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all flex items-center justify-center gap-3"
            >
                <span>☕</span> Support Me
            </button>
            
            <!-- Footer branding -->
            <div class="mt-12 text-center font-bold text-sm uppercase tracking-widest opacity-50">
                Powered by Coffeto
            </div>
        </div>
    </div>
</template>
