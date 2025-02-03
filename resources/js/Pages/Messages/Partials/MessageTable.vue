<script setup>
import NavTabs from "@/Pages/Messages/NavTabs.vue";
import { format, isToday } from "date-fns";
import { computed, ref } from "vue";
import Paginator from "@/Components/Paginator.vue";
import { router } from "@inertiajs/vue3";
import SideDrawer from "@/Components/SideDrawer.vue";
import Card from "@/Components/Card.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const previewOpen = ref(false);
let previewMessage = ref([]);

let props = defineProps({
    messages: Object,
    status: String,
});

const tabs = computed(() => {
    return [
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
        {
            name: "Sent",
            href: "/messages/sent",
            current: props.status === "sent",
        },
    ];
});

function toggleRead(id) {
    router.patch(`/message/${id}/read`);
}

function toggleFlag(id) {
    router.patch(`/message/${id}/flag`);
}

function viewBooking(id) {
    router.get(`/booking/${id}/show`);
}
</script>
<template>
    <SideDrawer
        :open="previewOpen"
        title="Message Details"
        @close-preview="previewOpen = false"
    >
        <Card v-if="status !== 'sent'" title="Sender">{{
            previewMessage.sender.name
        }}</Card>
        <Card v-else title="Recipient">{{
            previewMessage.recipient.name
        }}</Card>
        <Card title="Subject">{{ previewMessage.subject }}</Card>
        <Card title="Body">
            {{ previewMessage.body }}
        </Card>
        <Card v-if="previewMessage.booking" title="Booking">
            <div class="flex flex-col sm:flex-row justify-between">
                <div>
                    {{
                        format(
                            previewMessage.booking.start,
                            "EEE do MMM yyyy @ HH:mm",
                        )
                    }}
                </div>
                <SecondaryButton
                    @click="
                        previewOpen = false;
                        viewBooking(previewMessage.id);
                    "
                    >view
                </SecondaryButton>
            </div>
        </Card>
        <Card title="Actions">
            <div class="flex flex-col sm:flex-row justify-between">
                <PrimaryButton v-if="status !== 'sent'">Reply</PrimaryButton>
                <PrimaryButton v-else>Forward</PrimaryButton>
                <SecondaryButton
                    v-if="!previewMessage.isRead && status !== 'sent'"
                    @click="
                        previewOpen = false;
                        toggleRead(previewMessage.id);
                    "
                    >Mark as read
                </SecondaryButton>
                <SecondaryButton
                    v-if="previewMessage.isRead && status !== 'sent'"
                    @click="
                        previewOpen = false;
                        toggleRead(previewMessage.id);
                    "
                    >Mark as unread
                </SecondaryButton>
                <DangerButton
                    v-if="previewMessage.flagged"
                    @click="
                        previewOpen = false;
                        toggleFlag(previewMessage.id);
                    "
                    >Unflag
                </DangerButton>
                <DangerButton
                    v-if="!previewMessage.flagged"
                    @click="
                        previewOpen = false;
                        toggleFlag(previewMessage.id);
                    "
                    >Flag
                </DangerButton>
            </div>
        </Card>
    </SideDrawer>
    <div
        class="overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-4 p-6 divide-y-2"
    >
        <NavTabs :tabs="tabs" />
        <div
            v-for="message in messages.data"
            class="cursor-pointer container-md w-full py-1 flex flex-col align-left"
            type="button"
            @click="
                previewOpen = true;
                previewMessage = message;
            "
        >
            <div class="flex justify-between">
                <div class="font-semibold">
                    <div
                        :class="{
                            'text-cyan-700 font-bold': !message.isRead,
                            'text-gray-500 font-semibold': message.isRead,
                            'text-red-500 font-bold': message.flagged,
                        }"
                        class="pt-1 text-sm leading-5"
                        v-text="
                            status === 'sent'
                                ? message.recipient.name
                                : message.sender.name
                        "
                    />
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
            <div class="mr-auto truncate w-3/4">
                {{ message.subject }}
            </div>
        </div>
        <Paginator :key="messages.total" :messages="messages" />
    </div>
</template>
