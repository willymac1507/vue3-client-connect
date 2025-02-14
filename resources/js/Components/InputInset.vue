<script setup>
const props = defineProps({
    name: String,
    placeholder: String,
});
</script>
<template>
    <div
        class="rounded-md bg-white px-3 pt-2.5 pb-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
    >
        <label
            :for="name.toLowerCase()"
            class="block text-xs font-medium text-gray-900"
            >Name</label
        >
        <input
            :id="name.toLowerCase()"
            :name="name.toLowerCase()"
            :placeholder="placeholder"
            class="block w-full text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
            type="text"
        />
    </div>
</template>
<style />
