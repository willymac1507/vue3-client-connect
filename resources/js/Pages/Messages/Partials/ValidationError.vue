<script setup>
const props = defineProps({
    error: String,
});
</script>
<template>
    <div v-if="error" class="text-xs text-red-500 mt-1" v-text="error" />
</template>
