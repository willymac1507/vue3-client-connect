<!--suppress HtmlRequiredTitleElement -->
<script setup>
import { Head, router, usePage } from "@inertiajs/vue3";
import MessageTable from "./Partials/MessageTable.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, watch } from "vue";
import PageLayout from "@/Components/PageLayout.vue";

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
    <PageLayout title="Messages">
        <template #otherContent>
            <div>
                <label for="filter" />
                <input
                    id="filter"
                    v-model="search"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:max-w-md sm:text-sm/6"
                    name="filter"
                    placeholder="Search"
                    type="text"
                />
            </div>
            <PrimaryButton
                @click="router.get('/messages/create', { method: 'get' })"
                >New Message
            </PrimaryButton>
        </template>
        <MessageTable :messages="messages" :status="status" />
    </PageLayout>
</template>
<style />
