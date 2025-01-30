<script setup>
import { inject, reactive } from "vue";
import { router } from "@inertiajs/vue3";
import ValidationError from "@/Pages/Messages/ValidationError.vue";

let props = defineProps({
    sender: Number,
    errors: Object,
});

let form = reactive({
    sender_id: props.sender,
    recipient_id: "",
    subject: "",
    body: "",
});

let submit = () => {
    router.post("/messages", form);
};

const contacts = inject("contacts");
</script>
<template>
    <div
        class="overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-4 p-6 divide-y-2"
    >
        <form novalidate @submit.prevent="submit">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900">
                        New Message
                    </h2>
                    <div
                        class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                    >
                        <div class="sm:col-span-4">
                            <label
                                class="block text-sm/6 font-medium text-gray-900"
                                for="recipient"
                                >To</label
                            >
                            <div class="mt-2">
                                <select
                                    id="recipient"
                                    v-model="form.recipient_id"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                    name="recipient"
                                    required
                                >
                                    <option disabled value="">
                                        Choose Recipient
                                    </option>
                                    <option
                                        v-for="(
                                            contact, contactIdx
                                        ) in contacts"
                                        :key="contactIdx"
                                        :value="contact.id"
                                    >
                                        {{ contact.name }}
                                    </option>
                                </select>
                                <ValidationError :error="errors.recipient_id" />
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label
                                class="block text-sm/6 font-medium text-gray-900"
                                for="subject"
                                >Subject</label
                            >
                            <div class="mt-2">
                                <input
                                    id="subject"
                                    v-model="form.subject"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                    name="subject"
                                    required
                                    type="text"
                                />
                                <ValidationError :error="errors.subject" />
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label
                                class="block text-sm/6 font-medium text-gray-900"
                                for="recipient"
                                >Body</label
                            >
                            <div class="mt-2">
                                <textarea
                                    id="recipient"
                                    v-model="form.body"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                    name="body"
                                    required
                                    rows="5"
                                />
                                <ValidationError :error="errors.body" />
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
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    type="submit"
                >
                    Send
                </button>
            </div>
        </form>
    </div>
</template>
