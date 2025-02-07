<script setup>
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";

const props = defineProps({
    users: Object,
});
const people = [
    {
        name: "Lindsay Walton",
        title: "Front-end Developer",
        department: "Optimization",
        email: "lindsay.walton@example.com",
        role: "Member",
        image: "https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
    // More people...
];
</script>
<template>
    <PageLayout title="Users">
        <PageCard
            description="All users registered on the app."
            title="All Users"
        >
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                        >
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th
                                            class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                            scope="col"
                                        >
                                            Name
                                        </th>
                                        <th
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            scope="col"
                                        >
                                            Organisation
                                        </th>
                                        <th
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                            scope="col"
                                        >
                                            Roles
                                        </th>
                                        <th
                                            class="relative py-3.5 pr-4 pl-3 sm:pr-0"
                                            scope="col"
                                        >
                                            <span class="sr-only">View</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 bg-white"
                                >
                                    <tr
                                        v-for="user in users.data"
                                        :key="user.email"
                                    >
                                        <td
                                            class="py-5 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-0"
                                        >
                                            <div class="flex items-center">
                                                <div class="size-11 shrink-0">
                                                    <img
                                                        :src="
                                                            user.profile_picture_path
                                                        "
                                                        alt=""
                                                        class="size-11 rounded-full"
                                                    />
                                                </div>
                                                <div class="ml-4">
                                                    <div
                                                        class="font-medium text-gray-900"
                                                    >
                                                        {{ user.name }}
                                                    </div>
                                                    <div
                                                        class="mt-1 text-gray-500"
                                                    >
                                                        {{ user.email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="px-3 py-5 text-sm whitespace-nowrap text-gray-500"
                                        >
                                            <div class="text-gray-900">
                                                {{ user.organisation.name }}
                                            </div>
                                            <div class="mt-1 text-gray-500">
                                                {{ user.organisation.town }}
                                            </div>
                                        </td>
                                        <td
                                            class="px-3 py-5 text-sm whitespace-nowrap gap-x-1 text-gray-500"
                                        >
                                            <div
                                                v-for="role in user.roles"
                                                :class="{
                                                    'bg-green-50 ring-green-600/20 text-green-700':
                                                        role.role === 'student',
                                                    'bg-blue-50 ring-blue-600/20 text-blue-700':
                                                        role.role === 'client',
                                                    'bg-orange-50 ring-orange-600/20 text-orange-700':
                                                        role.role === 'admin',
                                                    'bg-red-50 ring-red-600/20 text-red-700':
                                                        role.role ===
                                                        'superUser',
                                                }"
                                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset mr-1"
                                            >
                                                {{ role.role }}
                                            </div>
                                        </td>
                                        <td
                                            class="relative py-5 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0"
                                        >
                                            <a
                                                class="text-indigo-600 hover:text-indigo-900"
                                                href="#"
                                                >View<span class="sr-only"
                                                    >, {{ user.name }}</span
                                                ></a
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </PageCard>
    </PageLayout>
</template>
