<script setup>
import { ChevronRightIcon, HomeIcon } from "@heroicons/vue/20/solid";

const pages = [
    { name: "Projects", href: "#", current: false },
    { name: "Project Nero", href: "#", current: true },
];
</script>
<template>
    <nav aria-label="Breadcrumb" class="flex">
        <ol class="flex items-center space-x-4" role="list">
            <li>
                <div>
                    <a class="text-gray-400 hover:text-gray-500" href="#">
                        <HomeIcon aria-hidden="true" class="size-5 shrink-0" />
                        <span class="sr-only">Home</span>
                    </a>
                </div>
            </li>
            <li v-for="page in pages" :key="page.name">
                <div class="flex items-center">
                    <ChevronRightIcon
                        aria-hidden="true"
                        class="size-5 shrink-0 text-gray-400"
                    />
                    <a
                        :aria-current="page.current ? 'page' : undefined"
                        :href="page.href"
                        class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                        >{{ page.name }}</a
                    >
                </div>
            </li>
        </ol>
    </nav>
</template>
