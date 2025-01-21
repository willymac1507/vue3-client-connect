<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>
<template>
    <Head title="Super Admin Dashboard" />
    <AuthenticatedLayout>
        <template v-slot:header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Super Admin Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex"></div>
        </div>
    </AuthenticatedLayout>
</template>
