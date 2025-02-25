<script setup>
import PageLayout from "@/Components/PageLayout.vue";
import PageCard from "@/Components/PageCard.vue";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { AdvancedMarker, GoogleMap } from "vue3-google-map";
import { toNumber } from "lodash";
import { XMarkIcon } from "@heroicons/vue/24/outline";

let props = defineProps({
    organisations: Object,
});

console.log(props.organisations);
let postcode = ref("");
let dataReady = ref(false);
let showOrg = ref(false);
let json = ref("");
let clickedOrg = ref({});
let center = { lat: 51.50354, lng: -0.127695 };

async function searchPostcode() {
    dataReady.value = false;
    let results = await fetch(
        `https://api.postcodes.io/postcodes/${postcode.value}`,
    );
    json = await results.json();
    center = {
        lat: toNumber(json.result.latitude),
        lng: toNumber(json.result.longitude),
    };
    console.log(json);
    dataReady.value = true;
}

function clicked(org) {
    console.log(org.name);
    clickedOrg.value = org;
    showOrg.value = true;
}
</script>
<template>
    <PageLayout title="Search">
        <PageCard
            description="Enter your postcode to find your nearest participating salon / school."
            title="Postcode Search"
        >
            <div class="flex flex-col items-start gap-y-4">
                <input
                    v-model="postcode"
                    class="disabled:opacity-25 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    type="text"
                />
                <PrimaryButton
                    :disabled="!postcode"
                    class="disabled:opacity-25"
                    @click="searchPostcode()"
                    >Search
                </PrimaryButton>
            </div>
        </PageCard>
        <PageCard
            v-show="showOrg"
            description="Click on 'Book' to make a booking."
            title="Organisation Details"
        >
            <template #otherContent>
                <button
                    class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-hidden"
                    type="button"
                    @click="showOrg = false"
                >
                    <span class="absolute -inset-2.5" />
                    <span class="sr-only">Close panel</span>
                    <XMarkIcon aria-hidden="true" class="size-6" />
                </button>
            </template>
            <p class="font-bold">{{ clickedOrg.name }}</p>
            <ul>
                <li>{{ clickedOrg.address1 }}</li>
                <li v-if="clickedOrg.address2">{{ clickedOrg.address2 }}</li>
                <li>{{ clickedOrg.town }}</li>
                <li>{{ clickedOrg.postcode }}</li>
            </ul>
        </PageCard>
        <PageCard
            v-show="dataReady"
            description="Click on a green marker to show more details. Zoom out to see more."
            title="Search Results"
        >
            <GoogleMap
                :center="center"
                :zoom="12"
                api-key=""
                mapId="475b824d246ce63a"
                style="width: 100%; height: 500px"
            >
                <AdvancedMarker :options="{ position: center }" />
                <AdvancedMarker
                    v-for="organisation in organisations"
                    :options="{
                        position: {
                            lat: organisation.lat,
                            lng: organisation.lng,
                        },
                        title: organisation.name,
                        gmpClickable: true,
                    }"
                    :pin-options="{
                        background: 'rgb(21 94 117)',
                        borderColor: 'white',
                        glyphColor: 'white',
                    }"
                    @click="clicked(organisation)"
                />
            </GoogleMap>
        </PageCard>
    </PageLayout>
</template>
<style />
