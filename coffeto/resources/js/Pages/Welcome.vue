<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome to Coffeto" />

    <AuthenticatedLayout v-if="$page.props.auth.user">
        <div
            class="flex min-h-screen items-center justify-center bg-neo-yellow px-4 py-12 text-black"
        >
            <div
                class="flex w-full max-w-4xl flex-col gap-12 border-3 border-black bg-white p-8 shadow-neo-lg"
            >
                <main class="flex flex-col gap-8">
                    <div class="space-y-4">
                        <h2
                            class="text-6xl font-black uppercase leading-none tracking-tighter"
                        >
                            Create.<br />Share.<br />Get&nbsp;Supported.
                        </h2>
                        <p
                            class="max-w-2xl border-l-4 border-neo-blue pl-4 text-xl font-bold"
                        >
                            Your personal page to share content and receive
                            support from your audience.
                        </p>
                    </div>

                    <div class="grid items-stretch gap-6 md:grid-cols-2">
                        <div
                            class="group flex flex-col justify-between border-3 border-black bg-neo-blue p-6 shadow-neo transition-all hover:-translate-y-1 hover:shadow-neo-lg"
                        >
                            <div class="mb-8 space-y-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center border-2 border-white bg-black text-xl font-black text-white"
                                >
                                    1
                                </div>
                                <h3
                                    class="text-2xl font-black uppercase tracking-tight"
                                >
                                    See Demo
                                </h3>
                                <p class="font-bold text-black">
                                    Check out how a creator page looks and
                                    works.
                                </p>
                            </div>

                            <Link
                                :href="
                                    route('public.page', {
                                        slug: 'demo-creator',
                                    })
                                "
                                class="inline-flex w-full items-center justify-center border-2 border-black bg-white px-4 py-3 text-sm font-black uppercase tracking-tight text-black shadow-neo-sm transition-colors hover:bg-black hover:text-white"
                            >
                                Visit /@demo-creator
                            </Link>
                        </div>

                        <div
                            class="group flex flex-col justify-between border-3 border-black bg-neo-pink p-6 shadow-neo transition-all hover:-translate-y-1 hover:shadow-neo-lg"
                        >
                            <div class="mb-8 space-y-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center border-2 border-white bg-black text-xl font-black text-white"
                                >
                                    2
                                </div>
                                <h3
                                    class="text-2xl font-black uppercase tracking-tight"
                                >
                                    Your Dashboard
                                </h3>
                                <p class="font-bold text-black">
                                    Manage your page, links, and see who's
                                    supporting you.
                                </p>
                            </div>

                            <Link
                                :href="route('dashboard')"
                                class="inline-flex w-full items-center justify-center border-2 border-black bg-white px-4 py-3 text-sm font-black uppercase tracking-tight text-black shadow-neo-sm transition-colors hover:bg-black hover:text-white"
                            >
                                Go to Dashboard
                            </Link>
                        </div>
                    </div>

                    <div
                        class="grid gap-8 border-t-3 border-black pt-8 md:grid-cols-3"
                    >
                        <div
                            class="border-2 border-black bg-gray-50 p-4 shadow-neo-sm"
                        >
                            <h4 class="mb-2 font-black uppercase">
                                Built with
                            </h4>
                            <ul class="space-y-1 text-sm font-bold">
                                <li>Laravel 12</li>
                                <li>Vue 3</li>
                                <li>Inertia</li>
                                <li>Tailwind CSS</li>
                            </ul>
                        </div>
                        <div
                            class="border-2 border-black bg-gray-50 p-4 shadow-neo-sm"
                        >
                            <h4 class="mb-2 font-black uppercase">Features</h4>
                            <ul class="space-y-1 text-sm font-bold">
                                <li>Custom Links</li>
                                <li>Support System</li>
                                <li>Analytics</li>
                                <li>Easy Setup</li>
                            </ul>
                        </div>
                        <div
                            class="bg-pattern flex items-center justify-center border-2 border-black bg-gray-50 p-4 shadow-neo-sm"
                        >
                            <p class="text-center text-xs font-black uppercase">
                                Laravel v{{ laravelVersion }}<br />
                                PHP v{{ phpVersion }}
                            </p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </AuthenticatedLayout>

    <GuestLayout v-else>
        <div class="space-y-6">
            <h1 class="text-3xl font-black uppercase tracking-tighter">
                Welcome to Coffeto
            </h1>
            <p class="font-bold">
                Create your personal page to share content and receive support
                from your audience.
            </p>

            <div class="flex gap-4 border-t-3 border-black pt-6">
                <Link
                    v-if="canLogin"
                    :href="route('login')"
                    class="flex-1 border-2 border-black bg-neo-green px-4 py-3 text-center font-black uppercase shadow-neo transition-all hover:-translate-y-1 hover:shadow-neo-lg"
                >
                    Log in
                </Link>
                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="flex-1 border-2 border-black bg-black px-4 py-3 text-center font-black uppercase text-white shadow-neo transition-all hover:-translate-y-1 hover:shadow-neo-lg"
                >
                    Register
                </Link>
            </div>

            <Link
                :href="route('public.page', { slug: 'demo-creator' })"
                class="block border-2 border-black bg-neo-blue px-4 py-3 text-center font-black uppercase shadow-neo transition-all hover:-translate-y-1 hover:shadow-neo-lg"
            >
                View Demo Page
            </Link>
        </div>
    </GuestLayout>
</template>

<style>
.bg-pattern {
    background-image: radial-gradient(circle, #000 1px, transparent 1px);
    background-size: 10px 10px;
}
</style>
