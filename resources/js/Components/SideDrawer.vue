<script setup>
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { ref, watchEffect } from "vue";

const props = defineProps({
    title: String,
    open: Boolean,
});

let previewOpen = ref(false);

watchEffect(() => {
    previewOpen = props.open;
});
</script>
<template>
    <TransitionRoot :show="previewOpen" as="template">
        <Dialog
            class="relative z-10"
            @close="
                $emit('closePreview');
                previewOpen = false;
            "
        >
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
                                                {{ title }}
                                            </DialogTitle>
                                            <div
                                                class="ml-3 flex h-7 items-center"
                                            >
                                                <button
                                                    class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-hidden"
                                                    type="button"
                                                    @click="
                                                        $emit('closePreview');
                                                        previewOpen = false;
                                                    "
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
                                        <slot />
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
<style />
