<script setup>
import { Link } from "@inertiajs/vue3";

let props = defineProps({ users: Object });
</script>
<style />
<template>
    <div
        class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow"
    >
        <div class="px-4 py-5 sm:px-6">All Users</div>
        <div class="px-4 py-5 sm:p-6">
            <ul
                class="divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl"
                role="list"
            >
                <li
                    v-for="user in props.users.data"
                    :key="user.id"
                    class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-gray-50 sm:px-6"
                >
                    <div class="flex w-full min-w-0 gap-x-4">
                        <div
                            class="min-w-0 flex w-full items-center justify-between"
                        >
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
                                <Link :href="`/users/${user.id}/edit`"
                                    >Edit
                                </Link>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
