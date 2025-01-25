<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    conversations: Object,
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
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg grid gap-y-4 p-6"
                >
                    <div
                        v-for="conversation in conversations"
                        class="text-gray-900 font-bold grid gap-y-2"
                    >
                        {{ conversation.subject }}
                        <div
                            v-for="message in conversation.messages"
                            class="flex justify-between w-full px-6 font-medium"
                        >
                            <div
                                class="basis-3/4 overflow-ellipsis whitespace-nowrap"
                            >
                                {{ message.body }}
                            </div>
                            <div class="basis-1/4 mx-auto text-right">
                                {{ message.sender.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style />
