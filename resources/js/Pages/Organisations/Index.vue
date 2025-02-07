<script setup>
import { computed, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const people = [
    {
        name: "Lindsay Walton",
        title: "Front-end Developer",
        email: "lindsay.walton@example.com",
        role: "Member",
    },
    // More people...
];

const selectedOrgs = ref([]);
const indeterminate = computed(
    () =>
        selectedOrgs.value.length > 0 &&
        selectedOrgs.value.length < people.length,
);

let props = defineProps({
    organisations: Object,
});
</script>
<template>
    <PageLayout title="Organisations">
        <PageCard
            description="A list of all the organisations registered."
            title="Organisations"
        >
            <template #otherContent>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <PrimaryButton>Add Organisation</PrimaryButton>
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
                                    v-if="selectedOrgs.length > 0"
                                    class="absolute top-0 left-14 flex h-12 items-center space-x-3 bg-white sm:left-12"
                                >
                                    <button
                                        class="inline-flex items-center rounded-sm bg-white px-2 py-1 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white"
                                        type="button"
                                    >
                                        Bulk edit
                                    </button>
                                    <button
                                        class="inline-flex items-center rounded-sm bg-white px-2 py-1 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white"
                                        type="button"
                                    >
                                        Delete all
                                    </button>
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
                                                            selectedOrgs.length ===
                                                                organisations.length
                                                        "
                                                        :indeterminate="
                                                            indeterminate
                                                        "
                                                        class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                                        type="checkbox"
                                                        @change="
                                                            selectedOrgs =
                                                                $event.target
                                                                    .checked
                                                                    ? organisations.map(
                                                                          (o) =>
                                                                              o.email,
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
                                                class="min-w-[12rem] py-3.5 pr-3 text-left text-sm font-semibold text-gray-900"
                                                scope="col"
                                            >
                                                Name
                                            </th>
                                            <th
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                scope="col"
                                            >
                                                Town
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
                                                Contact
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
                                                org, orgIdx
                                            ) in organisations"
                                            :key="orgIdx"
                                            :class="[
                                                selectedOrgs.includes(
                                                    org.email,
                                                ) && 'bg-gray-50',
                                            ]"
                                        >
                                            <td
                                                class="relative px-7 sm:w-12 sm:px-6"
                                            >
                                                <div
                                                    v-if="
                                                        selectedOrgs.includes(
                                                            org.email,
                                                        )
                                                    "
                                                    class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"
                                                ></div>
                                                <div
                                                    class="group absolute top-1/2 left-4 -mt-2 grid size-4 grid-cols-1"
                                                >
                                                    <input
                                                        v-model="selectedOrgs"
                                                        :value="org.email"
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
                                                :class="[
                                                    'py-4 pr-3 text-sm font-medium whitespace-nowrap',
                                                    selectedOrgs.includes(
                                                        org.email,
                                                    )
                                                        ? 'text-indigo-600'
                                                        : 'text-gray-900',
                                                ]"
                                            >
                                                {{ org.name }}
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                                            >
                                                {{ org.town }}
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                                            >
                                                {{ org.email }}
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                                            >
                                                {{ org.contact }}
                                            </td>
                                            <td
                                                class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-3"
                                            >
                                                <Link
                                                    :href="`/organisation/${org.id}/show`"
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                >
                                                    View<span class="sr-only"
                                                        >, {{ org.name }}</span
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
        </PageCard>
    </PageLayout>
</template>
<style />
