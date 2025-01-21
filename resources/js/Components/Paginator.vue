<script setup>
import NavLink from "@/Components/NavLink.vue";

let props = defineProps({
    links: Object,
});
</script>
<template>
    <div class="flex justify-center gap-2">
        <div v-for="link in links">
            <NavLink
                v-if="link.url"
                :active="link.active"
                :href="link.url"
                v-html="link.label"
            />
            <span
                v-else
                class="text-gray-400 text-sm font-medium leading-5"
                v-html="link.label"
            />
        </div>
    </div>
</template>
<style />
