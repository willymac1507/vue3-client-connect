<script setup>
import NavTabs from "@/Pages/Messages/NavTabs.vue";
import MessageLink from "@/Components/MessageLink.vue";
import { format, isToday } from "date-fns";
import Paginator from "@/Components/Paginator.vue";

let props = defineProps({
    messages: Object,
    status: String,
});

const tabs = [
    {
        name: "Unread",
        href: "/messages/unread",
        current: props.status === "unread",
    },
    {
        name: "Flagged",
        href: "/messages/flagged",
        current: props.status === "flagged",
    },
    {
        name: "All Mail",
        href: "/messages/all",
        current: props.status === "all",
    },
    { name: "Sent", href: "/messages/sent", current: props.status === "sent" },
];
</script>
<template>
    <div
        class="overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-4 p-6 divide-y-2"
    >
        <NavTabs :tabs="tabs" />
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
                            : format(message.created_at, 'dd/MM/yyyy')
                    "
                />
            </div>
            <div class="truncate w-3/4">
                {{ message.subject }}
            </div>
        </div>
        <Paginator :messages="messages" />
    </div>
</template>
