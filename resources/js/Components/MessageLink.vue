<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

let props = defineProps({
    href: {
        type: String,
        required: true,
    },
    unRead: {
        type: Boolean,
    },
});
const classes = computed(() =>
    props.unRead
        ? "pt-1 text-sm font-bold leading-5 text-cyan-700"
        : "pt-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300",
);
</script>
<template>
    <Link :class="classes" :href="href">
        <slot />
    </Link>
</template>
<style />
