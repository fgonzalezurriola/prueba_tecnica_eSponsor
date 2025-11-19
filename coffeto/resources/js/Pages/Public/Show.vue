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

    <div class="min-h-screen bg-neo-yellow flex flex-col items-center justify-center p-4 font-sans">
        <div class="w-full max-w-md">
            <!-- Profile Card -->
            <div class="bg-white border-3 border-black shadow-neo-lg p-8 mb-8 text-center">
                <!-- Avatar -->
                <div class="w-32 h-32 mx-auto mb-6 bg-gray-200 border-3 border-black overflow-hidden relative shadow-neo">
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
                <h1 class="text-4xl font-black uppercase mb-2 tracking-tighter break-words leading-none">
                    {{ page.title }}
                </h1>

                <!-- Bio -->
                <p class="text-black font-bold mb-0 border-t-3 border-black pt-4 mt-4 text-lg">
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
                    class="block w-full bg-white border-3 border-black p-4 text-center font-black uppercase hover:bg-neo-blue hover:text-white transition-all shadow-neo hover:-translate-y-1 hover:shadow-neo-lg text-lg"
                >
                    {{ link.title }}
                </a>
                
                <div v-if="page.links.length === 0" class="text-center font-bold text-black/50 italic border-2 border-dashed border-black/20 p-4">
                    No links added yet.
                </div>
            </div>

            <!-- Support Button -->
            <button
                type="button"
                @click="openSupportModal"
                class="w-full bg-neo-pink border-3 border-black text-white p-6 text-2xl font-black uppercase shadow-neo hover:bg-pink-400 hover:-translate-y-1 hover:shadow-neo-lg transition-all flex items-center justify-center gap-3"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8 border-2 border-black bg-white text-black p-1 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                  <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                </svg>
                 Support Me
            </button>

            <!-- Footer branding -->
            <div class="mt-12 text-center font-black text-sm uppercase tracking-widest opacity-100">
                <span class="bg-black text-white px-2 py-1">Powered by Coffeto</span>
            </div>
        </div>

        <!-- Success Message -->
        <div
            v-if="$page.props.flash.success"
            class="fixed bottom-4 right-4 z-50 border-3 border-black bg-neo-green p-4 shadow-neo-lg animate-bounce"
        >
            <p class="font-black uppercase text-black text-lg">
                {{ $page.props.flash.success }}
            </p>
        </div>

        <!-- Support Modal -->
        <Modal :show="showSupportModal" @close="closeSupportModal">
            <div class="border-3 border-black bg-white p-6 font-sans shadow-none">
                <h2 class="mb-6 text-3xl font-black uppercase tracking-tight border-b-3 border-black pb-2">
                    Support {{ page.title }}
                </h2>

                <form @submit.prevent="submitSupport" class="space-y-6">
                    <div>
                        <InputLabel for="supporter_name" value="Your name" class="uppercase font-black text-xs" />
                        <TextInput
                            id="supporter_name"
                            v-model="form.supporter_name"
                            type="text"
                            class="mt-1 block w-full text-lg font-bold"
                            autocomplete="name"
                            placeholder="ANONYMOUS"
                        />
                        <InputError class="mt-2" :message="form.errors.supporter_name" />
                    </div>

                    <div>
                        <InputLabel for="message" value="Message" class="uppercase font-black text-xs" />
                        <textarea
                            id="message"
                            v-model="form.message"
                            rows="3"
                            class="mt-1 block w-full border-2 border-black bg-white p-2 text-lg font-bold focus:border-black focus:ring-0 shadow-neo-sm"
                            placeholder="SAY SOMETHING NICE..."
                        />
                        <InputError class="mt-2" :message="form.errors.message" />
                    </div>

                    <div>
                        <InputLabel for="amount" value="Amount (cents)" class="uppercase font-black text-xs" />
                        <div class="relative">
                            <TextInput
                                id="amount"
                                v-model.number="form.amount"
                                type="number"
                                min="100"
                                max="10000"
                                step="100"
                                class="mt-1 block w-full text-3xl font-black text-center"
                            />
                        </div>
                        <p class="mt-2 text-xs font-bold uppercase text-gray-500 text-center">
                            100 cents = $1.00
                        </p>
                        <InputError class="mt-2" :message="form.errors.amount" />
                    </div>

                    <div class="mt-8 flex items-center justify-between gap-4 pt-4 border-t-3 border-black">
                        <button
                            type="button"
                            @click="closeSupportModal"
                            class="border-2 border-black bg-white px-6 py-3 text-sm font-black uppercase shadow-neo hover:-translate-y-0.5 hover:shadow-neo-sm transition-all"
                        >
                            Cancel
                        </button>
                        <PrimaryButton
                            class="bg-neo-green text-black px-8 py-3 text-sm font-black hover:bg-green-400 w-full justify-center"
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
 
