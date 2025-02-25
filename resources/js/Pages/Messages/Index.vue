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
        </template>
        <MessageTable :messages="messages" :status="status" />
    </PageLayout>
</template>
<style />
