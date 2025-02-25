<!--suppress HtmlRequiredTitleElement -->
<script setup>
import { Head } from "@inertiajs/vue3";
import SideDrawer from "@/Components/SideDrawer.vue";
import Card from "@/Components/Card.vue";
import PageLayout from "@/Components/PageLayout.vue";

defineProps({
    bookings: Object,
});
</script>
<template>
    <Head title="Bookings" />
    <PageLayout title="Bookings">
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
    </PageLayout>
</template>
<style />
