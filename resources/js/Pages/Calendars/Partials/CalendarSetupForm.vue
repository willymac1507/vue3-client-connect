<script setup>
import { useForm } from "@inertiajs/vue3";
import { addMinutes, format } from "date-fns";
import PageLayout from "@/Components/PageLayout.vue";
import { reactive, ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";

let props = defineProps({
    calendar: Object,
});

const form = useForm({
    monStart: props.calendar.monStart ?? "",
    monEnd: props.calendar.monEnd ?? "",
    tueStart: props.calendar.tueStart ?? "",
    tueEnd: props.calendar.tueEnd ?? "",
    wedStart: props.calendar.wedStart ?? "",
    wedEnd: props.calendar.wedEnd ?? "",
    thuStart: props.calendar.thuStart ?? "",
    thuEnd: props.calendar.thuEnd ?? "",
    friStart: props.calendar.friStart ?? "",
    friEnd: props.calendar.friEnd ?? "",
    satStart: props.calendar.satStart ?? "",
    satEnd: props.calendar.satEnd ?? "",
    sunStart: props.calendar.sunStart ?? "",
    sunEnd: props.calendar.sunEnd ?? "",
});

let startTimes = reactive({
    Monday: props.calendar.monStart ?? null,
    Tuesday: props.calendar.tueStart ?? null,
    Wednesday: props.calendar.wedStart ?? null,
    Thursday: props.calendar.thuStart ?? null,
    Friday: props.calendar.friStart ?? null,
    Saturday: props.calendar.satStart ?? null,
    Sunday: props.calendar.sunStart ?? null,
});

let isChecked = ref({
    Monday: props.calendar.monStart ?? false,
    Tuesday: props.calendar.tueStart ?? false,
    Wednesday: props.calendar.wedStart ?? false,
    Thursday: props.calendar.thuStart ?? false,
    Friday: props.calendar.friStart ?? false,
    Saturday: props.calendar.satStart ?? false,
    Sunday: props.calendar.sunStart ?? false,
});

const timeSlots = [];
const days = [
    {
        day: "Monday",
        start: "monStart",
        end: "monEnd",
        startField: "form.monStart",
        endField: "form.monEnd",
    },
    {
        day: "Tuesday",
        start: "tueStart",
        end: "tueEnd",
        field: "form.tueStart",
        endField: "form.tueEnd",
    },
    {
        day: "Wednesday",
        start: "wedStart",
        end: "wedEnd",
        field: "form.wedStart",
        endField: "form.wedEnd",
    },
    {
        day: "Thursday",
        start: "thuStart",
        end: "thuEnd",
        field: "form.thuStart",
        endField: "form.thuEnd",
    },
    {
        day: "Friday",
        start: "friStart",
        end: "friEnd",
        field: "form.friStart",
        endField: "form.friEnd",
    },
    {
        day: "Saturday",
        start: "satStart",
        end: "satEnd",
        field: "form.satStart",
        endField: "form.satEnd",
    },
    {
        day: "Sunday",
        start: "sunStart",
        end: "sunEnd",
        field: "form.sunStart",
        endField: "form.sunEnd",
    },
];
addTimeSlots();
let endKey = ref(0);

function setSelectedValue(event, day) {
    startTimes[day] = event.target.selectedOptions[0].value;
}

function addTimeSlots() {
    for (let i = 0; i < 48; i++) {
        let slot = format(
            addMinutes(new Date(2024, 1, 1, 0, 0), 30 * i),
            "HH:mm:ss",
        );
        timeSlots.push(slot);
    }
}
</script>
<template>
    <PageLayout title="Calendar">
        <!--        <PageSection title="Weekly Work Pattern">-->
        <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    Weekly Work Pattern
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Update your availability to appear in client searches.
                </p>
            </header>
            <form
                class="mt-8 flex flex-col w-1/2 mr-auto gap-4"
                @submit.prevent="form.post('/calendar/store')"
            >
                <div
                    v-for="(day, dayIdx) in days"
                    :key="dayIdx"
                    class="flex justify-between items-center"
                >
                    <div class="basis-1/4">{{ day.day }}</div>
                    <div>
                        <Checkbox
                            :id="day.day"
                            v-model="isChecked[day.day]"
                            :checked="form[day.start] !== ''"
                        />
                    </div>
                    <div class="basis-1/4 grid items-end">
                        <select
                            :id="day.start"
                            v-model="form[day.start]"
                            :disabled="!isChecked[day.day]"
                            class="disabled:opacity-25 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            @change="setSelectedValue($event, day.day)"
                        >
                            <option disabled value="">Start</option>
                            <option
                                v-for="(timeSlot, timeSlotIdx) in timeSlots"
                                :key="timeSlotIdx"
                                :selected="timeSlot === form[day.start]"
                                :value="timeSlot"
                            >
                                {{ timeSlot }}
                            </option>
                        </select>
                    </div>
                    <div class="basis-1/4 grid items-end">
                        <select
                            :id="day.end"
                            v-model="form[day.end]"
                            :disabled="!isChecked[day.day]"
                            :required="startTimes['Monday']"
                            class="disabled:opacity-25 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option disabled value="">End</option>
                            <option
                                v-for="(timeSlot, timeSlotIdx) in timeSlots"
                                :key="timeSlotIdx"
                                :disabled="timeSlot <= startTimes[day.day]"
                                :value="timeSlot"
                            >
                                {{ timeSlot }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mt-8 mr-auto">
                    <PrimaryButton :disabled="form.processing"
                        >Save
                    </PrimaryButton>
                </div>
            </form>
        </div>
        <!--        </PageSection>-->
    </PageLayout>
</template>
<style />
