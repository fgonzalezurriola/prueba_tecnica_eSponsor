<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    page: Object,
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
    form.post(route('page.update'), {
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
            <h2 class="font-black text-xl text-gray-800 dark:text-gray-200 leading-tight uppercase tracking-tighter">
                Creator Page
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] border-4 border-black dark:border-white sm:rounded-none">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-black uppercase mb-6 bg-yellow-300 dark:bg-purple-600 inline-block px-2 border-2 border-black dark:border-white text-black dark:text-white">
                            Edit Your Profile
                        </h3>

                        <form @submit.prevent="submit" class="space-y-6 border-b-4 border-dashed border-black pb-8 mb-8">
                            <div>
                                <InputLabel for="title" value="Public Name" class="uppercase font-bold" />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full rounded-none border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:translate-x-[2px] focus:translate-y-[2px] transition-all"
                                    v-model="form.title"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div>
                                <InputLabel for="slug" value="Username (Slug)" class="uppercase font-bold" />
                                <div class="flex items-center">
                                    <span class="px-3 py-2 bg-gray-100 border-2 border-r-0 border-black text-gray-600 font-mono">/</span>
                                    <TextInput
                                        id="slug"
                                        type="text"
                                        class="mt-0 block w-full rounded-none border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:translate-x-[2px] focus:translate-y-[2px] transition-all"
                                        v-model="form.slug"
                                        required
                                        autocomplete="username"
                                    />
                                </div>
                                <InputError class="mt-2" :message="form.errors.slug" />
                            </div>

                            <div>
                                <InputLabel for="bio" value="Bio" class="uppercase font-bold" />
                                <textarea
                                    id="bio"
                                    class="mt-1 block w-full border-2 border-black dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-none shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:translate-x-[2px] focus:translate-y-[2px] transition-all"
                                    v-model="form.bio"
                                    rows="3"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.bio" />
                            </div>

                            <div>
                                <InputLabel for="avatar_path" value="Avatar URL" class="uppercase font-bold" />
                                <TextInput
                                    id="avatar_path"
                                    type="url"
                                    class="mt-1 block w-full rounded-none border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:translate-x-[2px] focus:translate-y-[2px] transition-all"
                                    v-model="form.avatar_path"
                                    placeholder="https://..."
                                />
                                <InputError class="mt-2" :message="form.errors.avatar_path" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing" class="rounded-none border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all bg-black text-white font-black uppercase">
                                    Save Changes
                                </PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-green-600 font-bold bg-green-100 px-2 border border-black">
                                        SAVED!
                                    </p>
                                </Transition>
                            </div>
                        </form>

                        <div>
                            <h3 class="text-xl font-black uppercase mb-4 bg-lime-300 dark:bg-pink-500 inline-block px-2 border-2 border-black dark:border-white text-black dark:text-white">
                                Links
                            </h3>

                            <form @submit.prevent="submitLink" class="space-y-4 mb-6">
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                    <div class="flex-1">
                                        <InputLabel for="link-title" value="Title" class="uppercase font-bold" />
                                        <TextInput
                                            id="link-title"
                                            type="text"
                                            class="mt-1 block w-full rounded-none border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:translate-x-[2px] focus:translate-y-[2px] transition-all"
                                            v-model="linkForm.title"
                                            required
                                        />
                                        <InputError class="mt-2" :message="linkForm.errors.title" />
                                    </div>

                                    <div class="flex-1">
                                        <InputLabel for="link-url" value="URL" class="uppercase font-bold" />
                                        <TextInput
                                            id="link-url"
                                            type="url"
                                            class="mt-1 block w-full rounded-none border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:translate-x-[2px] focus:translate-y-[2px] transition-all"
                                            v-model="linkForm.url"
                                            required
                                        />
                                        <InputError class="mt-2" :message="linkForm.errors.url" />
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton
                                        :disabled="linkForm.processing"
                                        class="rounded-none border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all bg-black text-white font-black uppercase"
                                    >
                                        {{ linkForm.id ? 'Update Link' : 'Add Link' }}
                                    </PrimaryButton>

                                    <button
                                        v-if="linkForm.id"
                                        type="button"
                                        @click="resetLinkForm"
                                        class="text-xs font-bold uppercase border-2 border-black px-3 py-2 bg-white hover:bg-gray-100 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                                    >
                                        Cancel edit
                                    </button>
                                </div>
                            </form>

                            <div
                                v-if="page.links && page.links.length"
                                class="space-y-2 border-2 border-black p-4 bg-gray-50 dark:bg-gray-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"
                            >
                                <div
                                    v-for="link in page.links"
                                    :key="link.id"
                                    class="flex items-center justify-between gap-4 bg-white dark:bg-gray-800 border-2 border-black px-3 py-2"
                                >
                                    <div>
                                        <p class="font-black uppercase text-sm">
                                            {{ link.title }}
                                        </p>
                                        <a
                                            :href="link.url"
                                            target="_blank"
                                            rel="noreferrer"
                                            class="text-xs font-mono underline text-blue-700 dark:text-blue-400 break-all"
                                        >
                                            {{ link.url }}
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button
                                            type="button"
                                            @click="editLink(link)"
                                            class="text-xs font-bold uppercase border-2 border-black px-3 py-1 bg-yellow-300 hover:bg-yellow-200 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            type="button"
                                            @click="deleteLink(link.id)"
                                            class="text-xs font-bold uppercase border-2 border-black px-3 py-1 bg-red-500 text-white hover:bg-red-400 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p
                                v-else
                                class="text-xs font-mono uppercase text-gray-600 mt-2 border border-dashed border-gray-400 px-2 py-1 inline-block"
                            >
                                No links yet. Add your first one above.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
