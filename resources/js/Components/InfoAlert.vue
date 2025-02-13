<script setup>
import { XMarkIcon } from "@heroicons/vue/20/solid";
</script>
<template>
    <div class="rounded-md bg-blue-50 p-4">
        <div class="flex">
            <div class="ml-3">
                <p class="text-sm font-medium text-blue-800">
                    <slot />
                </p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button
                        class="inline-flex rounded-md bg-blue-50 p-1.5 text-blue-500 hover:bg-blue-100 focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-blue-50 focus:outline-hidden"
                        type="button"
                    >
                        <span class="sr-only">Dismiss</span>
                        <XMarkIcon aria-hidden="true" class="size-5" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
