<script setup>
const props = defineProps({
    name: String,
    placeholder: String,
});
</script>
<template>
    <label
        :for="name.toLowerCase()"
        class="block text-xs font-medium text-gray-900"
        >{{ name }}</label
    >
    <input
        :id="name.toLowerCase()"
        :name="name.toLowerCase()"
        :placeholder="placeholder"
        class="border-transparent block w-full text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
        type="text"
    />
</template>
<style />
