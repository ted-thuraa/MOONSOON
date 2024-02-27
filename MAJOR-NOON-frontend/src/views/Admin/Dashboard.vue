<template>
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div
                class="flex items-center justify-center h-24 rounded bg-gray-50"
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
            <div
                class="flex items-center justify-center h-24 rounded bg-gray-50"
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
            <div
                class="flex items-center justify-center h-24 rounded bg-gray-50"
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

    //loading.value = false;
});
</script>

<style></style>
