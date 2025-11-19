<script setup>
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
    <div
        class="min-h-screen bg-neo-yellow text-black flex items-center justify-center px-4"
    >
        <div
            class="max-w-4xl w-full border-3 border-black bg-white shadow-neo-lg p-8 flex flex-col gap-12"
        >
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b-3 border-black pb-8">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-16 w-16 items-center justify-center border-3 border-black bg-black text-white font-black text-3xl tracking-tighter shadow-neo"
                    >
                        C
                    </div>
                    <div class="space-y-1">
                        <h1
                            class="text-4xl font-black tracking-tighter uppercase leading-none"
                        >
                            Coffeto
                        </h1>
                        <p class="text-sm font-bold bg-black text-white inline-block px-2 py-1">
                            v1.0 - NEOBRUTALISM EDITION
                        </p>
                    </div>
                </div>

                <div v-if="canLogin" class="flex gap-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="inline-flex items-center justify-center border-2 border-black bg-white px-4 py-2 text-sm font-bold uppercase tracking-widest text-black shadow-neo transition-all hover:-translate-y-0.5 hover:translate-x-0.5 hover:bg-neo-pink hover:text-white hover:shadow-neo-sm"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="inline-flex items-center justify-center border-2 border-black bg-white px-4 py-2 text-sm font-bold uppercase tracking-widest text-black shadow-neo transition-all hover:-translate-y-0.5 hover:translate-x-0.5 hover:bg-neo-green hover:shadow-neo-sm"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="inline-flex items-center justify-center border-2 border-black bg-black px-4 py-2 text-sm font-bold uppercase tracking-widest text-white shadow-neo transition-all hover:-translate-y-0.5 hover:translate-x-0.5 hover:bg-gray-800 hover:shadow-neo-sm"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </header>

            <main class="flex flex-col gap-8">
                <div class="space-y-4">
                    <h2 class="text-6xl font-black uppercase leading-none tracking-tighter">
                        Create.<br/>Share.<br/>Monetize.
                    </h2>
                    <p class="text-xl font-bold max-w-2xl border-l-4 border-neo-blue pl-4">
                        The brutalist creator page you didn't know you needed. 
                        No gradients, no rounded corners, just raw content power.
                    </p>
                </div>

                <div
                    class="grid gap-6 md:grid-cols-2 items-stretch"
                >
                    <div
                        class="group border-3 border-black bg-neo-blue p-6 flex flex-col justify-between shadow-neo hover:shadow-neo-lg transition-all hover:-translate-y-1"
                    >
                        <div class="space-y-4 mb-8">
                            <div class="w-12 h-12 bg-black text-white flex items-center justify-center border-2 border-white font-black text-xl">1</div>
                            <h3
                                class="text-2xl font-black uppercase tracking-tight"
                            >
                                Public Demo
                            </h3>
                            <p class="font-bold text-black">
                                Check out how a creator page looks in this style. Warning: It's loud.
                            </p>
                        </div>

                        <Link
                            :href="route('public.page', { slug: 'demo-creator' })"
                            class="inline-flex items-center justify-center w-full border-2 border-black bg-white px-4 py-3 text-sm font-black uppercase tracking-tight text-black hover:bg-black hover:text-white transition-colors shadow-neo-sm"
                        >
                            Visit /@demo-creator
                        </Link>
                    </div>

                    <div
                        class="group border-3 border-black bg-neo-pink p-6 flex flex-col justify-between shadow-neo hover:shadow-neo-lg transition-all hover:-translate-y-1"
                    >
                        <div class="space-y-4 mb-8">
                            <div class="w-12 h-12 bg-black text-white flex items-center justify-center border-2 border-white font-black text-xl">2</div>
                            <h3
                                class="text-2xl font-black uppercase tracking-tight"
                            >
                                Start Creating
                            </h3>
                            <p class="font-bold text-black">
                                Join the revolution. Create your own page and start accepting support.
                            </p>
                        </div>

                        <Link
                            :href="route('register')"
                            class="inline-flex items-center justify-center w-full border-2 border-black bg-white px-4 py-3 text-sm font-black uppercase tracking-tight text-black hover:bg-black hover:text-white transition-colors shadow-neo-sm"
                        >
                            Get Started Now
                        </Link>
                    </div>
                </div>

                <div class="border-t-3 border-black pt-8 grid md:grid-cols-3 gap-8">
                   <div class="border-2 border-black p-4 bg-gray-50 shadow-neo-sm">
                        <h4 class="font-black uppercase mb-2">Built with</h4>
                        <ul class="text-sm font-bold space-y-1">
                            <li>Laravel 12</li>
                            <li>Vue 3</li>
                            <li>Inertia</li>
                            <li>Tailwind CSS</li>
                        </ul>
                   </div>
                   <div class="border-2 border-black p-4 bg-gray-50 shadow-neo-sm">
                        <h4 class="font-black uppercase mb-2">Style</h4>
                        <ul class="text-sm font-bold space-y-1">
                            <li>Neobrutalism</li>
                            <li>High Contrast</li>
                            <li>Hard Shadows</li>
                            <li>Bold Typography</li>
                        </ul>
                   </div>
                   <div class="border-2 border-black p-4 bg-gray-50 shadow-neo-sm flex items-center justify-center bg-pattern">
                        <p class="text-center font-black text-xs uppercase">
                            Laravel v{{ laravelVersion }}<br/>
                            PHP v{{ phpVersion }}
                        </p>
                   </div>
                </div>
            </main>
        </div>
    </div>
</template>

<style>
.bg-pattern {
    background-image: radial-gradient(circle, #000 1px, transparent 1px);
    background-size: 10px 10px;
}
</style>
