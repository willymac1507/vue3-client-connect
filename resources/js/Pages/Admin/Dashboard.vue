<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps(["startDate", "endDate"]);
</script>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template v-slot:header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>
        <p>{{ startDate }}</p>
        <p>{{ endDate }}</p>
    </AuthenticatedLayout>
</template>
<style />
