<script setup>
import PageLayout from "@/Components/PageLayout.vue";
import {
    BuildingOfficeIcon,
    CalendarDaysIcon,
    EnvelopeIcon,
    UserCircleIcon,
} from "@heroicons/vue/20/solid";
import InfoAlert from "@/Components/InfoAlert.vue";
import { ref } from "vue";

const props = defineProps({
    user: Object,
    organisation: Object,
    bookingsAsClient: Object,
    bookingsAsStudent: Object,
});
let roleInfo = ref(false);
let isClient = props.user.roles.some((role) => role.role === "client");
let isStudent = props.user.roles.some((role) => role.role === "student");
</script>
<template>
    <PageLayout title="User Admin">
        <InfoAlert v-show="roleInfo" class="absolute left-0 top-0 w-full">
            This role allows the user to search for, and book, appointments.
        </InfoAlert>
        <div class="lg:col-start-3 lg:row-end-1">
            <h2 class="sr-only">Summary</h2>
            <div class="rounded-lg bg-gray-50 ring-1 shadow-xs ring-gray-900/5">
                <dl class="flex flex-wrap">
                    <div class="flex-auto pt-6 pl-6">
                        <dd class="mt-1 text-base font-semibold text-gray-900">
                            <img
                                :src="user.profile_picture_path"
                                alt="profile pic"
                                height="100px"
                            />
                        </dd>
                    </div>
                    <div class="flex-none self-center px-6 pt-4">
                        <dt class="sr-only">Roles</dt>
                        <dd class="space-x-1">
                            <div
                                v-for="role in user.roles"
                                :class="{
                                    'text-green-700 ring-green-600/20 bg-green-50':
                                        role.role === 'client',
                                    'text-red-700 ring-red-600/20 bg-red-50':
                                        role.role === 'student',
                                    'text-blue-700 ring-blue-600/20 bg-blue-50':
                                        role.role === 'superUser',
                                    'text-purple-700 ring-purple-600/20 bg-purple-50':
                                        role.role === 'admin',
                                }"
                                class="cursor-pointer inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset"
                                @click="roleInfo = !roleInfo"
                            >
                                {{ role.role }}
                            </div>
                        </dd>
                    </div>
                    <div
                        class="mt-6 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6"
                    >
                        <dt class="flex-none">
                            <span class="sr-only">User</span>
                            <UserCircleIcon
                                aria-hidden="true"
                                class="h-6 w-5 text-gray-400"
                            />
                        </dt>
                        <dd class="text-sm/6 font-medium text-gray-900">
                            {{ user.name }}
                        </dd>
                    </div>
                    <div
                        v-if="user.organisation"
                        class="mt-4 flex w-full flex-none gap-x-4 px-6"
                    >
                        <dt class="flex-none">
                            <span class="sr-only">Organisation</span>
                            <BuildingOfficeIcon
                                aria-hidden="true"
                                class="h-6 w-5 text-gray-400"
                            />
                        </dt>
                        <dd class="text-sm/6 text-gray-500">
                            {{ user.organisation.name }}
                        </dd>
                    </div>
                    <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                        <dt class="flex-none">
                            <span class="sr-only">Status</span>
                            <EnvelopeIcon
                                aria-hidden="true"
                                class="h-6 w-5 text-gray-400"
                            />
                        </dt>
                        <dd class="text-sm/6 text-gray-500">
                            <a
                                :href="`mailto:${user.email}`"
                                class="text-blue-500 hover:underline"
                                >{{ user.email }}</a
                            >
                        </dd>
                    </div>
                </dl>
                <div class="mt-6 border-t border-gray-900/5 px-6 py-6">
                    <dl v-if="isClient">
                        <dt class="flex-none">
                            <span class="sr-only">Date created</span>
                            <CalendarDaysIcon
                                aria-hidden="true"
                                class="h-6 w-5 text-gray-400"
                            />
                        </dt>
                        <dd>Bookings as Student</dd>
                        <dd v-for="booking in bookingsAsClient">
                            {{ booking.id }}
                        </dd>
                    </dl>
                    <dl v-if="isStudent">
                        <dt>Bookings as a student.</dt>
                        <dd v-for="booking in bookingsAsStudent">
                            {{ booking.id }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </PageLayout>
</template>
<style />
