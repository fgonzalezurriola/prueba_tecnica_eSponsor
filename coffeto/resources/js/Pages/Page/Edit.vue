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

const submit = () => {
    form.post(route('page.update'), {
        onSuccess: () => form.reset(),
    });
};
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

                        <form @submit.prevent="submit" class="space-y-6">
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
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
