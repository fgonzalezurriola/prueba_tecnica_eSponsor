<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

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
            <h2
                class="text-xl font-black uppercase leading-tight tracking-tighter text-black"
            >
                Creator Page
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden border-3 border-black bg-white shadow-neo-lg sm:rounded-none"
                >
                    <div class="p-6 text-black">
                        <h3
                            class="mb-6 inline-block border-3 border-black bg-neo-yellow px-2 text-2xl font-black uppercase text-black"
                        >
                            Edit Your Profile
                        </h3>

                        <form
                            @submit.prevent="submit"
                            class="mb-8 space-y-6 border-b-4 border-dashed border-black pb-8"
                        >
                            <div>
                                <InputLabel
                                    for="title"
                                    value="Public Name"
                                    class="font-black uppercase"
                                />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full rounded-none border-3 border-black font-bold shadow-neo transition-all focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-neo-sm"
                                    v-model="form.title"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.title"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="slug"
                                    value="Username (Slug)"
                                    class="font-black uppercase"
                                />
                                <div class="flex items-center">
                                    <span
                                        class="border-3 border-r-0 border-black bg-gray-100 px-3 py-2 font-mono font-black text-black"
                                        >/</span
                                    >
                                    <TextInput
                                        id="slug"
                                        type="text"
                                        class="mt-0 block w-full rounded-none border-3 border-black font-bold shadow-neo transition-all focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-neo-sm"
                                        v-model="form.slug"
                                        required
                                        autocomplete="username"
                                    />
                                </div>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.slug"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="bio"
                                    value="Bio"
                                    class="font-black uppercase"
                                />
                                <textarea
                                    id="bio"
                                    class="mt-1 block w-full rounded-none border-3 border-black font-bold shadow-neo transition-all focus:translate-x-[2px] focus:translate-y-[2px] focus:border-black focus:shadow-neo-sm focus:ring-0"
                                    v-model="form.bio"
                                    rows="3"
                                ></textarea>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.bio"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="avatar_path"
                                    value="Avatar URL"
                                    class="font-black uppercase"
                                />
                                <TextInput
                                    id="avatar_path"
                                    type="url"
                                    class="mt-1 block w-full rounded-none border-3 border-black font-bold shadow-neo transition-all focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-neo-sm"
                                    v-model="form.avatar_path"
                                    placeholder="https://..."
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.avatar_path"
                                />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton
                                    :disabled="form.processing"
                                    class="bg-black text-white hover:bg-gray-800"
                                >
                                    Save Changes
                                </PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p
                                        v-if="form.recentlySuccessful"
                                        class="border-2 border-black bg-neo-green px-2 text-sm font-black text-black"
                                    >
                                        SAVED!
                                    </p>
                                </Transition>
                            </div>
                        </form>

                        <div>
                            <h3
                                class="mb-4 inline-block border-3 border-black bg-neo-pink px-2 text-xl font-black uppercase text-black"
                            >
                                Links
                            </h3>

                            <form
                                @submit.prevent="submitLink"
                                class="mb-6 space-y-4"
                            >
                                <div
                                    class="flex flex-col gap-2 sm:flex-row sm:items-center"
                                >
                                    <div class="flex-1">
                                        <InputLabel
                                            for="link-title"
                                            value="Title"
                                            class="font-black uppercase"
                                        />
                                        <TextInput
                                            id="link-title"
                                            type="text"
                                            class="mt-1 block w-full rounded-none border-3 border-black font-bold shadow-neo transition-all focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-neo-sm"
                                            v-model="linkForm.title"
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="linkForm.errors.title"
                                        />
                                    </div>

                                    <div class="flex-1">
                                        <InputLabel
                                            for="link-url"
                                            value="URL"
                                            class="font-black uppercase"
                                        />
                                        <TextInput
                                            id="link-url"
                                            type="url"
                                            class="mt-1 block w-full rounded-none border-3 border-black font-bold shadow-neo transition-all focus:translate-x-[2px] focus:translate-y-[2px] focus:shadow-neo-sm"
                                            v-model="linkForm.url"
                                            required
                                        />
                                        <InputError
                                            class="mt-2"
                                            :message="linkForm.errors.url"
                                        />
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <PrimaryButton
                                        :disabled="linkForm.processing"
                                        class="bg-black text-white hover:bg-gray-800"
                                    >
                                        {{
                                            linkForm.id
                                                ? 'Update Link'
                                                : 'Add Link'
                                        }}
                                    </PrimaryButton>

                                    <button
                                        v-if="linkForm.id"
                                        type="button"
                                        @click="resetLinkForm"
                                        class="border-3 border-black bg-white px-3 py-2 text-xs font-black uppercase shadow-neo transition-all hover:translate-x-[2px] hover:translate-y-[2px] hover:bg-gray-100 hover:shadow-neo-sm"
                                    >
                                        Cancel edit
                                    </button>
                                </div>
                            </form>

                            <div
                                v-if="page.links && page.links.length"
                                class="space-y-2 border-3 border-black bg-gray-50 p-4 shadow-neo"
                            >
                                <div
                                    v-for="link in page.links"
                                    :key="link.id"
                                    class="flex items-center justify-between gap-4 border-3 border-black bg-white px-3 py-2"
                                >
                                    <div>
                                        <p class="text-sm font-black uppercase">
                                            {{ link.title }}
                                        </p>
                                        <a
                                            :href="link.url"
                                            target="_blank"
                                            rel="noreferrer"
                                            class="break-all font-mono text-xs font-bold text-blue-700 underline"
                                        >
                                            {{ link.url }}
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button
                                            type="button"
                                            @click="editLink(link)"
                                            class="border-2 border-black bg-neo-yellow px-3 py-1 text-xs font-black uppercase shadow-neo-sm transition-all hover:translate-x-[2px] hover:translate-y-[2px] hover:bg-yellow-200 hover:shadow-none"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            type="button"
                                            @click="deleteLink(link.id)"
                                            class="border-2 border-black bg-neo-pink px-3 py-1 text-xs font-black uppercase text-white shadow-neo-sm transition-all hover:translate-x-[2px] hover:translate-y-[2px] hover:bg-pink-400 hover:shadow-none"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p
                                v-else
                                class="mt-2 inline-block border-2 border-dashed border-black px-2 py-1 font-mono text-xs font-bold uppercase text-gray-600"
                            >
                                No links yet. Add your first one above.
                            </p>
                        </div>

                        <!-- Supports Section -->
                        <div
                            class="mt-12 border-t-4 border-dashed border-black pt-8"
                        >
                            <div
                                class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between"
                            >
                                <h3
                                    class="inline-block border-3 border-black bg-neo-blue px-2 text-xl font-black uppercase text-white"
                                >
                                    Received Supports
                                </h3>
                                <div
                                    v-if="supports_summary"
                                    class="font-mono text-xs uppercase"
                                >
                                    <div
                                        class="inline-block border-2 border-black bg-neo-yellow px-3 py-1 font-black shadow-neo-sm"
                                    >
                                        Total: ${{
                                            (
                                                supports_summary.total_amount /
                                                100
                                            ).toFixed(2)
                                        }}
                                    </div>
                                    <div
                                        class="mt-1 inline-block border-2 border-black bg-white px-3 py-1 font-black shadow-neo-sm"
                                    >
                                        Supports:
                                        {{ supports_summary.count }}
                                    </div>
                                </div>
                            </div>

                            <div
                                v-if="page.supports && page.supports.length"
                                class="grid gap-4 sm:grid-cols-2"
                            >
                                <div
                                    v-for="support in page.supports"
                                    :key="support.id"
                                    class="border-3 border-black bg-white p-4 shadow-neo transition-all hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-neo-sm"
                                >
                                    <div
                                        class="mb-3 flex items-start justify-between"
                                    >
                                        <span
                                            class="max-w-[120px] truncate border-2 border-black bg-neo-yellow px-1 text-sm font-black uppercase text-black"
                                        >
                                            {{ support.supporter_name }}
                                        </span>
                                        <span
                                            class="font-mono text-xs font-black opacity-60"
                                        >
                                            {{
                                                new Date(
                                                    support.created_at,
                                                ).toLocaleDateString()
                                            }}
                                        </span>
                                    </div>

                                    <div
                                        class="mb-3 text-3xl font-black text-neo-green drop-shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                                    >
                                        ${{ (support.amount / 100).toFixed(2) }}
                                    </div>

                                    <p
                                        v-if="support.message"
                                        class="border-2 border-black bg-gray-50 p-2 font-mono text-sm font-bold italic"
                                    >
                                        "{{ support.message }}"
                                    </p>
                                </div>
                            </div>
                            <p
                                v-else
                                class="inline-block border-2 border-dashed border-black px-2 py-1 font-mono text-xs font-bold uppercase text-gray-600"
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
