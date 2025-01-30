<script setup>
import NavTabs from "@/Pages/Messages/NavTabs.vue";
import { format, isToday } from "date-fns";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";
import Card from "@/Pages/Messages/Card.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Paginator from "@/Components/Paginator.vue";
import { router } from "@inertiajs/vue3";

const previewOpen = ref(false);
let previewMessage = ref([]);

let props = defineProps({
    messages: Object,
    status: String,
});

function markAsRead(id) {
    this.previewOpen = false;
    router.patch(`/message/${id}/update`);
}

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
    <TransitionRoot :show="previewOpen" as="template">
        <Dialog class="relative z-10" @close="previewOpen = false">
            <TransitionChild
                as="template"
                enter="ease-in-out duration-500"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in-out duration-500"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
            </TransitionChild>
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div
                        class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                    >
                        <TransitionChild
                            as="template"
                            enter="transform transition ease-in-out duration-500 sm:duration-700"
                            enter-from="translate-x-full"
                            enter-to="translate-x-0"
                            leave="transform transition ease-in-out duration-500 sm:duration-700"
                            leave-from="translate-x-0"
                            leave-to="translate-x-full"
                        >
                            <DialogPanel
                                class="pointer-events-auto w-screen max-w-md"
                            >
                                <div
                                    class="flex h-full flex-col overflow-y-scroll bg-gray-100 py-6 shadow-xl"
                                >
                                    <div class="px-4 sm:px-6">
                                        <div
                                            class="flex items-start justify-between"
                                        >
                                            <DialogTitle
                                                class="text-base font-semibold text-gray-900"
                                            >
                                                <span v-if="status === 'sent'"
                                                    >To:
                                                    {{
                                                        previewMessage.recipient
                                                            .name
                                                    }}</span
                                                >
                                                <span v-if="status !== 'sent'"
                                                    >From:
                                                    {{
                                                        previewMessage.sender
                                                            .name
                                                    }}</span
                                                >
                                            </DialogTitle>
                                            <div
                                                class="ml-3 flex h-7 items-center"
                                            >
                                                <button
                                                    class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-hidden"
                                                    type="button"
                                                    @click="previewOpen = false"
                                                >
                                                    <span
                                                        class="absolute -inset-2.5"
                                                    />
                                                    <span class="sr-only"
                                                        >Close panel</span
                                                    >
                                                    <XMarkIcon
                                                        aria-hidden="true"
                                                        class="size-6"
                                                    />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="relative mt-6 flex-1 px-4 sm:px-6 space-y-6"
                                    >
                                        <Card title="Subject"
                                            >{{ previewMessage.subject }}
                                        </Card>
                                        <Card title="Body">
                                            {{ previewMessage.body }}
                                        </Card>
                                        <Card title="Booking">
                                            Booking details here
                                            <secondary-button
                                                >view
                                            </secondary-button>
                                        </Card>
                                        <Card title="Actions">
                                            <div
                                                class="flex flex-col sm:flex-row justify-between"
                                            >
                                                <PrimaryButton
                                                    v-if="status !== 'sent'"
                                                    >Reply
                                                </PrimaryButton>
                                                <PrimaryButton v-else
                                                    >Forward
                                                </PrimaryButton>
                                                <SecondaryButton
                                                    v-if="
                                                        !previewMessage.isRead &&
                                                        status !== 'sent'
                                                    "
                                                    @click="
                                                        markAsRead(
                                                            previewMessage.id,
                                                        )
                                                    "
                                                    >Mark as read
                                                </SecondaryButton>
                                                <SecondaryButton
                                                    v-if="
                                                        previewMessage.isRead &&
                                                        status !== 'sent'
                                                    "
                                                    >Mark as unread
                                                </SecondaryButton>
                                                <DangerButton
                                                    >Flag
                                                </DangerButton>
                                            </div>
                                        </Card>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
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
