<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { reactive } from "vue";

defineProps({
    services: Object,
});

const userId = usePage().props.auth.user.id;
let myServices = reactive([]);

const form = useForm({
    user_id: userId ?? null,
    services: myServices,
});

function changeChecked(e) {
    if (e.target.checked) {
        myServices.push({
            id: e.target.value,
            offered: true,
        });
    }
}
</script>
<template>
    <form
        class="mt-6 space-y-6"
        @submit.prevent="form.patch(route('services.update'))"
    >
        <div class="flex flex-col gap-y-4 max-w-xl">
            <div
                v-for="(service, index) in services"
                :key="index"
                class="flex justify-between basis-1/4"
            >
                <label :for="`service${index}`">{{ service.service }} </label>
                <input
                    id="`service${index}`"
                    :value="service.id"
                    class="ml-2 rounded shadow"
                    type="checkbox"
                    @change="changeChecked"
                />
            </div>
        </div>
    </form>
</template>
<style />
