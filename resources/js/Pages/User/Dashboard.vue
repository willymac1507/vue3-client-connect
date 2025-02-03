<!--suppress HtmlRequiredTitleElement -->
<script setup>
import PageSection from "@/Components/PageSection.vue";
import DashCalendar from "@/Pages/User/Partials/DashCalendar.vue";
import PageLayout from "@/Components/PageLayout.vue";

defineProps({
    can: Object,
    bookings: Object,
});
</script>
<template>
    <PageLayout title="Dashboard">
        <PageSection>
            <template v-slot:header>
                <div class="flex justify-between items-center">
                    <h3>Calendar</h3>
                </div>
            </template>
            <DashCalendar :bookings="bookings" />
        </PageSection>
        <PageSection>
            <template v-slot:header>
                <div class="flex justify-between items-center">
                    <h3>Messages</h3>
                </div>
            </template>
            <div class="flex justify-between"></div>
        </PageSection>
    </PageLayout>
</template>
