<script setup>
import HomeLink from '@/Components/HomeLink.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    page: Object,
});

const showSupportModal = ref(false);

const form = useForm({
    slug: props.page.slug,
    supporter_name: '',
    message: '',
    amount: 300,
});

const openSupportModal = () => {
    showSupportModal.value = true;
};

const closeSupportModal = () => {
    showSupportModal.value = false;
};

const submitSupport = () => {
    form.post(route('supports.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('supporter_name', 'message');
            showSupportModal.value = false;
        },
    });
};
</script>

<template>
    <Head :title="page.title" />

    <!-- Home Link -->
    <HomeLink />

    <div
        class="flex min-h-screen flex-col items-center justify-center bg-neo-yellow p-4 font-sans"
    >
        <div class="w-full max-w-md">
            <!-- Profile Card -->
            <div
                class="mb-8 border-3 border-black bg-white p-8 text-center shadow-neo-lg"
            >
                <!-- Avatar -->
                <div
                    class="relative mx-auto mb-6 h-32 w-32 overflow-hidden border-3 border-black bg-gray-200 shadow-neo"
                >
                    <img
                        v-if="page.avatar_path"
                        :src="page.avatar_path"
                        :alt="page.title"
                        class="h-full w-full object-cover"
                    />
                    <div
                        v-else
                        class="flex h-full w-full items-center justify-center text-4xl font-black text-gray-400"
                    >
                        ?
                    </div>
                </div>

                <!-- Name -->
                <h1
                    class="mb-2 break-words text-4xl font-black uppercase leading-none tracking-tighter"
                >
                    {{ page.title }}
                </h1>

                <!-- Bio -->
                <p
                    class="mb-0 mt-4 border-t-3 border-black pt-4 text-lg font-bold text-black"
                >
                    {{ page.bio || 'No bio yet.' }}
                </p>
            </div>

            <!-- Links List -->
            <div class="mb-8 space-y-4">
                <a
                    v-for="link in page.links"
                    :key="link.id"
                    :href="link.url"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="block w-full border-3 border-black bg-white p-4 text-center text-lg font-black uppercase shadow-neo transition-all hover:-translate-y-1 hover:bg-neo-blue hover:text-white hover:shadow-neo-lg"
                >
                    {{ link.title }}
                </a>

                <div
                    v-if="page.links.length === 0"
                    class="border-2 border-dashed border-black/20 p-4 text-center font-bold italic text-black/50"
                >
                    No links added yet.
                </div>
            </div>

            <!-- Support Button -->
            <button
                type="button"
                @click="openSupportModal"
                class="flex w-full items-center justify-center gap-3 border-3 border-black bg-neo-pink p-6 text-2xl font-black uppercase text-white shadow-neo transition-all hover:-translate-y-1 hover:bg-pink-400 hover:shadow-neo-lg"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    class="h-8 w-8 border-2 border-black bg-white p-1 text-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"
                >
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                </svg>
                Support Me
            </button>

            <!-- Footer branding -->
            <div
                class="mt-12 text-center text-sm font-black uppercase tracking-widest opacity-100"
            >
                <span class="bg-black px-2 py-1 text-white"
                    >Powered by Coffeto</span
                >
            </div>
        </div>

        <!-- Success Message -->
        <div
            v-if="$page.props.flash.success"
            class="fixed bottom-4 right-4 z-50 animate-bounce border-3 border-black bg-neo-green p-4 shadow-neo-lg"
        >
            <p class="text-lg font-black uppercase text-black">
                {{ $page.props.flash.success }}
            </p>
        </div>

        <!-- Support Modal -->
        <Modal :show="showSupportModal" @close="closeSupportModal">
            <div
                class="border-3 border-black bg-white p-6 font-sans shadow-none"
            >
                <h2
                    class="mb-6 border-b-3 border-black pb-2 text-3xl font-black uppercase tracking-tight"
                >
                    Support {{ page.title }}
                </h2>

                <form @submit.prevent="submitSupport" class="space-y-6">
                    <div>
                        <InputLabel
                            for="supporter_name"
                            value="Your name"
                            class="text-xs font-black uppercase"
                        />
                        <TextInput
                            id="supporter_name"
                            v-model="form.supporter_name"
                            type="text"
                            class="mt-1 block w-full text-lg font-bold"
                            autocomplete="name"
                            placeholder="ANONYMOUS"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.supporter_name"
                        />
                    </div>

                    <div>
                        <InputLabel
                            for="message"
                            value="Message"
                            class="text-xs font-black uppercase"
                        />
                        <textarea
                            id="message"
                            v-model="form.message"
                            rows="3"
                            class="mt-1 block w-full border-2 border-black bg-white p-2 text-lg font-bold shadow-neo-sm focus:border-black focus:ring-0"
                            placeholder="SAY SOMETHING NICE..."
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.message"
                        />
                    </div>

                    <div>
                        <InputLabel
                            for="amount"
                            value="Amount (cents)"
                            class="text-xs font-black uppercase"
                        />
                        <div class="relative">
                            <TextInput
                                id="amount"
                                v-model="form.amount"
                                type="number"
                                min="100"
                                max="10000"
                                step="100"
                                class="mt-1 block w-full text-center text-3xl font-black"
                            />
                        </div>
                        <p
                            class="mt-2 text-center text-xs font-bold uppercase text-gray-500"
                        >
                            100 cents = $1.00
                        </p>
                        <InputError
                            class="mt-2"
                            :message="form.errors.amount"
                        />
                    </div>

                    <div
                        class="mt-8 flex items-center justify-between gap-4 border-t-3 border-black pt-4"
                    >
                        <button
                            type="button"
                            @click="closeSupportModal"
                            class="border-2 border-black bg-white px-6 py-3 text-sm font-black uppercase shadow-neo transition-all hover:-translate-y-0.5 hover:shadow-neo-sm"
                        >
                            Cancel
                        </button>
                        <PrimaryButton
                            class="w-full justify-center bg-neo-green px-8 py-3 text-sm font-black text-black hover:bg-green-400"
                            :class="{ 'opacity-50': form.processing }"
                            :disabled="form.processing"
                        >
                            Send $$$
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
