<template>
    <div class="p-4 rounded-lg mt-14">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div
                className="shadow bg-white  h-44 rounded-xl w-full mb-4 p-8 pt-9 md:m-3 bg-hero-pattern bg-no-repeat bg-cover bg-center"
            >
                <div className=" flex justify-between items-center">
                    <div>
                        <p className="font-semibold text-gray-400">hostels</p>
                        <p className="text-2xl font-bold text-gray-700">
                            {{ store.state.analytics.data.hostels }} .
                        </p>
                    </div>
                    <div
                        className="bg-green-200 text-white hover:drop-shadow-xl rounded-md  p-4"
                    >
                        <div
                            className="text-2xl opacity-0.9 bg-green-400 text-white hover:drop-shadow-xl rounded-full  p-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div
                className="shadow bg-white dark:text-gray-200 dark:bg-secondary-dark-bg h-44 rounded-xl w-full mb-4 p-8 pt-9 md:m-3 bg-hero-pattern bg-no-repeat bg-cover bg-center"
            >
                <div className="flex justify-between items-center">
                    <div>
                        <p className="font-semibold text-gray-400">Users</p>
                        <p className="text-2xl font-bold text-gray-700">
                            {{ store.state.analytics.data.users }}.
                        </p>
                    </div>

                    <div
                        className="bg-amber-200 text-white hover:drop-shadow-xl rounded-md  p-4"
                    >
                        <div
                            className="text-2xl opacity-0.9 bg-amber-400 text-white hover:drop-shadow-xl rounded-full  p-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div
                className="shadow bg-white dark:text-gray-200 dark:bg-secondary-dark-bg h-44 rounded-xl w-full mb-4 p-8 pt-9 md:m-3 bg-hero-pattern bg-no-repeat bg-cover bg-center"
            >
                <div className="flex justify-between items-center">
                    <div>
                        <p className="font-semibold text-gray-400">
                            Reservations
                        </p>
                        <p className="text-2xl font-bold text-gray-700">
                            {{ store.state.analytics.data.reservations }}.
                        </p>
                    </div>

                    <div
                        className="bg-orange-200 text-white hover:drop-shadow-xl rounded-md  p-4"
                    >
                        <div
                            className="text-2xl opacity-0.9 bg-orange-400 text-white hover:drop-shadow-xl rounded-full  p-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50"
        >
            <p class="text-2xl text-gray-400">
                <svg
                    class="w-3.5 h-3.5"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 18 18"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 1v16M1 9h16"
                    />
                </svg>
            </p>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, computed, onMounted, isProxy, toRaw, nextTick } from "vue";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

const store = useStore();
const route = useRoute();
const router = useRouter();

onMounted(async () => {
    //loading.value = true;
    await store.dispatch("getUser");
    await store.dispatch("getAnalytics");

    //loading.value = false;
});
</script>

<style></style>
