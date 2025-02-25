<script setup>
import { useForm } from "@inertiajs/vue3";
import ValidationError from "@/Pages/Messages/Partials/ValidationError.vue";
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    errors: Object,
});

let form = useForm({
    name: null,
    address1: null,
    address2: null,
    town: null,
    postcode: null,
    country: "United Kingdom",
    email: null,
    telephone: null,
    contactFirstName: null,
    contactLastName: null,
    lat: null,
    lng: null,
});
</script>
<template>
    <PageLayout title="Organisations">
        <PageCard
            description="Create new organisation record."
            title="New Organisation"
        >
            <form @submit.prevent="form.post('/organisations')">
                <input v-model="form.lat" name="lat" type="hidden" />
                <input v-model="form.lng" name="lng" type="hidden" />
                <div class="space-y-12">
                    <div
                        class="flex flex-col space-y-6 border-gray-900/10 pb-12"
                    >
                        <div class="flex w-full gap-x-6 justify-between">
                            <div class="w-1/2 space-y-6">
                                <div>
                                    <label
                                        class="block text-sm/6 font-medium text-gray-900"
                                        for="name"
                                        >Name</label
                                    >
                                    <div class="mt-2">
                                        <input
                                            id="name"
                                            v-model="form.name"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            name="name"
                                            required
                                            type="text"
                                        />
                                        <ValidationError :error="errors.name" />
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-sm/6 font-medium text-gray-900"
                                        for="name"
                                        >Contact</label
                                    >
                                    <div
                                        class="mt-2 flex justify-between space-x-2"
                                    >
                                        <div class="w-1/2">
                                            <input
                                                id="contactFirstName"
                                                v-model="form.contactFirstName"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                                name="contactFirstName"
                                                placeholder="First Name"
                                                required
                                                type="text"
                                            />
                                            <ValidationError
                                                :error="errors.contactFirstName"
                                            />
                                        </div>
                                        <div class="w-1/2">
                                            <input
                                                id="contactLastName"
                                                v-model="form.contactLastName"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                                name="contactLastName"
                                                placeholder="Last Name"
                                                required
                                                type="text"
                                            />
                                            <ValidationError
                                                :error="errors.contactLastName"
                                            />
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <input
                                            id="email"
                                            v-model="form.email"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            name="email"
                                            placeholder="Email"
                                            required
                                            type="text"
                                        />
                                        <ValidationError
                                            :error="errors.email"
                                        />
                                    </div>
                                    <div class="mt-2">
                                        <input
                                            id="telephone"
                                            v-model="form.telephone"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            name="telephone"
                                            placeholder="Telephone"
                                            required
                                            type="text"
                                        />
                                        <ValidationError
                                            :error="errors.telephone"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/2 space-y-6">
                                <div class="flex flex-col w-full gap-2">
                                    <label
                                        class="block text-sm/6 font-medium text-gray-900"
                                        for="address1"
                                        >Address</label
                                    >
                                    <div>
                                        <input
                                            id="address1"
                                            v-model="form.address1"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            name="address1"
                                            placeholder="Address Line 1"
                                            required
                                            type="text"
                                        />
                                        <ValidationError
                                            :error="errors.address1"
                                        />
                                    </div>
                                    <div>
                                        <input
                                            id="address2"
                                            v-model="form.address2"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            name="address2"
                                            placeholder="Address Line 2 (optional)"
                                            type="text"
                                        />
                                        <ValidationError
                                            :error="errors.address2"
                                        />
                                    </div>
                                    <div>
                                        <input
                                            id="town"
                                            v-model="form.town"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            name="town"
                                            placeholder="Town"
                                            required
                                            type="text"
                                        />
                                        <ValidationError :error="errors.town" />
                                    </div>
                                    <div>
                                        <input
                                            id="postcode"
                                            v-model="form.postcode"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            name="postcode"
                                            placeholder="Postcode"
                                            required
                                            type="text"
                                        />
                                        <ValidationError
                                            :error="errors.postcode"
                                        />
                                    </div>
                                    <div>
                                        <input
                                            id="country"
                                            v-model="form.country"
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                            name="country"
                                            placeholder="Country"
                                            required
                                            type="text"
                                        />
                                        <ValidationError
                                            :error="errors.country"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 flex items-center justify-end gap-x-6">
                    <SecondaryButton @click="form.reset()"
                        >Cancel
                    </SecondaryButton>
                    <PrimaryButton :disabled="form.processing" type="submit"
                        >save
                    </PrimaryButton>
                </div>
            </form>
        </PageCard>
    </PageLayout>
</template>
