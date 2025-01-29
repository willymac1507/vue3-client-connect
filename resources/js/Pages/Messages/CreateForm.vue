<script setup>
import { PhotoIcon, UserCircleIcon } from "@heroicons/vue/24/solid";
import { ChevronDownIcon } from "@heroicons/vue/16/solid";
import { inject } from "vue";

const contacts = inject("contacts");
</script>
<template>
    <form>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">
                    New Message
                </h2>
                <div
                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                >
                    <div class="sm:col-span-4">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="recipient"
                            >To</label
                        >
                        <div class="mt-2">
                            <select
                                id="recipient"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="username"
                            >
                                <option>Choose Recipient</option>
                                <option
                                    v-for="contact in contacts"
                                    value="contact.id"
                                >
                                    {{ contact.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="about"
                            >About</label
                        >
                        <div class="mt-2">
                            <textarea
                                id="about"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="about"
                                rows="3"
                            />
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">
                            Write a few sentences about yourself.
                        </p>
                    </div>
                    <div class="col-span-full">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="photo"
                            >Photo</label
                        >
                        <div class="mt-2 flex items-center gap-x-3">
                            <UserCircleIcon
                                aria-hidden="true"
                                class="size-12 text-gray-300"
                            />
                            <button
                                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50"
                                type="button"
                            >
                                Change
                            </button>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="cover-photo"
                            >Cover photo</label
                        >
                        <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                        >
                            <div class="text-center">
                                <PhotoIcon
                                    aria-hidden="true"
                                    class="mx-auto size-12 text-gray-300"
                                />
                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                    <label
                                        class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500"
                                        for="file-upload"
                                    >
                                        <span>Upload a file</span>
                                        <input
                                            id="file-upload"
                                            class="sr-only"
                                            name="file-upload"
                                            type="file"
                                        />
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs/5 text-gray-600">
                                    PNG, JPG, GIF up to 10MB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">
                    Personal Information
                </h2>
                <p class="mt-1 text-sm/6 text-gray-600">
                    Use a permanent address where you can receive mail.
                </p>
                <div
                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                >
                    <div class="sm:col-span-3">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="first-name"
                            >First name</label
                        >
                        <div class="mt-2">
                            <input
                                id="first-name"
                                autocomplete="given-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="first-name"
                                type="text"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="last-name"
                            >Last name</label
                        >
                        <div class="mt-2">
                            <input
                                id="last-name"
                                autocomplete="family-name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="last-name"
                                type="text"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="email"
                            >Email address</label
                        >
                        <div class="mt-2">
                            <input
                                id="email"
                                autocomplete="email"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="email"
                                type="email"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="country"
                            >Country</label
                        >
                        <div class="mt-2 grid grid-cols-1">
                            <select
                                id="country"
                                autocomplete="country-name"
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="country"
                            >
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                            <ChevronDownIcon
                                aria-hidden="true"
                                class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                            />
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="street-address"
                            >Street address</label
                        >
                        <div class="mt-2">
                            <input
                                id="street-address"
                                autocomplete="street-address"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="street-address"
                                type="text"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2 sm:col-start-1">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="city"
                            >City</label
                        >
                        <div class="mt-2">
                            <input
                                id="city"
                                autocomplete="address-level2"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="city"
                                type="text"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="region"
                            >State / Province</label
                        >
                        <div class="mt-2">
                            <input
                                id="region"
                                autocomplete="address-level1"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="region"
                                type="text"
                            />
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label
                            class="block text-sm/6 font-medium text-gray-900"
                            for="postal-code"
                            >ZIP / Postal code</label
                        >
                        <div class="mt-2">
                            <input
                                id="postal-code"
                                autocomplete="postal-code"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                name="postal-code"
                                type="text"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">
                    Notifications
                </h2>
                <p class="mt-1 text-sm/6 text-gray-600">
                    We'll always let you know about important changes, but you
                    pick what else you want to hear about.
                </p>
                <div class="mt-10 space-y-10">
                    <fieldset>
                        <legend class="text-sm/6 font-semibold text-gray-900">
                            By email
                        </legend>
                        <div class="mt-6 space-y-6">
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input
                                            id="comments"
                                            aria-describedby="comments-description"
                                            checked=""
                                            class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                            name="comments"
                                            type="checkbox"
                                        />
                                        <svg
                                            class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                            fill="none"
                                            viewBox="0 0 14 14"
                                        >
                                            <path
                                                class="opacity-0 group-has-checked:opacity-100"
                                                d="M3 8L6 11L11 3.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                            />
                                            <path
                                                class="opacity-0 group-has-indeterminate:opacity-100"
                                                d="M3 7H11"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-sm/6">
                                    <label
                                        class="font-medium text-gray-900"
                                        for="comments"
                                        >Comments</label
                                    >
                                    <p
                                        id="comments-description"
                                        class="text-gray-500"
                                    >
                                        Get notified when someones posts a
                                        comment on a posting.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input
                                            id="candidates"
                                            aria-describedby="candidates-description"
                                            class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                            name="candidates"
                                            type="checkbox"
                                        />
                                        <svg
                                            class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                            fill="none"
                                            viewBox="0 0 14 14"
                                        >
                                            <path
                                                class="opacity-0 group-has-checked:opacity-100"
                                                d="M3 8L6 11L11 3.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                            />
                                            <path
                                                class="opacity-0 group-has-indeterminate:opacity-100"
                                                d="M3 7H11"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-sm/6">
                                    <label
                                        class="font-medium text-gray-900"
                                        for="candidates"
                                        >Candidates</label
                                    >
                                    <p
                                        id="candidates-description"
                                        class="text-gray-500"
                                    >
                                        Get notified when a candidate applies
                                        for a job.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input
                                            id="offers"
                                            aria-describedby="offers-description"
                                            class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                            name="offers"
                                            type="checkbox"
                                        />
                                        <svg
                                            class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                            fill="none"
                                            viewBox="0 0 14 14"
                                        >
                                            <path
                                                class="opacity-0 group-has-checked:opacity-100"
                                                d="M3 8L6 11L11 3.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                            />
                                            <path
                                                class="opacity-0 group-has-indeterminate:opacity-100"
                                                d="M3 7H11"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                            />
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-sm/6">
                                    <label
                                        class="font-medium text-gray-900"
                                        for="offers"
                                        >Offers</label
                                    >
                                    <p
                                        id="offers-description"
                                        class="text-gray-500"
                                    >
                                        Get notified when a candidate accepts or
                                        rejects an offer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="text-sm/6 font-semibold text-gray-900">
                            Push notifications
                        </legend>
                        <p class="mt-1 text-sm/6 text-gray-600">
                            These are delivered via SMS to your mobile phone.
                        </p>
                        <div class="mt-6 space-y-6">
                            <div class="flex items-center gap-x-3">
                                <input
                                    id="push-everything"
                                    checked=""
                                    class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                                    name="push-notifications"
                                    type="radio"
                                />
                                <label
                                    class="block text-sm/6 font-medium text-gray-900"
                                    for="push-everything"
                                    >Everything</label
                                >
                            </div>
                            <div class="flex items-center gap-x-3">
                                <input
                                    id="push-email"
                                    class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                                    name="push-notifications"
                                    type="radio"
                                />
                                <label
                                    class="block text-sm/6 font-medium text-gray-900"
                                    for="push-email"
                                    >Same as email</label
                                >
                            </div>
                            <div class="flex items-center gap-x-3">
                                <input
                                    id="push-nothing"
                                    class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden"
                                    name="push-notifications"
                                    type="radio"
                                />
                                <label
                                    class="block text-sm/6 font-medium text-gray-900"
                                    for="push-nothing"
                                    >No push notifications</label
                                >
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button class="text-sm/6 font-semibold text-gray-900" type="button">
                Cancel
            </button>
            <button
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                type="submit"
            >
                Save
            </button>
        </div>
    </form>
</template>
