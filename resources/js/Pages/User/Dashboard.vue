<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PageSection from "@/Components/PageSection.vue";
import { Head } from "@inertiajs/vue3";
import DashCalendar from "@/Pages/User/DashCalendar.vue";

defineProps({
    can: Object,
});
</script>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout :can="can">
        <template v-slot:header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <PageSection>
                    <template v-slot:header>
                        <div class="flex justify-between items-center">
                            <h3>Calendar</h3>
                        </div>
                    </template>
                    <DashCalendar />
                </PageSection>
                <PageSection>
                    <template v-slot:header>
                        <div class="flex justify-between items-center">
                            <h3>Messages</h3>
                        </div>
                    </template>
                </PageSection>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
