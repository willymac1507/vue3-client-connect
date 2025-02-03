<script setup>
import { useForm } from "@inertiajs/vue3";
import { addMinutes, format } from "date-fns";
import PageLayout from "@/Components/PageLayout.vue";
import PageSection from "@/Components/PageSection.vue";

const form = useForm({
    monStart: "",
    monEnd: "",
    tueStart: "",
    tueEnd: "",
    wedStart: "",
    wedEnd: "",
    thuStart: "",
    thuEnd: "",
    friStart: "",
    friEnd: "",
    satStart: "",
    satEnd: "",
    sunStart: "",
    sunEnd: "",
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

function addTimeSlots() {
    for (let i = 0; i < 48; i++) {
        let slot = format(
            addMinutes(new Date(2024, 1, 1, 0, 0), 30 * i),
            "HH:mm",
        );
        timeSlots.push(slot);
    }
}
</script>
<template>
    <PageLayout title="Calendar">
        <PageSection title="Weekly Work Pattern">
            <form>
                <div
                    v-for="(day, dayIdx) in days"
                    :key="dayIdx"
                    class="flex justify-between items-center"
                >
                    <div>{{ day.day }}</div>
                    <label :for="day.start"
                        >Start:
                        <select :id="day.start" v-model="form.monStart">
                            <option
                                v-for="(timeSlot, timeSlotIdx) in timeSlots"
                                :key="timeSlotIdx"
                                :value="timeSlot"
                            >
                                {{ timeSlot }}
                            </option>
                        </select>
                    </label>
                    <label :for="day.end"
                        >End:
                        <select :id="day.end" v-model="day.endField">
                            <option
                                v-for="(timeSlot, timeSlotIdx) in timeSlots"
                                :key="timeSlotIdx"
                                :value="timeSlot"
                            >
                                {{ timeSlot }}
                            </option>
                        </select>
                    </label>
                </div>
            </form>
        </PageSection>
    </PageLayout>
</template>
<style />
