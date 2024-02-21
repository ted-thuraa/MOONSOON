<template>
    <div
        class="w-[390px] md:w-full flex flex-col bg-white h-screen items-center justify-center mx-auto"
    >
        <header class="absolute inset-x-0 top-0 z-50">
            <nav
                class="flex items-center justify-between p-2 lg:px-8"
                aria-label="Global"
            >
                <div class="flex lg:flex-1">
                    <a href="/" class="inline-flex items-center -m-1.5 p-1.5">
                        <v-lazy-image :src="Logo" class="h-10 w-auto" />
                        <span class="sr-only">Creatorpage</span>

                        <span class="m-1.5 p-2.5 text-black font-semibold"
                            >Creatorpage</span
                        >
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button
                        type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true"
                    >
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12"></div>
            </nav>
            <Dialog
                as="div"
                class="lg:hidden"
                @close="mobileMenuOpen = false"
                :open="mobileMenuOpen"
            >
                <div class="fixed inset-0 z-50" />
                <DialogPanel
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
                >
                    <div class="flex items-center justify-between">
                        <a
                            href="/"
                            class="-m-1.5 p-1.5 flex items-center justify-center"
                        >
                            <v-lazy-image :src="Logo" class="h-8 w-auto" />
                            <span class="sr-only">Creator page</span>

                            <span class="-m-1.5 p-2.5 text-black font-semibold"
                                >Creator page</span
                            >
                        </a>
                        <button
                            type="button"
                            class="-m-2.5 rounded-md p-2.5 text-gray-700"
                            @click="mobileMenuOpen = false"
                        >
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="item.href"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                    >{{ item.name }}</a
                                >
                            </div>
                        </div>
                    </div>
                </DialogPanel>
            </Dialog>
        </header>
        <div class="relative w-full rounded-lg">
            <div class="absolute top-0 left-0 right-0">
                <div v-if="errorMsg">
                    <div
                        id="toast-danger"
                        class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                        role="alert"
                    >
                        <div
                            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200"
                        >
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"
                                />
                            </svg>
                            <span class="sr-only">Error icon</span>
                        </div>
                        <div class="ml-3 text-sm font-normal">
                            {{ errorMsg }}.
                        </div>
                        <button
                            @click="errorMsg = null"
                            type="button"
                            class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                            data-dismiss-target="#toast-danger"
                            aria-label="Close"
                        >
                            <span class="sr-only">Close</span>
                            <svg
                                class="w-3 h-3"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 14"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div
                class="relative isolate overflow-hidden bg-gray-50 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0"
            >
                <div
                    class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left"
                >
                    <div
                        class="w-full h-full flex flex-row justify-between items-center"
                    >
                        <div class="">
                            <div class="flex flex-col items-center">
                                <h2
                                    class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"
                                >
                                    Welcome back! 👋
                                </h2>
                                <p
                                    class="mt-2 text-center text-sm text-gray-600"
                                >
                                    Not registered?
                                    {{ " " }}
                                    <router-link
                                        :to="{ name: 'Signup' }"
                                        class="font-medium text-indigo-600 hover:text-indigo-500"
                                        >Sign Up</router-link
                                    >
                                </p>
                            </div>
                            <form
                                class="mt-8 space-y-6"
                                @submit.prevent="login"
                            >
                                <input
                                    type="hidden"
                                    name="remember"
                                    value="true"
                                />
                                <div class="-space-y-px rounded-md shadow-sm">
                                    <div class="w-full">
                                        <label
                                            for="input-group-1"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Email
                                        </label>
                                        <div class="relative mb-6">
                                            <div
                                                class="w-full inline-flex items-center"
                                            >
                                                <input
                                                    v-model="user.email"
                                                    type="email"
                                                    name="email"
                                                    autocomplete="email"
                                                    required=""
                                                    id="email"
                                                    placeholder="youremail@gmail.com"
                                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <label
                                            for="input-group-1"
                                            class="block mb-2 text-sm font-medium text-gray-900"
                                            >Password</label
                                        >
                                        <div class="relative mb-6">
                                            <div
                                                class="w-full inline-flex items-center"
                                            >
                                                <input
                                                    v-model="user.password"
                                                    type="password"
                                                    name="password"
                                                    id="password"
                                                    autocomplete="current-password"
                                                    required=""
                                                    placeholder="password"
                                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input
                                            id="remember-me"
                                            name="remember-me"
                                            type="checkbox"
                                            v-model="user.remember"
                                            class="h-4 w-4 rounded border-gray-300 text-purple-600 focus:ring-purple-600"
                                        />
                                        <label
                                            for="remember-me"
                                            class="ml-2 block text-sm text-gray-900"
                                            >Remember me</label
                                        >
                                    </div>

                                    <div class="text-sm">
                                        <a
                                            href="#"
                                            class="font-medium text-indigo-600 hover:text-indigo-500"
                                            >Forgot your password?</a
                                        >
                                    </div>
                                </div>

                                <div>
                                    <button
                                        v-if="!loading"
                                        type="submit"
                                        class="group relative flex w-full justify-center rounded-[1.5rem] bg-purple-700 px-3 py-4 text-sm font-semibold text-white hover:bg-purple-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600"
                                    >
                                        <span
                                            class="absolute inset-y-0 left-0 flex items-center pl-3"
                                        >
                                            <LockClosedIcon
                                                class="h-5 w-5 text-purple-500 group-hover:text-purple-400"
                                                aria-hidden="true"
                                            />
                                        </span>
                                        Sign in
                                    </button>
                                    <button
                                        v-else
                                        type="submit"
                                        class="group relative flex w-full justify-center rounded-[1.5rem] bg-purple-700 px-3 py-4 text-sm font-semibold text-white hover:bg-purple-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-600"
                                    >
                                        <svg
                                            class="animate-spin h-8 w-8 text-white"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                class="opacity-75"
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="relative mt-16 h-80 lg:mt-8">
                    <img
                        class="absolute left-0 top-0 w-[57rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10"
                        src="../assets/discovery.jpg"
                        alt="people"
                        width="1824"
                        height="1080"
                    />
                </div>
            </div>
        </div>
        <footer class="md:pt-10">
            <p class="text-center text-xs font-medium text-gray-500">
                © 2023 Creatorpa.ge - All Rights Reserved
            </p>
        </footer>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useStore } from "vuex";
import { useRouter, useRoute } from "vue-router";
const store = useStore();
const router = useRouter();
const route = useRoute();

let errorMsg = ref();
let loading = ref(false);

const user = {
    email: "",
    password: "",
    remember: false,
};

const login = async (ev) => {
    loading.value = true;
    errorMsg.value = null;
    ev.preventDefault();
    //await userStore.getTokens();
    await store
        .dispatch("login", user)
        .then((data) => {
            console.log(data);
            //store.dispatch("getUser");
            //store.dispatch("getAllLinks");

            loading.value = false;
            router.push({
                name: "UserDashboard",
            });
            // } else {
            //   loading.value = false;
            //   router.push({
            //     name: "SetUsername",
            //   });
            // }
        })
        .catch((error) => {
            console.log(error);
            loading.value = false;
            if (error.response.data.errors) {
                errorMsg.value = error.response.data.message;
            } else {
                errorMsg.value = error.response.data.error;
            }
        });
};
</script>

<style></style>
