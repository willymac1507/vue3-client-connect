<!--suppress HtmlRequiredTitleElement -->
<script setup>
import { Head } from "@inertiajs/vue3";
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import SelectServicesForm from "@/Pages/Services/Partials/SelectServicesForm.vue";

defineProps({
    services: Object,
});
</script>
<template>
    <Head title="Messages" />
    <PageLayout title="Services">
        <PageCard
            description="Select which services you wish to offer clients."
            title="Services Offered"
        >
            <SelectServicesForm :services="services" />
        </PageCard>
    </PageLayout>
</template>
<style />
