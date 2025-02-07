<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    title: String,
});

let showFlash = ref(usePage().props.flash);
setTimeout(() => {
    showFlash.value = false;
}, 2000);
</script>
<template>
    <Head :title="title" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ title }}
                </h2>
                <slot name="otherContent" />
            </div>
        </template>
        <Transition></Transition>
        <div class="py-12 relative">
            <Transition>
                <div
                    v-show="showFlash"
                    class="w-screen absolute top-0 left-0 text-center px-8 font-bold text-white"
                >
                    <div
                        v-if="usePage().props.flash.success"
                        class="bg-green-500"
                    >
                        {{ usePage().props.flash.success }}
                    </div>
                    <div v-if="usePage().props.flash.error" class="bg-red-500">
                        {{ usePage().props.flash.error }}
                    </div>
                </div>
            </Transition>
            <div
                class="flex flex-col mx-auto max-w-7xl sm:px-6 lg:px-8 gap-y-4"
            >
                <slot />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style />
