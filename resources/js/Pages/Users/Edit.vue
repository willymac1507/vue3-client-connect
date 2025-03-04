<script setup>
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import ValidationError from "@/Pages/Messages/Partials/ValidationError.vue";
import MultiSelect from "@/Components/MultiSelect.vue";

const options = [
    {
        id: 3,
        label: "student",
    },
    {
        id: 4,
        label: "client",
    },
];

const selected = ref([]);

const props = defineProps({
    user: Object,
    roles: Array,
    organisations: Object,
    organisation_id: Number,
});
const page = usePage();
let path = ref("");
let filePresent = ref(false);
if (props.user.profile_picture_path) {
    path.value = props.user.profile_picture_path ?? null;
    filePresent.value = true;
}
let text = ref("");
let form = useForm({
    id: props.user.id,
    firstname: props.user.firstname,
    surname: props.user.surname,
    email: props.user.email,
    mobile: props.user.mobile,
    roles: props.roles,
    organisation_id: props.user.organisation_id,
    profilePicture: null,
    profile_picture_path: props.user.profile_picture_path,
});

async function newFile(e) {
    filePresent = true;
    let file = e.target.files[0];
    form.profilePicture = file;
    path.value = URL.createObjectURL(file);
}

function submitForm() {
    form.post(`/user/${props.user.id}/update`, {
        _method: "PATCH",
        forceFormData: true,
    });
}
</script>
<template>
    <PageLayout title="Users">
        <PageCard description="Add a new user to the database." title="Create">
            <form @submit.prevent="submitForm()">
                <div class="space-y-12 sm:space-y-16">
                    <div>
                        <div
                            class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0"
                        >
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="first-name"
                                    >Name</label
                                >
                                <div
                                    class="flex justify-between space-x-2 w-full items-center"
                                >
                                    <div class="w-1/2">
                                        <input
                                            id="first-name"
                                            v-model="form.firstname"
                                            autocomplete="given-name"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                            name="first-name"
                                            placeholder="First name"
                                            type="text"
                                        />
                                        <ValidationError
                                            :error="form.errors.firstname"
                                        />
                                    </div>
                                    <div class="w-1/2">
                                        <input
                                            id="last-name"
                                            v-model="form.surname"
                                            autocomplete="family-name"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                            name="last-name"
                                            placeholder="Last name"
                                            type="text"
                                        />
                                        <ValidationError
                                            :error="form.errors.surname"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="email"
                                    >Email address</label
                                >
                                <div class="mt-2 sm:mt-0">
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        autocomplete="email"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-md sm:text-sm/6"
                                        name="email"
                                        type="email"
                                    />
                                </div>
                                <ValidationError :error="form.errors.email" />
                            </div>
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="email"
                                    >Mobile</label
                                >
                                <div class="mt-2 sm:mt-0">
                                    <input
                                        id="mobile"
                                        v-model="form.mobile"
                                        autocomplete="mobile"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-md sm:text-sm/6"
                                        name="mobile"
                                        type="tel"
                                    />
                                </div>
                                <ValidationError :error="form.errors.mobile" />
                            </div>
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="roles"
                                    >Roles</label
                                >
                                <MultiSelect
                                    v-model="form.roles"
                                    :options="options"
                                />
                                <ValidationError :error="form.errors.roles" />
                            </div>
                            <div
                                v-if="!form.organisation_id"
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="organisation"
                                    >Organisation</label
                                >
                                <div class="mt-2 sm:mt-0">
                                    <select
                                        id="organisation"
                                        v-model="form.organisation_id"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 disabled:opacity-25"
                                        name="organisation"
                                        required
                                    >
                                        <option disabled value="">
                                            Choose Organisation
                                        </option>
                                        <option
                                            v-for="(
                                                organisation, index
                                            ) in organisations"
                                            :key="index"
                                            :value="organisation.id"
                                        >
                                            {{ organisation.name }}
                                        </option>
                                    </select>
                                </div>
                                <ValidationError
                                    :error="form.errors.organisation_id"
                                />
                            </div>
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="cover-photo"
                                    >Cover photo</label
                                >
                                <div class="flex flex-col items-center">
                                    <label for="file-upload">
                                        <span
                                            class="inline-flex items-center rounded-md border border-transparent bg-cyan-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-cyan-700 focus:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-cyan-900"
                                        >
                                            <span v-if="!filePresent"
                                                >Upload File</span
                                            >
                                            <span v-else>Change File</span>
                                        </span>
                                        <input
                                            id="file-upload"
                                            accept="image/*"
                                            class="sr-only"
                                            name="file-upload"
                                            type="file"
                                            @change="newFile"
                                        />
                                    </label>
                                    <img
                                        :src="path"
                                        alt=""
                                        class="mt-2 rounded-full"
                                        width="100"
                                    />
                                    <ValidationError
                                        :error="form.errors.profilePicture"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    class="w-full h-2 bg-gray-200 rounded-full"
                    max="100"
                />
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button
                        class="text-sm/6 font-semibold text-gray-900"
                        type="button"
                    >
                        Cancel
                    </button>
                    <button
                        class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        type="submit"
                    >
                        Save
                    </button>
                </div>
            </form>
        </PageCard>
    </PageLayout>
</template>
<style />
