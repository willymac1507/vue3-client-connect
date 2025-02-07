<script setup>
import PageLayout from "@/Components/PageLayout.vue";

const props = defineProps({
    user: Object,
});
</script>
<template>
    <PageLayout title="User Admin">
        <pre>{{ user }}</pre>
    </PageLayout>
</template>
<style />
