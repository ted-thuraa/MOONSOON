<template>
    <h1
        class="text-black self-center text-xl font-semibold sm:text-2xl whitespace-nowrap"
    >
        Student registration
    </h1>
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

    if (store.state.user.isAdmin) {
        router.push({
            name: "AdminDash",
        });
    }
    //loading.value = false;
});
</script>

<style></style>
