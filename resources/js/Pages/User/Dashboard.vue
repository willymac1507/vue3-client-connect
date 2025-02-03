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
        <PageSection title="Bookings">
            <DashCalendar :bookings="bookings" />
        </PageSection>
        <PageSection title="Messages">
            <div class="flex justify-between"></div>
        </PageSection>
    </PageLayout>
</template>
