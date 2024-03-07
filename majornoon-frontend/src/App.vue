<script setup>
import { ref, watch, computed, onMounted } from "vue";
//import store from "./store";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";
const store = useStore();
let show = ref(false);

onMounted(async () => {
    try {
        if (store.state.user.id) {
            await store.dispatch("getUser");
        }
    } catch (error) {
        console.log(error);
    }

    setTimeout(() => (show.value = true), 1);
});
</script>

<template>
    <router-view></router-view>
</template>

<style scoped></style>
