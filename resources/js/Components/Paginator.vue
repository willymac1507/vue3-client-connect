<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";

let props = defineProps({
    links: Array,
    from: Number,
    to: Number,
    total: Number,
    current: Number,
});

let last = props.links.length - 1;

console.log(props.links);
</script>
<template>
    <div
        class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
    >
        <!-- TODO: Add urls for responsive paginator buttons -->
        <!-- -->
        <!--        <div class="flex flex-1 justify-between sm:hidden">-->
        <!--            <Link-->
        <!--                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"-->
        <!--                href="#"-->
        <!--                >Previous-->
        <!--            </Link>-->
        <!--            <Link-->
        <!--                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"-->
        <!--                href="#"-->
        <!--                >Next-->
        <!--            </Link>-->
        <!--        </div>-->
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ from }}</span>
                    to
                    <span class="font-medium">{{ to }}</span>
                    of
                    <span class="font-medium">{{ total }}</span>
                    results
                </p>
            </div>
            <div>
                <nav
                    aria-label="Pagination"
                    class="isolate inline-flex -space-x-px rounded-md shadow-xs"
                >
                    <template v-for="(link, linkIdx) in links">
                        <Component
                            :is="link.url ? 'Ilink' : 'span'"
                            v-if="linkIdx === 0"
                            :class="{
                                'hover:bg-gray-50 text-gray-900': link.url,
                                'text-gray-500': !link.url,
                            }"
                            :href="link.url"
                            aria-label="Previous"
                            class="relative z-10 inline-flex items-center py-2 px-2 rounded-l-md ring-1 ring-inset ring-gray-300 focus:outline-offset-0"
                        >
                            <ChevronLeftIcon
                                aria-hidden="true"
                                class="size-5"
                            />
                        </Component>
                        <Component
                            :is="link.url ? 'Ilink' : 'span'"
                            v-else-if="linkIdx === links.length - 1"
                            :class="{
                                'hover:bg-gray-50 text-gray-900': link.url,
                                'text-gray-500': !link.url,
                            }"
                            :href="link.url"
                            aria-label="Previous"
                            class="relative z-10 inline-flex items-center py-2 px-2 rounded-r-md ring-1 ring-inset ring-gray-300 focus:outline-offset-0"
                        >
                            <ChevronRightIcon
                                aria-hidden="true"
                                class="size-5"
                            />
                        </Component>
                        <Ilink
                            v-else
                            :class="
                                link.active
                                    ? 'z-10 bg-indigo-600 text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                    : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0'
                            "
                            :href="link.url ? link.url : ''"
                            class="px-4 relative z-10 inline-flex items-center py-2"
                            v-html="link.label"
                        >
                        </Ilink>
                    </template>
                    <!--                    <Link-->
                    <!--                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0"-->
                    <!--                        href="#"-->
                    <!--                    >-->
                    <!--                        <span class="sr-only">Previous</span>-->
                    <!--                        <ChevronLeftIcon aria-hidden="true" class="size-5" />-->
                    <!--                    </Link>-->
                    <!--                    &lt;!&ndash; Current: "z-10 bg-indigo-600 text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" &ndash;&gt;-->
                    <!--                    <a-->
                    <!--                        aria-current="page"-->
                    <!--                        class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"-->
                    <!--                        href="#"-->
                    <!--                        >1</a-->
                    <!--                    >-->
                    <!--                    <a-->
                    <!--                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0"-->
                    <!--                        href="#"-->
                    <!--                        >2</a-->
                    <!--                    >-->
                    <!--                    <a-->
                    <!--                        class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex"-->
                    <!--                        href="#"-->
                    <!--                        >3</a-->
                    <!--                    >-->
                    <!--                    <span-->
                    <!--                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-300 ring-inset focus:outline-offset-0"-->
                    <!--                        >...</span-->
                    <!--                    >-->
                    <!--                    <a-->
                    <!--                        class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex"-->
                    <!--                        href="#"-->
                    <!--                        >8</a-->
                    <!--                    >-->
                    <!--                    <a-->
                    <!--                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0"-->
                    <!--                        href="#"-->
                    <!--                        >9</a-->
                    <!--                    >-->
                    <!--                    <a-->
                    <!--                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0"-->
                    <!--                        href="#"-->
                    <!--                        >10</a-->
                    <!--                    >-->
                    <!--                    <a-->
                    <!--                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0"-->
                    <!--                        href="#"-->
                    <!--                    >-->
                    <!--                        <span class="sr-only">Next</span>-->
                    <!--                        <ChevronRightIcon aria-hidden="true" class="size-5" />-->
                    <!--                    </a>-->
                </nav>
            </div>
        </div>
    </div>
</template>
