<!--suppress HtmlRequiredTitleElement -->
<script setup>
import { provide } from "vue";
import CreateForm from "@/Pages/Messages/CreateForm.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

let props = defineProps({
    contacts: Array,
    sender_id: Number,
});

provide("contacts", props.contacts);
</script>
<template>
    <Head title="Messages" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Create Message
                </h2>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <CreateForm :sender="sender_id" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style />
