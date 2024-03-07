<template>
    <div
        class="max-w-[80rem] mt-6 mx-12 relative flex w-full items-center overflow-hidden bg-white"
    >
        <div class="w-full pb-20">
            <div
                class="grid mt-6 w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8"
            >
                <div
                    class="h-[25rem] w-full overflow-hidden rounded-lg bg-gray-100 sm:col-span-8 lg:col-span-7"
                >
                    <img
                        :src="store.state.currentHostel.data.thumbnailimage"
                        :alt="store.state.currentHostel.data.hostel_name"
                        class="w-full h-full object-cover object-center"
                    />
                </div>
                <div class="sm:col-span-4 lg:col-span-5">
                    <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">
                        {{ store.state.currentHostel.data.hostel_name }}
                    </h2>

                    <section aria-labelledby="information-heading" class="mt-2">
                        <h3 class="text-gray-700">
                            {{ store.state.currentHostel.data.location }}
                        </h3>
                    </section>
                </div>
            </div>
            <div class="px-4 mt-10">
                <p class="my-6 text-black">
                    {{ store.state.currentHostel.data.description }}
                </p>
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">
                        Reservation Information
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Use a permanent address where you can receive mail.
                    </p>

                    <div
                        class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                    >
                        <div class="sm:col-span-2">
                            <label
                                for="country"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Room type</label
                            >
                            <div class="mt-2">
                                <select
                                    v-model="reservationDetails.room_type"
                                    id="country"
                                    name="country"
                                    autocomplete="country-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                >
                                    <option
                                        v-for="room in store.state.currentHostel
                                            .data.rooms"
                                        :key="room.id"
                                    >
                                        {{ room.room_type }}
                                    </option>
                                    <!-- <option>Canada</option>
                                    <option>Mexico</option> -->
                                </select>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label
                                for="region"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Start date</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="reservationDetails.start_date"
                                    type="date"
                                    name="region"
                                    id="region"
                                    autocomplete="address-level1"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label
                                for="postal-code"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >End date</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="reservationDetails.end_date"
                                    type="date"
                                    name="postal-code"
                                    id="postal-code"
                                    autocomplete="postal-code"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label
                                for="price"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Price</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="reservationDetails.price"
                                    type="number"
                                    name="price"
                                    id="price"
                                    autocomplete="price"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label
                                for="price"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Phone number</label
                            >
                            <div class="mt-2">
                                <input
                                    v-model="reservationDetails.phone"
                                    type="number"
                                    name="phone"
                                    id="phone"
                                    required
                                    autocomplete="phone"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                />
                            </div>
                        </div>
                        <button
                            @click="saveReservation"
                            type="button"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Book room (ksh 20)
                        </button>
                    </div>
                </div>
                <h3 class="font-bold text-2xl text-black">Reviews</h3>
                <figure class="mt-10 max-w-screen-md">
                    <div class="flex items-center mb-4 text-yellow-300">
                        <svg
                            class="w-5 h-5 me-1"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 22 20"
                        >
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
                            />
                        </svg>
                        <svg
                            class="w-5 h-5 me-1"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 22 20"
                        >
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
                            />
                        </svg>
                        <svg
                            class="w-5 h-5 me-1"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 22 20"
                        >
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
                            />
                        </svg>
                        <svg
                            class="w-5 h-5 me-1"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 22 20"
                        >
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
                            />
                        </svg>
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 22 20"
                        >
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"
                            />
                        </svg>
                    </div>
                    <blockquote>
                        <p class="text-2xl font-semibold text-gray-900">
                            "Flowbite is just awesome. It contains tons of
                            predesigned components and pages starting from login
                            screen to complex dashboard. Perfect choice for your
                            next SaaS application."
                        </p>
                    </blockquote>
                    <figcaption
                        class="flex items-center mt-6 space-x-3 rtl:space-x-reverse"
                    >
                        <img
                            class="w-6 h-6 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"
                            alt="profile picture"
                        />
                        <div
                            class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-300"
                        >
                            <cite class="pe-3 font-medium text-gray-900"
                                >Bonnie Green</cite
                            >
                            <cite class="ps-3 text-sm text-gray-500"
                                >CTO at Flowbite</cite
                            >
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</template>

<script setup>
import store from "../store";
import { ref, watch, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

let hostelModel = ref(null);

const reservationDetails = {
    hostel_id: null,
    hostel_name: "",
    room_type: "",
    start_date: null,
    end_date: null,
    phone: null,
    price: 20,
};

//if (route.params.id) {
//    await store.dispatch("getHostel", route.params.id);
//}

onMounted(async () => {
    //loading.value = true;
    await store.dispatch("getUser");
    await store.dispatch("getHostel", route.params.id);
});

const saveReservation = async (ev) => {
    reservationDetails.hostel_id = route.params.id;
    reservationDetails.hostel_name = store.state.currentHostel.data.hostel_name;
    //loading.value = true;
    //errorMsg.value = null;
    ev.preventDefault();
    //await userStore.getTokens();
    await store
        .dispatch("createReservation", reservationDetails)
        .then((data) => {
            console.log(data);

            //loading.value = false;
            // router.push({
            //     name: "UserDashboard",
            // });
        })
        .catch((error) => {
            console.log(error);
        });
};
//
//watch(
//    () => store.state.currentHostel.data,
//    (newVal, oldVal) => {
//        hostelModel.value = store.state.currentHostel.data;
//    }
//);
</script>

<style lang="scss" scoped></style>
