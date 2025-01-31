<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import SideDrawer from "@/Components/SideDrawer.vue";
import Card from "@/Components/Card.vue";

defineProps({
    bookings: Object,
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
        <SideDrawer title="Booking Details">
            <Card>Hello!</Card>
        </SideDrawer>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-4 p-6 divide-y-2"
                >
                    {{ bookings }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style />
