<template>
    <div
        class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow-sm"
    >
        <div class="font-semibold px-4 py-2 sm:px-6">
            {{ title }}
        </div>
        <div class="px-4 py-5 sm:p-6">
            <slot />
        </div>
    </div>
</template>
<script setup>
defineProps({
    title: String,
});
</script>
