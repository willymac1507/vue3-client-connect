<script setup>
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";

let props = defineProps({
    orgsToDelete: Object,
});
</script>
<template>
    <PageLayout title="Organisations">
        <PageCard
            description="Delete one or more organisations from the database."
            title="Delete Organisations"
        >
            {{ orgsToDelete }}
        </PageCard>
    </PageLayout>
</template>
<style />
