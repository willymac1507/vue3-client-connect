<script setup>
defineProps({
    title: String,
    description: String,
});
</script>
<template>
    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
        <header class="mb-8">
            <div class="flex justify-between align-top">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ title }}
                </h2>
                <slot name="otherContent" />
            </div>
            <p class="mt-1 text-sm text-gray-600">
                {{ description }}
            </p>
        </header>
        <slot />
    </div>
</template>
<style />
