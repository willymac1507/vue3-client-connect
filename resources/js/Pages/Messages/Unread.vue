<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import MessageTable from "@/Pages/Messages/MessageTable.vue";

const props = defineProps({
    messages: Object,
});
</script>
<template>
    <Head title="Messages" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Messages
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <MessageTable :messages="messages" status="unread" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style />
