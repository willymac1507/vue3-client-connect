<script setup>
defineProps({
    title: String,
});
</script>
<template>
    <div
        class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow mb-6"
    >
        <div class="px-4 py-5 sm:px-6">
            <div class="flex justify-between items-center">
                <h3>{{ title }}</h3>
            </div>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <slot />
        </div>
        <div class="px-4 py-5 sm:p-6">
            <slot name="footer" />
        </div>
    </div>
</template>
<style />
