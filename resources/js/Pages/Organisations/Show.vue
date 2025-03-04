<script setup>
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import { AdvancedMarker, GoogleMap } from "vue3-google-map";
import { Link, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Paginator from "@/Components/Paginator.vue";

const props = defineProps({
    breadcrumbs: Object,
    organisation: Object,
    students: Object,
    roles: Object,
});

const mapsApi = import.meta.env.VITE_MAPS_API_KEY;
const mapId = import.meta.env.VITE_MAPS_MAPID;
const center = { lat: props.organisation.lat, lng: props.organisation.lng };

function editOrg() {
    router.visit(`/organisation/${props.organisation.id}/edit`);
}
</script>
<template>
    <PageLayout :breadcrumbs="breadcrumbs" title="Organisation">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <PageCard
                description="Address, contact and student details."
                title="Organisation Details"
            >
                <template #otherContent>
                    <PrimaryButton @click="editOrg()">Edit</PrimaryButton>
                </template>
                <div class="border-t border-gray-100">
                    <dl class="divide-y divide-gray-100">
                        <div
                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-900">
                                Name
                            </dt>
                            <dd
                                class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"
                            >
                                {{ organisation.name }}
                            </dd>
                        </div>
                        <div
                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-900">
                                Address
                            </dt>
                            <dd
                                class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"
                            >
                                <div>{{ organisation.address1 }}</div>
                                <div v-if="organisation.address2">
                                    {{ organisation.address2 }}
                                </div>
                                <div>{{ organisation.town }}</div>
                                <div>{{ organisation.postcode }}</div>
                            </dd>
                        </div>
                        <div
                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-900">
                                Email address
                            </dt>
                            <dd
                                class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"
                            >
                                <a
                                    :href="`mailto:${organisation.email}`"
                                    class="text-blue-800 hover:underline"
                                    v-text="organisation.email"
                                />
                            </dd>
                        </div>
                        <div
                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-900">
                                Contact
                            </dt>
                            <dd
                                class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"
                            >
                                <div>
                                    {{ organisation.contact }}
                                </div>
                                <a
                                    :href="`tel:${organisation.telephone}`"
                                    class="text-blue-800 hover:underline"
                                    v-text="organisation.telephone"
                                />
                            </dd>
                        </div>
                        <div
                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-900">
                                Location
                            </dt>
                            <dd
                                class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"
                            >
                                <GoogleMap
                                    :api-key="mapsApi"
                                    :center="center"
                                    :map-Id="mapId"
                                    :zoom="12"
                                    style="width: 100%; height: 500px"
                                >
                                    <AdvancedMarker
                                        :options="{ position: center }"
                                    />
                                </GoogleMap>
                            </dd>
                        </div>
                        <div
                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm/6 font-medium text-gray-900">
                                Students
                                <PrimaryButton
                                    class="ml-6"
                                    @click="
                                        router.get('/user/create', {
                                            organisation: props.organisation.id,
                                        })
                                    "
                                    >Add Student
                                </PrimaryButton>
                            </dt>
                            <dd
                                class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                            >
                                <ul
                                    class="divide-y divide-gray-100 rounded-md border border-gray-200"
                                    role="list"
                                >
                                    <li
                                        v-for="student in students.data"
                                        class="flex items-center justify-between py-4 pr-5 pl-4 text-sm/6"
                                    >
                                        <div
                                            class="flex w-0 flex-1 items-center"
                                        >
                                            <div
                                                class="ml-4 flex min-w-0 flex-1 gap-2"
                                            >
                                                <span>{{
                                                    student.full_name
                                                }}</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-x-2">
                                            <div
                                                v-for="role in student.roles"
                                                :class="{
                                                    'text-green-700 ring-green-600/20 bg-green-50':
                                                        role === 'client',
                                                    'text-red-700 ring-red-600/20 bg-red-50':
                                                        role === 'student',
                                                    'text-blue-700 ring-blue-600/20 bg-blue-50':
                                                        role === 'superUser',
                                                    'text-purple-700 ring-purple-600/20 bg-purple-50':
                                                        role === 'admin',
                                                }"
                                                class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset"
                                            >
                                                {{ role }}
                                            </div>
                                        </div>
                                        <div class="ml-4 shrink-0">
                                            <Link
                                                :href="`/user/${student.id}/show`"
                                                class="font-medium text-indigo-600 hover:text-indigo-500"
                                                >View
                                            </Link>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
                <Paginator :data="students"></Paginator>
            </PageCard>
        </div>
    </PageLayout>
</template>
<style />
