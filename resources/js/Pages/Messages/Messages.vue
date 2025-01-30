<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, usePage } from "@inertiajs/vue3";
import MessageTable from "@/Pages/Messages/MessageTable.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, watch } from "vue";
import { now } from "lodash/date.js";

const props = defineProps({
    messages: Object,
    status: String,
});

const page = usePage();

let search = ref("");

watch(search, (value) => {
    router.get(
        window.location.pathname,
        { search: value },
        { preserveState: true },
    );
});
</script>
<template>
    <Head title="Messages" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Messages
                </h2>
                <div>
                    <label for="filter" />
                    <input
                        id="filter"
                        v-model="search"
                        class="rounded-lg"
                        name="filter"
                        placeholder="Search"
                        type="text"
                    />
                </div>
                <PrimaryButton
                    @click="router.get('/messages/create', { method: 'get' })"
                    >New Message
                </PrimaryButton>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <MessageTable
                    :messages="messages"
                    :pag-key="now()"
                    :status="status"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style />
