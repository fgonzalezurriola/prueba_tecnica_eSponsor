<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    page: Object,
    supports_summary: Object,
});

const form = useForm({
    slug: props.page.slug,
    title: props.page.title,
    bio: props.page.bio,
    avatar_path: props.page.avatar_path,
});

const linkForm = useForm({
    id: null,
    title: '',
    url: '',
    sort_order: 0,
});

const submit = () => {
    form.patch(route('page.update'), {
        preserveScroll: true,
    });
};

const resetLinkForm = () => {
    linkForm.id = null;
    linkForm.title = '';
    linkForm.url = '';
    linkForm.sort_order = props.page.links.length;
};

const submitLink = () => {
    const isEditing = !!linkForm.id;

    const url = isEditing
        ? route('links.update', linkForm.id)
        : route('links.store');

    const method = isEditing ? 'patch' : 'post';

    linkForm[method](url, {
        preserveScroll: true,
        onSuccess: () => {
            resetLinkForm();
        },
    });
};

const editLink = (link) => {
    linkForm.id = link.id;
    linkForm.title = link.title;
    linkForm.url = link.url;
    linkForm.sort_order = link.sort_order ?? 0;
};

const deleteLink = (id) => {
    if (!confirm('Delete this link?')) {
        return;
    }

    linkForm.delete(route('links.destroy', id), {
        preserveScroll: true,
    });
};

resetLinkForm();
</script>

