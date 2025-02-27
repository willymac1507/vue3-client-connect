<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    items: {
        type: Object,
        required: true,
    },
    separator: {
        type: String,
        default: ">",
    },
});
</script>
<template>
    <nav aria-label="breadcrumb">
        <ol class="flex space-x-2 text-xs">
            <li
                v-for="(item, index) in items"
                :key="index"
                class="flex items-center"
            >
                <Link
                    v-if="item.url"
                    :href="item.url"
                    class="text-blue-600 hover:underline"
                    >{{ item.title }}
                </Link>
                <span v-else class="text-gray-500">{{ item.label }}</span>
                <span
                    v-if="index < items.length - 1"
                    class="mx-2 text-gray-400"
                    >{{ separator }}</span
                >
            </li>
        </ol>
    </nav>
</template>
<style />
