<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-3xl font-black leading-tight text-black uppercase tracking-tighter"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12 bg-orange-50 min-h-screen">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                
                <!-- Welcome Card -->
                <div
                    class="overflow-hidden border-3 border-black bg-white shadow-neo p-6"
                >
                    <h3 class="text-2xl font-black mb-2">Welcome back!</h3>
                    <p class="text-gray-800 font-medium border-l-4 border-neo-green pl-4 py-1 bg-green-50">
                        You are logged in! This is your command center.
                    </p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-neo-blue border-3 border-black p-6 shadow-neo hover:shadow-neo-lg transition-all">
                        <div class="text-sm font-bold uppercase mb-1">Total Views</div>
                        <div class="text-4xl font-black text-white">0</div>
                    </div>
                    <div class="bg-neo-pink border-3 border-black p-6 shadow-neo hover:shadow-neo-lg transition-all">
                        <div class="text-sm font-bold uppercase mb-1">Coffees Received</div>
                        <div class="text-4xl font-black text-white">0</div>
                    </div>
                    <div class="bg-neo-yellow border-3 border-black p-6 shadow-neo hover:shadow-neo-lg transition-all">
                        <div class="text-sm font-bold uppercase mb-1">Active Supporters</div>
                        <div class="text-4xl font-black text-black">0</div>
                    </div>
                </div>

                <!-- Action Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                     <div class="bg-white border-3 border-black p-6 shadow-neo">
                        <h3 class="text-xl font-black uppercase mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                             <a href="#" class="block w-full border-2 border-black bg-gray-100 p-3 font-bold hover:bg-black hover:text-white transition-colors text-center">
                                 Edit Page Details
                             </a>
                             <a href="#" class="block w-full border-2 border-black bg-gray-100 p-3 font-bold hover:bg-black hover:text-white transition-colors text-center">
                                 View Public Page
                             </a>
                        </div>
                     </div>
                     
                     <div class="bg-white border-3 border-black p-6 shadow-neo">
                        <h3 class="text-xl font-black uppercase mb-4">Latest Support</h3>
                        <div class="border-2 border-dashed border-gray-300 p-8 text-center text-gray-400 font-bold italic">
                            No recent activity
                        </div>
                     </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