<template>
    <Head title="Manage Page" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-black text-xl text-black leading-tight uppercase tracking-tighter">
                Creator Page
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-neo-lg border-3 border-black sm:rounded-none">
                    <div class="p-6 text-black">
                        <h3 class="text-2xl font-black uppercase mb-6 bg-neo-yellow inline-block px-2 border-3 border-black text-black">
                            Edit Your Profile
                        </h3>

                        <form @submit.prevent="submit" class="space-y-6 border-b-4 border-dashed border-black pb-8 mb-8">
                            <div>
                                <InputLabel for="title" value="Public Name" class="uppercase font-black" />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full rounded-none border-3 border-black shadow-neo focus:shadow-neo-sm focus:translate-x-[2px] focus:translate-y-[2px] transition-all font-bold"
                                    v-model="form.title"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div>
                                <InputLabel for="slug" value="Username (Slug)" class="uppercase font-black" />
                                <div class="flex items-center">
                                    <span class="px-3 py-2 bg-gray-100 border-3 border-r-0 border-black text-black font-black font-mono">/</span>
                                    <TextInput
                                        id="slug"
                                        type="text"
                                        class="mt-0 block w-full rounded-none border-3 border-black shadow-neo focus:shadow-neo-sm focus:translate-x-[2px] focus:translate-y-[2px] transition-all font-bold"
                                        v-model="form.slug"
                                        required
                                        autocomplete="username"
                                    />
                                </div>
                                <InputError class="mt-2" :message="form.errors.slug" />
                            </div>

                            <div>
                                <InputLabel for="bio" value="Bio" class="uppercase font-black" />
                                <textarea
                                    id="bio"
                                    class="mt-1 block w-full border-3 border-black focus:border-black focus:ring-0 rounded-none shadow-neo focus:shadow-neo-sm focus:translate-x-[2px] focus:translate-y-[2px] transition-all font-bold"
                                    v-model="form.bio"
                                    rows="3"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.bio" />
                            </div>

                            <div>
                                <InputLabel for="avatar_path" value="Avatar URL" class="uppercase font-black" />
                                <TextInput
                                    id="avatar_path"
                                    type="url"
                                    class="mt-1 block w-full rounded-none border-3 border-black shadow-neo focus:shadow-neo-sm focus:translate-x-[2px] focus:translate-y-[2px] transition-all font-bold"
                                    v-model="form.avatar_path"
                                    placeholder="https://..."
                                />
                                <InputError class="mt-2" :message="form.errors.avatar_path" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing" class="bg-black text-white hover:bg-gray-800">
                                    Save Changes
                                </PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-black font-black bg-neo-green px-2 border-2 border-black">
                                        SAVED!
                                    </p>
                                </Transition>
                            </div>
                        </form>

                        <div>
                            <h3 class="text-xl font-black uppercase mb-4 bg-neo-pink inline-block px-2 border-3 border-black text-black">
                                Links
                            </h3>

                            <form @submit.prevent="submitLink" class="space-y-4 mb-6">
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                    <div class="flex-1">
                                        <InputLabel for="link-title" value="Title" class="uppercase font-black" />
                                        <TextInput
                                            id="link-title"
                                            type="text"
                                            class="mt-1 block w-full rounded-none border-3 border-black shadow-neo focus:shadow-neo-sm focus:translate-x-[2px] focus:translate-y-[2px] transition-all font-bold"
                                            v-model="linkForm.title"
                                            required
                                        />
                                        <InputError class="mt-2" :message="linkForm.errors.title" />
                                    </div>

                                    <div class="flex-1">
                                        <InputLabel for="link-url" value="URL" class="uppercase font-black" />
                                        <TextInput
                                            id="link-url"
                                            type="url"
                                            class="mt-1 block w-full rounded-none border-3 border-black shadow-neo focus:shadow-neo-sm focus:translate-x-[2px] focus:translate-y-[2px] transition-all font-bold"
                                            v-model="linkForm.url"
                                            required
                                        />
                                        <InputError class="mt-2" :message="linkForm.errors.url" />
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton
                                        :disabled="linkForm.processing"
                                        class="bg-black text-white hover:bg-gray-800"
                                    >
                                        {{ linkForm.id ? 'Update Link' : 'Add Link' }}
                                    </PrimaryButton>

                                    <button
                                        v-if="linkForm.id"
                                        type="button"
                                        @click="resetLinkForm"
                                        class="text-xs font-black uppercase border-3 border-black px-3 py-2 bg-white hover:bg-gray-100 shadow-neo hover:shadow-neo-sm hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                                    >
                                        Cancel edit
                                    </button>
                                </div>
                            </form>

                            <div
                                v-if="page.links && page.links.length"
                                class="space-y-2 border-3 border-black p-4 bg-gray-50 shadow-neo"
                            >
                                <div
                                    v-for="link in page.links"
                                    :key="link.id"
                                    class="flex items-center justify-between gap-4 bg-white border-3 border-black px-3 py-2"
                                >
                                    <div>
                                        <p class="font-black uppercase text-sm">
                                            {{ link.title }}
                                        </p>
                                        <a
                                            :href="link.url"
                                            target="_blank"
                                            rel="noreferrer"
                                            class="text-xs font-mono underline text-blue-700 break-all font-bold"
                                        >
                                            {{ link.url }}
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button
                                            type="button"
                                            @click="editLink(link)"
                                            class="text-xs font-black uppercase border-2 border-black px-3 py-1 bg-neo-yellow hover:bg-yellow-200 shadow-neo-sm hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            type="button"
                                            @click="deleteLink(link.id)"
                                            class="text-xs font-black uppercase border-2 border-black px-3 py-1 bg-neo-pink text-white hover:bg-pink-400 shadow-neo-sm hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p
                                v-else
                                class="text-xs font-mono uppercase text-gray-600 mt-2 border-2 border-dashed border-black px-2 py-1 inline-block font-bold"
                            >
                                No links yet. Add your first one above.
                            </p>
                        </div>

                        <!-- Supports Section -->
                        <div class="mt-12 border-t-4 border-dashed border-black pt-8">
                            <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                                <h3 class="text-xl font-black uppercase bg-neo-blue inline-block px-2 border-3 border-black text-white">
                                    Received Supports
                                </h3>
                                <div v-if="supports_summary" class="text-xs font-mono uppercase">
                                    <div class="border-2 border-black bg-neo-yellow px-3 py-1 inline-block shadow-neo-sm font-black">
                                        Total:
                                        ${{ (supports_summary.total_amount / 100).toFixed(2) }}
                                    </div>
                                    <div class="mt-1 border-2 border-black bg-white px-3 py-1 inline-block shadow-neo-sm font-black">
                                        Supports:
                                        {{ supports_summary.count }}
                                    </div>
                                </div>
                            </div>

                            <div v-if="page.supports && page.supports.length" class="grid gap-4 sm:grid-cols-2">
                                <div
                                    v-for="support in page.supports"
                                    :key="support.id"
                                    class="border-3 border-black p-4 bg-white shadow-neo hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-neo-sm transition-all"
                                >
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="font-black uppercase bg-neo-yellow text-black px-1 border-2 border-black text-sm truncate max-w-[120px]">
                                            {{ support.supporter_name }}
                                        </span>
                                        <span class="font-mono text-xs font-black opacity-60">
                                            {{ new Date(support.created_at).toLocaleDateString() }}
                                        </span>
                                    </div>
                                    
                                    <div class="mb-3 font-black text-3xl text-neo-green drop-shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                                        ${{ (support.amount / 100).toFixed(2) }}
                                    </div>

                                    <p v-if="support.message" class="font-mono text-sm bg-gray-50 p-2 border-2 border-black italic font-bold">
                                        "{{ support.message }}"
                                    </p>
                                </div>
                            </div>
                            <p
                                v-else
                                class="text-xs font-mono uppercase text-gray-600 border-2 border-dashed border-black px-2 py-1 inline-block font-bold"
                            >
                                No supports received yet. Share your page!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
