<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), { onFinish: () => form.reset("password") });
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
                        Sign in to your account
                    </h2>
                    <p class="mt-2 text-sm/6 text-gray-500">
                        Not signed up?
                        {{ " " }}
                        <Link
                            :href="route('register')"
                            class="font-semibold text-cyan-700 hover:text-cyan-500"
                            >Register
                        </Link>
                    </p>
                </div>
                <div class="mt-10">
                    <div>
                        <form @submit.prevent="submit()">
                            <div>
                                <label
                                    class="block text-sm/6 font-medium text-gray-900"
                                    for="email"
                                    >Email address</label
                                >
                                <div class="mt-2">
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        autocomplete="email"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        name="email"
                                        required=""
                                        type="email"
                                    />
                                </div>
                                <InputError
                                    :message="form.errors.email"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <label
                                    class="block text-sm/6 font-medium text-gray-900"
                                    for="password"
                                    >Password</label
                                >
                                <div class="mt-2">
                                    <input
                                        id="password"
                                        v-model="form.password"
                                        autocomplete="current-password"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        name="password"
                                        required=""
                                        type="password"
                                    />
                                </div>
                                <InputError
                                    :message="form.errors.password"
                                    class="mt-2"
                                />
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex gap-3">
                                    <div class="flex h-6 shrink-0 items-center">
                                        <div
                                            class="group grid size-4 grid-cols-1"
                                        >
                                            <input
                                                id="remember-me"
                                                v-model="form.remember"
                                                class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto"
                                                name="remember-me"
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
                                    <label
                                        class="block text-sm/6 text-gray-900"
                                        for="remember-me"
                                        >Remember me</label
                                    >
                                </div>
                                <div class="text-sm/6">
                                    <Link
                                        v-if="canResetPassword"
                                        :href="route('password.request')"
                                        class="font-semibold text-cyan-700 hover:text-cyan-500"
                                        >Forgot password?
                                    </Link>
                                </div>
                            </div>
                            <div>
                                <PrimaryButton
                                    class="mt-4 w-full justify-center cursor-pointer"
                                    type="submit"
                                >
                                    Sign in
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                    <div class="mt-10">
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
                            <Link
                                class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 focus-visible:ring-transparent"
                                href="#"
                            >
                                <span class="icon icon-google" />
                                <span class="text-sm/6 font-semibold"
                                    >Google</span
                                >
                            </Link>
                            <Link
                                class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-50 focus-visible:ring-transparent"
                                href="#"
                            >
                                <span class="icon icon-facebook" />
                                <span class="text-sm/6 font-semibold"
                                    >Facebook</span
                                >
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img
                alt=""
                class="absolute inset-0 size-full object-cover"
                src="/Images/coverImage.jpg"
            />
        </div>
    </div>
</template>
