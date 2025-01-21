<!--suppress HtmlRequiredTitleElement -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import UsersList from "@/Pages/SuperAdmin/UsersList.vue";
import PageSection from "@/Components/PageSection.vue";
import Paginator from "@/Components/Paginator.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

let props = defineProps({
    users: Object,
    filters: Object,
    can: Object,
});
let search = ref(props.filters.search);
watch(
    search,
    debounce(function (value) {
        router.get(
            "/dashboard",
            { search: value },
            { preserveState: true, replace: true },
        );
    }, 300),
);
</script>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout :can="can">
        <template v-slot:header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <PageSection>
                    <template v-slot:header>
                        <div class="flex justify-between items-center">
                            <h3>All Users</h3>
                            <input
                                v-model="search"
                                class="border rounded px-2"
                                placeholder="Search..."
                                type="text"
                            />
                        </div>
                    </template>
                    <UsersList :users="users" />
                    <template v-slot:footer>
                        <Paginator :links="users['links']" />
                    </template>
                </PageSection>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
