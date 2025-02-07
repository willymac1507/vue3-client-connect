<script setup>
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import { AdvancedMarker, GoogleMap } from "vue3-google-map";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    organisation: Object,
    students: Object,
});
const center = { lat: props.organisation.lat, lng: props.organisation.lng };
</script>
<template>
    <PageLayout title="Organisation">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <PageCard
                description="Address, contact and student details."
                title="Organisation Details"
            >
                <template #otherContent>
                    <PrimaryButton>Edit</PrimaryButton>
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
                                    :center="center"
                                    :zoom="12"
                                    api-key="AIzaSyD02ckH2mbSZuByAY83vcoT1H-PFOPnQIw"
                                    mapId="475b824d246ce63a"
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
                                <PrimaryButton class="ml-6"
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
                                        v-for="student in students"
                                        class="flex items-center justify-between py-4 pr-5 pl-4 text-sm/6"
                                    >
                                        <div
                                            class="flex w-0 flex-1 items-center"
                                        >
                                            <div
                                                class="ml-4 flex min-w-0 flex-1 gap-2"
                                            >
                                                <span>{{ student.name }}</span>
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
            </PageCard>
        </div>
    </PageLayout>
</template>
<style />
