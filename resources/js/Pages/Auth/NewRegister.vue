<script setup>
import { Link, useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    firstname: "",
    surname: "",
    email: "",
    mobile: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>
<template>
    <div class="flex min-h-screen flex-1">
        <div
            class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24"
        >
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <img
                        alt="Your Company"
                        class="h-50 w-auto"
                        src="/images/CCLogo.svg"
                    />
                    <h2
                        class="mt-8 text-2xl/9 font-bold tracking-tight text-gray-900"
                    >
                        Register on the app
                    </h2>
                    <p class="mt-2 text-sm/6 text-gray-500">
                        Already registered?
                        {{ " " }}
                        <Link
                            :href="route('login')"
                            class="font-semibold text-cyan-700 hover:text-cyan-500"
                            >Login
                        </Link>
                    </p>
                </div>
                <div class="mt-10">
                    <div>
                        <form @submit.prevent="submit()">
                            <div class="flex justify-between items-center">
                                <div
                                    class="rounded-md bg-white px-3 pt-2.5 pb-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                >
                                    <label
                                        class="block text-xs font-medium text-gray-900"
                                        for="firstname"
                                        >First Name</label
                                    >
                                    <input
                                        id="firstname"
                                        v-model="form.firstname"
                                        class="block w-full text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                        name="firstname"
                                        placeholder="Jane"
                                        type="text"
                                    />
                                    <InputError
                                        v-if="usePage().props.errors.firstname"
                                        :message="
                                            usePage().props.errors.firstname
                                        "
                                    />
                                </div>
                                <div
                                    class="rounded-md bg-white px-3 pt-2.5 pb-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                >
                                    <label
                                        class="block text-xs font-medium text-gray-900"
                                        for="surname"
                                        >Last Name</label
                                    >
                                    <input
                                        id="surname"
                                        v-model="form.surname"
                                        class="block w-full text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                        name="surname"
                                        placeholder="Smith"
                                        type="text"
                                    />
                                    <InputError
                                        v-if="usePage().props.errors.surname"
                                        :message="
                                            usePage().props.errors.surname
                                        "
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="rounded-md bg-white px-3 pt-2.5 pb-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                >
                                    <label
                                        class="block text-xs font-medium text-gray-900"
                                        for="email"
                                        >Email</label
                                    >
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        class="block w-full text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                        name="email"
                                        type="email"
                                    />
                                    <InputError
                                        v-if="usePage().props.errors.email"
                                        :message="usePage().props.errors.email"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="rounded-md bg-white px-3 pt-2.5 pb-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                >
                                    <label
                                        class="block text-xs font-medium text-gray-900"
                                        for="mobile"
                                        >Mobile</label
                                    >
                                    <input
                                        id="mobile"
                                        v-model="form.mobile"
                                        class="block w-full text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                        name="mobile"
                                        type="text"
                                    />
                                    <InputError
                                        v-if="usePage().props.errors.mobile"
                                        :message="usePage().props.errors.mobile"
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="rounded-md bg-white px-3 pt-2.5 pb-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                >
                                    <label
                                        class="block text-xs font-medium text-gray-900"
                                        for="password"
                                        >Password</label
                                    >
                                    <input
                                        id="password"
                                        v-model="form.password"
                                        class="block w-full text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                        name="password"
                                        type="password"
                                    />
                                    <InputError
                                        v-if="usePage().props.errors.password"
                                        :message="
                                            usePage().props.errors.password
                                        "
                                    />
                                </div>
                            </div>
                            <div>
                                <div
                                    class="rounded-md bg-white px-3 pt-2.5 pb-1.5 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600"
                                >
                                    <label
                                        class="block text-xs font-medium text-gray-900"
                                        for="passwordConfirm"
                                        >Confirm Password</label
                                    >
                                    <input
                                        id="passwordConfirm"
                                        v-model="form.password_confirmation"
                                        class="block w-full text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                        name="passwordConfirm"
                                        type="password"
                                    />
                                    <InputError
                                        v-if="
                                            usePage().props.errors
                                                .password_confirmation
                                        "
                                        :message="
                                            usePage().props.errors
                                                .password_confirmation
                                        "
                                    />
                                </div>
                            </div>
                            <div>
                                <PrimaryButton
                                    class="w-full justify-center mt-4"
                                    type="submit"
                                >
                                    Register
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <div class="relative">
                            <div
                                aria-hidden="true"
                                class="absolute inset-0 flex items-center"
                            >
                                <div class="w-full border-t border-gray-200" />
                            </div>
                            <div
                                class="relative flex justify-center text-sm/6 font-medium"
                            >
                                <span class="bg-white px-6 text-gray-900"
                                    >Or continue with</span
                                >
                            </div>
                        </div>
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <a
                                class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 focus-visible:ring-transparent"
                                href="#"
                            >
                                <span class="icon icon-google" />
                                <span class="text-sm/6 font-semibold"
                                    >Google</span
                                >
                            </a>
                            <a
                                class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 focus-visible:ring-transparent"
                                href="#"
                            >
                                <span class="icon icon-facebook" />
                                <span class="text-sm/6 font-semibold"
                                    >Facebook</span
                                >
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img
                alt=""
                class="absolute inset-0 size-full object-cover"
                src="/Images/regCoverImage.jpg"
            />
        </div>
    </div>
</template>
