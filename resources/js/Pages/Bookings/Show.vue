<!--suppress HtmlRequiredTitleElement -->
<script setup>
import PageLayout from "@/Components/PageLayout.vue";

defineProps({
    booking: Object,
    client: Object,
    student: Object,
    messages: Object,
});
</script>
<template>
    <PageLayout title="Bookings">
        <div class="flex flex-col">
            <div>{{ booking }}</div>
            <div>{{ client }}</div>
        </div>
    </PageLayout>
</template>
<style />
