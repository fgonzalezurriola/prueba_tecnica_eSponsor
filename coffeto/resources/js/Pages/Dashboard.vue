<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    page: Object,
    stats: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-3xl font-black uppercase leading-tight tracking-tighter text-black"
            >
                Dashboard
            </h2>
        </template>

        <div class="min-h-screen bg-orange-50 py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <!-- Welcome Card -->
                <div
                    class="overflow-hidden border-3 border-black bg-white p-6 shadow-neo"
                >
                    <h3 class="mb-2 text-2xl font-black">Welcome back!</h3>
                    <p
                        class="border-l-4 border-neo-green bg-green-50 py-1 pl-4 font-medium text-gray-800"
                    >
                        You are logged in! This is your command center.
                    </p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div
                        class="border-3 border-black bg-neo-blue p-6 shadow-neo transition-all hover:shadow-neo-lg"
                    >
                        <div class="mb-1 text-sm font-bold uppercase">
                            Total Links
                        </div>
                        <div class="text-4xl font-black text-white">
                            {{ stats?.total_links ?? 0 }}
                        </div>
                    </div>
                    <div
                        class="border-3 border-black bg-neo-pink p-6 shadow-neo transition-all hover:shadow-neo-lg"
                    >
                        <div class="mb-1 text-sm font-bold uppercase">
                            Coffees Received
                        </div>
                        <div class="text-4xl font-black text-white">
                            {{ stats?.total_supports ?? 0 }}
                        </div>
                    </div>
                    <div
                        class="border-3 border-black bg-neo-yellow p-6 shadow-neo transition-all hover:shadow-neo-lg"
                    >
                        <div class="mb-1 text-sm font-bold uppercase">
                            Total Amount
                        </div>
                        <div class="text-4xl font-black text-black">
                            ${{ ((stats?.total_amount ?? 0) / 100).toFixed(2) }}
                        </div>
                    </div>
                </div>

                <!-- Action Cards -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="border-3 border-black bg-white p-6 shadow-neo">
                        <h3 class="mb-4 text-xl font-black uppercase">
                            Quick Actions
                        </h3>
                        <div class="space-y-3">
                            <Link
                                :href="route('page.edit')"
                                class="block w-full border-2 border-black bg-gray-100 p-3 text-center font-bold transition-colors hover:bg-black hover:text-white"
                            >
                                Edit Page Details
                            </Link>
                            <Link
                                v-if="page"
                                :href="
                                    route('public.page', { slug: page.slug })
                                "
                                class="block w-full border-2 border-black bg-gray-100 p-3 text-center font-bold transition-colors hover:bg-black hover:text-white"
                            >
                                View Public Page
                            </Link>
                            <div
                                v-else
                                class="block w-full border-2 border-dashed border-gray-300 bg-gray-50 p-3 text-center font-bold italic text-gray-400"
                            >
                                Create your page first
                            </div>
                        </div>
                    </div>

                    <div class="border-3 border-black bg-white p-6 shadow-neo">
                        <h3 class="mb-4 text-xl font-black uppercase">
                            Latest Support
                        </h3>
                        <div v-if="page?.supports?.length" class="space-y-2">
                            <div
                                v-for="support in page.supports.slice(0, 3)"
                                :key="support.id"
                                class="border-2 border-black bg-gray-50 p-3"
                            >
                                <div class="flex items-start justify-between">
                                    <span
                                        class="text-sm font-black uppercase"
                                        >{{ support.supporter_name }}</span
                                    >
                                    <span class="font-mono text-xs font-bold"
                                        >${{
                                            (support.amount / 100).toFixed(2)
                                        }}</span
                                    >
                                </div>
                                <p
                                    v-if="support.message"
                                    class="mt-1 truncate text-xs font-bold italic text-gray-600"
                                >
                                    "{{ support.message }}"
                                </p>
                            </div>
                        </div>
                        <div
                            v-else
                            class="border-2 border-dashed border-gray-300 p-8 text-center font-bold italic text-gray-400"
                        >
                            No recent activity
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
