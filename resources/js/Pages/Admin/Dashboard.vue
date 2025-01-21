<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    can: Object
})
</script>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout :can="can">
        <template v-slot:header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>
</template>
<style/>
