<script setup>
import {
    ChevronLeftIcon,
    ChevronRightIcon,
    EllipsisHorizontalIcon,
} from "@heroicons/vue/20/solid";

let props = defineProps({
    data: Object,
    type: String,
});

let links = props.data.links;
const from = props.data.from;
const to = props.data.to;
const total = props.data.total;
let last = links.length - 1;
</script>
<template>
    <div
        class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
    >
        <!--        Hidden on all but small screens.-->
        <div class="flex flex-1 justify-between sm:hidden">
            <Component
                :is="links[0].url ? 'Ilink' : 'span'"
                :href="links[0].url"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50"
                preserve-scroll
                >Previous
            </Component>
            <Component
                :is="links[last].url ? 'Ilink' : 'span'"
                :href="links[last].url"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50"
                preserve-scroll
                >Next
            </Component>
        </div>
        <div
            v-if="data.total > 0"
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
                    class="isolate inline-flex -space-x-px rounded-md shadow-xs text-xs"
                >
                    <!--                    Previous page chevron-->
                    <Component
                        :is="data.prev_page_url ? 'Ilink' : 'span'"
                        :class="{
                            'hover:bg-gray-50 text-gray-900':
                                data.prev_page_url,
                            'text-gray-500': !data.prev_page_url,
                        }"
                        :href="data.prev_page_url"
                        aria-label="Previous"
                        class="relative z-10 inline-flex items-center py-2 px-2 rounded-l-md ring-1 ring-inset ring-gray-300 focus:outline-offset-0"
                        preserve-scroll
                    >
                        <ChevronLeftIcon aria-hidden="true" class="size-5" />
                    </Component>
                    <!--                    <span-->
                    <!--                        v-if="links[0].label > 1"-->
                    <!--                        class="relative z-10 inline-flex items-center py-2 px-2 ring-1 ring-inset ring-gray-300 focus:outline-offset-0 text-gray-500"-->
                    <!--                        ><EllipsisHorizontalIcon-->
                    <!--                            aria-hidden="true"-->
                    <!--                            class="size-5"-->
                    <!--                    /></span>-->
                    <template v-for="(link, linkIdx) in links">
                        <Ilink
                            v-if="
                                !link.label.includes('Previous') &&
                                !link.label.includes('Next')
                            "
                            :class="
                                link.active
                                    ? 'z-10 bg-indigo-600 text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                                    : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0'
                            "
                            :href="link.url ? link.url : ''"
                            class="px-4 relative z-10 inline-flex items-center py-2"
                            preserve-scroll
                            v-html="link.label"
                        >
                        </Ilink>
                    </template>
                    <span
                        v-if="links[last].label < data.last_page"
                        class="relative z-10 inline-flex items-center py-2 px-2 ring-1 ring-inset ring-gray-300 focus:outline-offset-0 text-gray-500"
                        ><EllipsisHorizontalIcon
                            aria-hidden="true"
                            class="size-5"
                    /></span>
                    <Component
                        :is="data.next_page_url ? 'Ilink' : 'span'"
                        :class="{
                            'hover:bg-gray-50 text-gray-900':
                                data.next_page_url,
                            'text-gray-500': !data.next_page_url,
                        }"
                        :href="data.next_page_url"
                        aria-label="Next"
                        class="relative z-10 inline-flex items-center py-2 px-2 rounded-r-md ring-1 ring-inset ring-gray-300 focus:outline-offset-0"
                        preserve-scroll
                    >
                        <ChevronRightIcon aria-hidden="true" class="size-5" />
                    </Component>
                </nav>
            </div>
        </div>
        <div
            v-else
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            No data
        </div>
    </div>
</template>
