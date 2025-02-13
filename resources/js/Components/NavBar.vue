<script setup>
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import { ref } from "vue";

const showingNavigationDropdown = ref(false);
const page = usePage();
</script>
<template>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo
                            class="block h-9 w-auto fill-current text-gray-800"
                        />
                    </Link>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <NavLink
                        :active="route().current('dashboard')"
                        :href="route('dashboard')"
                    >
                        Dashboard
                    </NavLink>
                    <div
                        v-if="usePage().props.can['superAdmin']"
                        class="inline-flex items-center pt-0.5 border-b-2 border-transparent hover:border-gray-300"
                    >
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        class="inline-flex items-center bg-white text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                        type="button"
                                    >
                                        Super Admin

                                        <svg
                                            class="-me-0.5 ms-2 h-4 w-4"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                clip-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                fill-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>
                            <template #content>
                                <DropdownLink :href="route('super.dashboard')">
                                    Dashboard
                                </DropdownLink>
                                <DropdownLink :href="route('organisations')">
                                    Organisations
                                </DropdownLink>
                                <DropdownLink :href="route('users')">
                                    Users</DropdownLink
                                >
                                <DropdownLink href="#"> Bookings</DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                    <NavLink
                        v-if="usePage().props.can['admin']"
                        :active="route().current('admin')"
                        :href="route('admin')"
                        >Admin
                    </NavLink>
                    <NavLink
                        :active="route().current('unreadMessages')"
                        :href="route('unreadMessages')"
                    >
                        Messages
                    </NavLink>
                    <NavLink
                        v-if="usePage().props.can['search']"
                        :active="route().current('search.search')"
                        :href="route('search.search')"
                    >
                        Search
                    </NavLink>
                    <NavLink
                        :active="route().current('allBookings')"
                        :href="route('allBookings')"
                    >
                        Bookings
                    </NavLink>
                </div>
            </div>
            <div class="hidden sm:ms-6 sm:flex sm:items-center">
                <!-- Settings Dropdown -->
                <div class="relative ms-3 pt-1">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button
                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                    type="button"
                                >
                                    {{ page.props.auth.user.name }}

                                    <svg
                                        class="-me-0.5 ms-2 h-4 w-4"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            clip-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            fill-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </template>
                        <template #content>
                            <DropdownLink :href="route('profile.edit')">
                                Profile
                            </DropdownLink>
                            <DropdownLink
                                v-if="usePage().props.can['student']"
                                :href="route('calendar.edit')"
                            >
                                Availability
                            </DropdownLink>
                            <DropdownLink
                                v-if="usePage().props.can['student']"
                                :href="route('services.edit')"
                            >
                                Services
                            </DropdownLink>
                            <DropdownLink
                                :href="route('logout')"
                                as="button"
                                method="post"
                            >
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                    @click="
                        showingNavigationDropdown = !showingNavigationDropdown
                    "
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            :class="{
                                hidden: showingNavigationDropdown,
                                'inline-flex': !showingNavigationDropdown,
                            }"
                            d="M4 6h16M4 12h16M4 18h16"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />
                        <path
                            :class="{
                                hidden: !showingNavigationDropdown,
                                'inline-flex': showingNavigationDropdown,
                            }"
                            d="M6 18L18 6M6 6l12 12"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div
        :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
        }"
        class="sm:hidden"
    >
        <div class="space-y-1 pb-3 pt-2">
            <ResponsiveNavLink
                :active="route().current('dashboard')"
                :href="route('dashboard')"
            >
                Dashboard
            </ResponsiveNavLink>
        </div>
        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pb-1 pt-4">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">
                    {{ $page.props.auth.user.name }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                    {{ $page.props.auth.user.email }}
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <ResponsiveNavLink :href="route('profile.edit')">
                    Profile
                </ResponsiveNavLink>
                <ResponsiveNavLink
                    :href="route('logout')"
                    as="button"
                    method="post"
                >
                    Log Out
                </ResponsiveNavLink>
            </div>
        </div>
    </div>
</template>
<style />
