<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    users: Object,
    can: Object,
});
</script>
<style />
<template>
    <ul
        class="divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl"
        role="list"
    >
        <li
            v-for="user in users.data"
            :key="user.id"
            class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6"
        >
            <div class="flex w-full min-w-0 gap-x-4">
                <div class="min-w-0 flex w-full items-center justify-between">
                    <div class="flex flex-col">
                        <p class="text-sm font-semibold text-gray-900">
                            <Link href="#">
                                {{ user.name }}
                            </Link>
                        </p>
                        <p class="mt-1 flex text-xs/5 text-gray-500">
                            <a
                                :href="`mailto:${user.email}`"
                                class="relative truncate hover:underline"
                                >{{ user.email }}</a
                            >
                        </p>
                    </div>
                    <div class="ml-auto text-blue-700 hover:underline">
                        <Link
                            v-if="user.can.edit"
                            :href="`/users/${user.id}/edit`"
                            >Edit</Link
                        >
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>
