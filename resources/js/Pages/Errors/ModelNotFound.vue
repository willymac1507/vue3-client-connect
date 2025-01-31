<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";

defineProps({
    status: Number,
});
</script>
<template>
    <Head title="Messages" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Bookings
                </h2>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-4 p-6 divide-y-2"
                >
                    <main
                        class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8"
                    >
                        <div class="text-center">
                            <p class="text-base font-semibold text-indigo-600">
                                {{ status }}
                            </p>
                            <h1
                                class="mt-4 text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl"
                            >
                                Not found
                            </h1>
                            <p
                                class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8"
                            >
                                Sorry, we couldn’t find what you’re looking for.
                            </p>
                            <div
                                class="mt-10 flex items-center justify-center gap-x-6"
                            >
                                <button
                                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                    @click="router.visit('/')"
                                >
                                    Go back home
                                </button>
                                <a
                                    class="text-sm font-semibold text-gray-900"
                                    href="#"
                                    >Contact support
                                    <span aria-hidden="true">&rarr;</span></a
                                >
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style />
