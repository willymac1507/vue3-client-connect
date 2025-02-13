<script setup>
import { computed, ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { now } from "lodash";
import Paginator from "@/Components/Paginator.vue";

let props = defineProps({
    users: Object,
});
const selectedUsers = ref([]);
const indeterminate = computed(
    () =>
        selectedUsers.value.length > 0 &&
        selectedUsers.value.length < props.users.data.length,
);

function createUser() {
    router.visit("/users/create");
}

function deleteUsers() {
    let usersToDelete = selectedUsers.value;
    selectedUsers.value = [];
    router.post("/users/delete", { users: usersToDelete });
}
</script>
<template>
    <PageLayout :key="now()" title="Users">
        <PageCard
            description="A list of all the users registered."
            title="Users"
        >
            <template #otherContent>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <PrimaryButton @click="createUser()"
                        >Add User
                    </PrimaryButton>
                </div>
            </template>
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div
                            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                        >
                            <div class="relative">
                                <div
                                    v-if="selectedUsers.length > 0"
                                    class="absolute top-0 left-14 flex h-12 items-center space-x-3 bg-white sm:left-12"
                                >
                                    <DangerButton @click="deleteUsers()">
                                        Delete all selected
                                    </DangerButton>
                                </div>
                                <table
                                    class="min-w-full table-fixed divide-y divide-gray-300"
                                >
                                    <thead>
                                        <tr>
                                            <th
                                                class="relative px-7 sm:w-12 sm:px-6"
                                                scope="col"
                                            >
                                                <div
                                                    class="group absolute top-1/2 left-4 -mt-2 grid size-4 grid-cols-1"
                                                >
                                                    <input
                                                        :checked="
                                                            indeterminate ||
                                                            selectedUsers.length ===
                                                                users.length
                                                        "
                                                        :indeterminate="
                                                            indeterminate
                                                        "
                                                        class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                                        type="checkbox"
                                                        @change="
                                                            selectedUsers =
                                                                $event.target
                                                                    .checked
                                                                    ? users.data.map(
                                                                          (o) =>
                                                                              o.id,
                                                                      )
                                                                    : []
                                                        "
                                                    />
                                                    <svg
                                                        class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                                        fill="none"
                                                        viewBox="0 0 14 14"
                                                    >
                                                        <path
                                                            class="opacity-0 group-has-checked:opacity-100"
                                                            d="M3 8L6 11L11 3.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                        />
                                                        <path
                                                            class="opacity-0 group-has-indeterminate:opacity-100"
                                                            d="M3 7H11"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                        />
                                                    </svg>
                                                </div>
                                            </th>
                                            <th
                                                class="py-3.5 text-left text-sm font-semibold text-gray-900"
                                                scope="col"
                                            />
                                            <th
                                                class="min-w-[10rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900"
                                                scope="col"
                                            >
                                                Name
                                            </th>
                                            <th
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                scope="col"
                                            >
                                                Email
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
                                                class="relative py-3.5 pr-4 pl-3 sm:pr-3"
                                                scope="col"
                                            >
                                                <span class="sr-only"
                                                    >View</span
                                                >
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 bg-white"
                                    >
                                        <tr
                                            v-for="(
                                                user, userIdx
                                            ) in users.data"
                                            :key="userIdx"
                                            :class="[
                                                selectedUsers.includes(
                                                    user.id,
                                                ) && 'bg-gray-50',
                                            ]"
                                        >
                                            <td
                                                class="relative px-7 sm:w-12 sm:px-6"
                                            >
                                                <div
                                                    v-if="
                                                        selectedUsers.includes(
                                                            user.id,
                                                        )
                                                    "
                                                    class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"
                                                ></div>
                                                <div
                                                    class="group absolute top-1/2 left-4 -mt-2 grid size-4 grid-cols-1"
                                                >
                                                    <input
                                                        v-model="selectedUsers"
                                                        :value="user.id"
                                                        class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                                        type="checkbox"
                                                    />
                                                    <svg
                                                        class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                                        fill="none"
                                                        viewBox="0 0 14 14"
                                                    >
                                                        <path
                                                            class="opacity-0 group-has-checked:opacity-100"
                                                            d="M3 8L6 11L11 3.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                        />
                                                        <path
                                                            class="opacity-0 group-has-indeterminate:opacity-100"
                                                            d="M3 7H11"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                        />
                                                    </svg>
                                                </div>
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                                            >
                                                <img
                                                    :src="
                                                        user.profile_picture_path
                                                    "
                                                    alt="profile pic"
                                                    class="rounded-full"
                                                />
                                            </td>
                                            <td
                                                :class="[
                                                    'py-4 pr-3 text-sm font-medium whitespace-nowrap',
                                                    selectedUsers.includes(
                                                        user.id,
                                                    )
                                                        ? 'text-indigo-600'
                                                        : 'text-gray-900',
                                                ]"
                                            >
                                                {{ user.name }}
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                                            >
                                                {{ user.email }}
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                                            >
                                                {{
                                                    user.organisation
                                                        ? user.organisation.name
                                                        : "-"
                                                }}
                                            </td>
                                            <td
                                                class="space-x-1 px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                                            >
                                                <div
                                                    v-for="role in user.roles"
                                                    :class="{
                                                        'text-green-700 ring-green-600/20 bg-green-50':
                                                            role.role ===
                                                            'client',
                                                        'text-red-700 ring-red-600/20 bg-red-50':
                                                            role.role ===
                                                            'student',
                                                        'text-blue-700 ring-blue-600/20 bg-blue-50':
                                                            role.role ===
                                                            'superUser',
                                                        'text-purple-700 ring-purple-600/20 bg-purple-50':
                                                            role.role ===
                                                            'admin',
                                                    }"
                                                    class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset"
                                                >
                                                    {{ role.role }}
                                                </div>
                                            </td>
                                            <td
                                                class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-3"
                                            >
                                                <Link
                                                    :href="`/user/${user.id}/show`"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    View<span class="sr-only"
                                                        >, {{ user.name }}</span
                                                    >
                                                </Link>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <Paginator :key="now()" :data="users" type="Users" />
        </PageCard>
    </PageLayout>
</template>
<style />
