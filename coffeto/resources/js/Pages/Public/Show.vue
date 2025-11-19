<script setup>
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
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

            <!-- Support Button -->
            <button
                type="button"
                @click="openSupportModal"
                class="w-full bg-pink-500 border-4 border-black text-white p-6 text-xl font-black uppercase shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:bg-pink-400 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all flex items-center justify-center gap-3"
            >
                <span>☕</span> Support Me
            </button>

            <!-- Footer branding -->
            <div class="mt-12 text-center font-bold text-sm uppercase tracking-widest opacity-50">
                Powered by Coffeto
            </div>
        </div>

        <!-- Success Message -->
        <div
            v-if="$page.props.flash.success"
            class="fixed bottom-4 right-4 z-50 border-4 border-black bg-green-400 p-4 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]"
        >
            <p class="font-black uppercase text-black">
                {{ $page.props.flash.success }}
            </p>
        </div>

        <!-- Support Modal -->
        <Modal :show="showSupportModal" @close="closeSupportModal">
            <div class="border-4 border-black bg-yellow-50 p-6 font-mono shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="mb-4 text-2xl font-black uppercase tracking-tight">
                    Support {{ page.title }}
                </h2>

                <form @submit.prevent="submitSupport" class="space-y-4">
                    <div>
                        <InputLabel for="supporter_name" value="Your name" />
                        <TextInput
                            id="supporter_name"
                            v-model="form.supporter_name"
                            type="text"
                            class="mt-1 block w-full border-2 border-black bg-white font-bold"
                            autocomplete="name"
                        />
                        <InputError class="mt-2" :message="form.errors.supporter_name" />
                    </div>

                    <div>
                        <InputLabel for="message" value="Message" />
                        <textarea
                            id="message"
                            v-model="form.message"
                            rows="3"
                            class="mt-1 block w-full border-2 border-black bg-white p-2 text-sm font-bold focus:border-black focus:ring-0"
                        />
                        <InputError class="mt-2" :message="form.errors.message" />
                    </div>

                    <div>
                        <InputLabel for="amount" value="Amount (cents)" />
                        <TextInput
                            id="amount"
                            v-model.number="form.amount"
                            type="number"
                            min="100"
                            max="10000"
                            step="100"
                            class="mt-1 block w-full border-2 border-black bg-white font-bold"
                        />
                        <p class="mt-1 text-xs font-bold uppercase text-gray-600">
                            100 = 1.00 · 500 = 5.00
                        </p>
                        <InputError class="mt-2" :message="form.errors.amount" />
                    </div>

                    <div class="mt-6 flex items-center justify-between gap-4">
                        <button
                            type="button"
                            @click="closeSupportModal"
                            class="border-2 border-black bg-white px-4 py-2 text-xs font-black uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"
                        >
                            Cancel
                        </button>
                        <PrimaryButton
                            class="border-2 border-black bg-green-400 px-6 py-2 text-xs font-black uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Send support
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
 
