<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { format, isToday } from "date-fns";
import MessageLink from "@/Components/MessageLink.vue";

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
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-4 p-6 divide-y-4"
                >
                    <div
                        v-for="message in messages.data"
                        class="container-md py-1 flex flex-col align-left"
                    >
                        <div class="flex justify-between">
                            <div class="font-semibold">
                                <MessageLink
                                    :href="'message/' + message.id + '/show'"
                                    :un-read="!message.isRead"
                                    >{{ message.sender.name }}
                                </MessageLink>
                            </div>
                            <div
                                class="ml-auto text-gray-400 text-sm"
                                v-text="
                                    isToday(message.created_at)
                                        ? format(message.created_at, 'HH:mm')
                                        : format(
                                              message.created_at,
                                              'dd/MM/yyyy',
                                          )
                                "
                            />
                        </div>
                        <div class="truncate w-3/4">
                            {{ message.body }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style />
