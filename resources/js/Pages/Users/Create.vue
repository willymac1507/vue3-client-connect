<script setup>
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import { PhotoIcon } from "@heroicons/vue/24/solid";

import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

defineProps({
    breadcrumbs: Object,
});
let text = ref("");
let form = useForm({
    firstname: null,
    surname: null,
    email: null,
});

function submitForm() {
    alert("Submitted");
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
                            <!--                            <div-->
                            <!--                                class="sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:py-6"-->
                            <!--                            >-->
                            <!--                                <label-->
                            <!--                                    class="block text-sm/6 font-medium text-gray-900"-->
                            <!--                                    for="photo"-->
                            <!--                                    >Photo</label-->
                            <!--                                >-->
                            <!--                                <div class="mt-2 sm:col-span-2 sm:mt-0">-->
                            <!--                                    <div class="flex items-center gap-x-3">-->
                            <!--                                        <UserCircleIcon-->
                            <!--                                            aria-hidden="true"-->
                            <!--                                            class="size-12 text-gray-300"-->
                            <!--                                        />-->
                            <!--                                        <button-->
                            <!--                                            class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50"-->
                            <!--                                            type="button"-->
                            <!--                                        >-->
                            <!--                                            Change-->
                            <!--                                        </button>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="first-name"
                                    >First name</label
                                >
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <input
                                        id="first-name"
                                        autocomplete="given-name"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                        name="first-name"
                                        type="text"
                                    />
                                </div>
                            </div>
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="last-name"
                                    >Last name</label
                                >
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <input
                                        id="last-name"
                                        autocomplete="family-name"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-xs sm:text-sm/6"
                                        name="last-name"
                                        type="text"
                                    />
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
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <input
                                        id="email"
                                        autocomplete="email"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-md sm:text-sm/6"
                                        name="email"
                                        type="email"
                                    />
                                </div>
                            </div>
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6"
                            >
                                <label
                                    class="block text-sm/6 font-medium text-gray-900 sm:pt-1.5"
                                    for="cover-photo"
                                    >Cover photo</label
                                >
                                <div class="mt-2 sm:col-span-2 sm:mt-0">
                                    <div
                                        class="flex max-w-2xl justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                                    >
                                        <div class="text-center">
                                            <PhotoIcon
                                                aria-hidden="true"
                                                class="mx-auto size-12 text-gray-300"
                                            />
                                            <div
                                                class="mt-4 flex text-sm/6 text-gray-600"
                                            >
                                                <label
                                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500"
                                                    for="file-upload"
                                                >
                                                    <span>Upload a file</span>
                                                    <input
                                                        id="file-upload"
                                                        class="sr-only"
                                                        name="file-upload"
                                                        type="file"
                                                    />
                                                </label>
                                                <p class="pl-1">
                                                    or drag and drop
                                                </p>
                                            </div>
                                            <p class="text-xs/5 text-gray-600">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
