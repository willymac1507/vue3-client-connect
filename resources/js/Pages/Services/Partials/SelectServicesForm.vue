<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import Multiselect from "vue-multiselect";
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    services: Object,
});

let value = ref([]);

const userId = usePage().props.auth.user.id;

const form = useForm({
    user_id: userId ?? null,
    services: [],
});
</script>
<template>
    <form
        class="mt-6 space-y-6"
        @submit.prevent="form.post(route('services.update'))"
    >
        <div class="flex flex-col gap-y-4 max-w-xl">
            <multiselect
                v-model="form.services"
                :clear-on-select="false"
                :close-on-select="false"
                :modelValue="services"
                :multiple="true"
                :options="services"
                aria-label="pick a value"
                label="service"
                placeholder="Pick a value"
                track-by="service"
            />
        </div>
        <PrimaryButton type="submit">Save</PrimaryButton>
    </form>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
