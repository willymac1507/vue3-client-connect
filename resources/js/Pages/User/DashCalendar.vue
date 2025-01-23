<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { EllipsisVerticalIcon } from "@heroicons/vue/24/outline";
import {
    addMonths,
    eachDayOfInterval,
    format,
    getDate,
    getMonth,
    getYear,
    isEqual,
    isToday,
    nextSunday,
    previousMonday,
    startOfDay,
    startOfMonth,
    subMonths,
    toDate,
} from "date-fns";
import { ref } from "vue";

const viewedDay = ref(startOfDay(new Date()));

let days = ref([]);
const meetings = [
    {
        id: 1,
        name: "Leslie Alexander",
        imageUrl:
            "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        start: "1:00 PM",
        startDatetime: "2025-01-22T13:00",
        actualDateTime: new Date("2025-01-22"),
        end: "2:30 PM",
        endDatetime: "2025-01-22T14:30",
    },
    // More meetings...
];
let formattedDate;
let todaysDate = ref(new Date());
populateDates(todaysDate.value);

function populateDates(date) {
    days.value = [];
    let year = getYear(date);
    let month = getMonth(date);
    formattedDate = format(date, "MMMM yyyy");

    const calendarMonth = eachDayOfInterval({
        start: previousMonday(new Date(year, month, 1)),
        end: nextSunday(new Date(year, month + 1, 0)),
    });
    calendarMonth.map((day) => {
        let dateObject = {
            date: `${getYear(day)}-${getMonth(day) + 1}-${getDate(day)}`,
            isCurrentMonth: isEqual(month, getMonth(day)),
        };
        days.value.push(dateObject);
    });
}

function selectDay(day) {
    if (!isEqual(this.month, getMonth(day.date))) {
        populateDates(toDate(day.date));
    }
    this.viewedDay = toDate(day.date);
}

function previousMonth(day) {
    let prevMonth = subMonths(day, 1);
    this.viewedDay = startOfMonth(prevMonth);
    populateDates(prevMonth);
}

function nextMonth(day) {
    let nextMonth = addMonths(day, 1);
    this.viewedDay = startOfMonth(nextMonth);
    populateDates(nextMonth);
}
</script>
<template>
    <div class="md:grid md:grid-cols-2 md:divide-x md:divide-gray-200">
        <div class="md:pr-14">
            <div class="flex items-center">
                <div class="flex-auto text-sm font-semibold text-gray-900">
                    {{ formattedDate }}
                </div>
                <button
                    class="-my-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                    type="button"
                    @click="previousMonth(viewedDay)"
                >
                    <span class="sr-only">Previous month</span>
                    <ChevronLeftIcon aria-hidden="true" class="size-5" />
                </button>
                <button
                    class="-my-1.5 -mr-1.5 ml-2 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500"
                    type="button"
                    @click="nextMonth(viewedDay)"
                >
                    <span class="sr-only">Next month</span>
                    <ChevronRightIcon aria-hidden="true" class="size-5" />
                </button>
            </div>
            <div
                class="mt-10 grid grid-cols-7 text-center text-xs/6 text-gray-500"
            >
                <div>M</div>
                <div>T</div>
                <div>W</div>
                <div>T</div>
                <div>F</div>
                <div>S</div>
                <div>S</div>
            </div>
            <div class="mt-2 grid grid-cols-7 text-sm">
                <div
                    v-for="(day, dayIdx) in days"
                    :key="day.date"
                    :class="[dayIdx > 6 && 'border-t border-gray-200', 'py-2']"
                >
                    <button
                        :class="[
                            isEqual(day.date, viewedDay) && 'text-white',
                            !isEqual(day.date, viewedDay) &&
                                isToday(day.date) &&
                                'text-indigo-600',
                            !isEqual(day.date, viewedDay) &&
                                !isToday(day.date) &&
                                day.isCurrentMonth &&
                                'text-gray-900',
                            !isEqual(day.date, viewedDay) &&
                                !isToday(day.date) &&
                                !day.isCurrentMonth &&
                                'text-gray-400',
                            isEqual(day.date, viewedDay) &&
                                isToday(day.date) &&
                                'bg-indigo-600',
                            isEqual(day.date, viewedDay) &&
                                !isToday(day.date) &&
                                'bg-gray-900',
                            !isEqual(day.date, viewedDay) &&
                                'hover:bg-gray-200',
                            (isEqual(day.date, viewedDay) ||
                                isToday(day.date)) &&
                                'font-semibold',
                            'mx-auto flex size-8 items-center justify-center rounded-full',
                        ]"
                        type="button"
                        @click="selectDay(day)"
                    >
                        <time :datetime="day.date"
                            >{{ day.date.split("-").pop().replace(/^0/, "") }}
                        </time>
                    </button>
                </div>
            </div>
        </div>
        <section class="mt-12 md:mt-0 md:pl-14">
            <h2 class="text-base font-semibold text-gray-900">
                Schedule for {{ format(viewedDay, "E do MMMM yyyy") }}
            </h2>
            <ol class="mt-4 flex flex-col gap-y-1 text-sm/6 text-gray-500">
                <template v-for="meeting in meetings">
                    <li
                        v-if="isEqual(meeting.actualDateTime, viewedDay)"
                        :key="meeting.id"
                        class="group flex items-center gap-x-4 rounded-xl px-4 py-2 focus-within:bg-gray-100 hover:bg-gray-100"
                    >
                        <img
                            :src="meeting.imageUrl"
                            alt=""
                            class="size-10 flex-none rounded-full"
                        />
                        <div class="flex-auto">
                            <p class="text-gray-900">{{ meeting.name }}</p>
                            <p class="mt-0.5">
                                <time :datetime="meeting.startDatetime"
                                    >{{ meeting.start }}
                                </time>
                                -
                                <time :datetime="meeting.endDatetime"
                                    >{{ meeting.end }}
                                </time>
                            </p>
                        </div>
                        <Menu
                            as="div"
                            class="relative opacity-0 focus-within:opacity-100 group-hover:opacity-100"
                        >
                            <div>
                                <MenuButton
                                    class="-m-2 flex items-center rounded-full p-1.5 text-gray-500 hover:text-gray-600"
                                >
                                    <span class="sr-only">Open options</span>
                                    <EllipsisVerticalIcon
                                        aria-hidden="true"
                                        class="size-6"
                                    />
                                </MenuButton>
                            </div>
                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                                >
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a
                                                :class="[
                                                    active
                                                        ? 'bg-gray-100 text-gray-900 outline-none'
                                                        : 'text-gray-700',
                                                    'block px-4 py-2 text-sm',
                                                ]"
                                                href="#"
                                                >Edit</a
                                            >
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a
                                                :class="[
                                                    active
                                                        ? 'bg-gray-100 text-gray-900 outline-none'
                                                        : 'text-gray-700',
                                                    'block px-4 py-2 text-sm',
                                                ]"
                                                href="#"
                                                >Cancel</a
                                            >
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </li>
                </template>
            </ol>
        </section>
    </div>
</template>
