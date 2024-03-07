<template>
    <div>
        <div class="relative mt-16 overflow-x-auto shadow-md sm:rounded-lg">
            <!-- dialog -->
            <div>
                <div class="my-4 z-10 inset-0 flex items-center justify-center">
                    <!-- <button
                        location="button"
                        @click="openModal"
                        class="rounded-md bg-indigo-700 px-4 py-2 text-sm font-medium text-white hover:bg-indigo/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                    >
                        Add new Hostel
                    </button> -->
                </div>
                <TransitionRoot appear :show="isOpen" as="template">
                    <Dialog as="div" @close="closeModal" class="relative z-80">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="fixed z-50 inset-0 bg-black/25" />
                        </TransitionChild>

                        <div class="fixed z-[60] inset-0 overflow-y-auto">
                            <div
                                class="flex min-h-full items-center justify-center p-4 text-center"
                            >
                                <TransitionChild
                                    as="template"
                                    enter="duration-300 ease-out"
                                    enter-from="opacity-0 scale-95"
                                    enter-to="opacity-100 scale-100"
                                    leave="duration-200 ease-in"
                                    leave-from="opacity-100 scale-100"
                                    leave-to="opacity-0 scale-95"
                                >
                                    <DialogPanel
                                        class="w-full max-w-[60rem] transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                    >
                                        <div class="mt- flex justify-end">
                                            <button
                                                location="button"
                                                class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                                @click="closeModal"
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
                                                        d="M6 18 18 6M6 6l12 12"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                        <DialogTitle
                                            as="h3"
                                            class="w-full text-center font-bold text-xl leading-6 text-gray-900"
                                        >
                                            Allocate room.
                                        </DialogTitle>
                                        <div class="mx-40 mt-20 mb-20">
                                            <div>
                                                <div class="px-4 sm:px-0">
                                                    <h3
                                                        class="text-base font-semibold leading-7 text-gray-900"
                                                    >
                                                        Reservation Information
                                                    </h3>
                                                    <p
                                                        class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"
                                                    >
                                                        Personal details and
                                                        application.
                                                    </p>
                                                </div>
                                                <div
                                                    class="mt-6 border-t border-gray-100"
                                                >
                                                    <dl
                                                        class="divide-y divide-gray-100"
                                                    >
                                                        <div
                                                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                                                        >
                                                            <dt
                                                                class="text-sm font-medium leading-6 text-gray-900"
                                                            >
                                                                Full name
                                                            </dt>
                                                            <dd
                                                                class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                                            >
                                                                {{
                                                                    reservationDetails.user_name
                                                                }}
                                                            </dd>
                                                        </div>
                                                        <div
                                                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                                                        >
                                                            <dt
                                                                class="text-sm font-medium leading-6 text-gray-900"
                                                            >
                                                                Application for
                                                            </dt>
                                                            <dd
                                                                class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                                            >
                                                                {{
                                                                    reservationDetails.hostel_name
                                                                }}
                                                            </dd>
                                                        </div>
                                                        <div
                                                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                                                        >
                                                            <dt
                                                                class="text-sm font-medium leading-6 text-gray-900"
                                                            >
                                                                Room Type
                                                            </dt>
                                                            <dd
                                                                class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                                            >
                                                                {{
                                                                    reservationDetails.room_type
                                                                }}
                                                            </dd>
                                                        </div>
                                                        <div
                                                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                                                        >
                                                            <dt
                                                                class="text-sm font-medium leading-6 text-gray-900"
                                                            >
                                                                Start date
                                                            </dt>
                                                            <dd
                                                                class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                                            >
                                                                {{
                                                                    reservationDetails.start_date
                                                                }}
                                                            </dd>
                                                        </div>
                                                        <div
                                                            class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0"
                                                        >
                                                            <dt
                                                                class="text-sm font-medium leading-6 text-gray-900"
                                                            >
                                                                End date
                                                            </dt>
                                                            <dd
                                                                class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"
                                                            >
                                                                {{
                                                                    reservationDetails.end_date
                                                                }}
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="space-y-12">
                                                    <div
                                                        class="border-b border-gray-900/10 pb-12"
                                                    >
                                                        <div
                                                            class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                                                        >
                                                            <div
                                                                class="sm:col-span-3"
                                                            >
                                                                <label
                                                                    for="location"
                                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                                    >Room
                                                                    No</label
                                                                >
                                                                <div
                                                                    class="mt-2"
                                                                >
                                                                    <select
                                                                        v-model="
                                                                            allocationDetails.room
                                                                        "
                                                                        id="room_no"
                                                                        name="room_no"
                                                                        autocomplete="family-name"
                                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                                    >
                                                                        <option
                                                                            v-for="room in store
                                                                                .state
                                                                                .currentHostel
                                                                                .data
                                                                                .rooms"
                                                                            :key="
                                                                                room.id
                                                                            "
                                                                        >
                                                                            {{
                                                                                room.room_no
                                                                            }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="mt-6 flex items-center justify-end gap-x-6"
                                                >
                                                    <button
                                                        @click="assignRoom()"
                                                        type="submit"
                                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                    >
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot>
            </div>
            <!-- dialog -->
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500"
            >
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Applicant</th>
                        <th scope="col" class="px-6 py-3">Hostel</th>
                        <th scope="col" class="px-6 py-3">Room type</th>
                        <th scope="col" class="px-6 py-3">start date</th>
                        <th scope="col" class="px-6 py-3">end date</th>
                        <th scope="col" class="px-6 py-3 flex flex-row">
                            status
                        </th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="application in store.state.reservations.data"
                        :key="application"
                        class="bg-white border-b hover:bg-gray-50"
                    >
                        <td class="px-4 py-4">{{ application.user_name }}</td>
                        <td class="px-4 py-4">{{ application.hostel_name }}</td>
                        <td class="px-4 py-4">{{ application.room_type }}</td>
                        <td class="px-4 py-4">{{ application.start_date }}</td>
                        <td class="px-4 py-4">{{ application.end_date }}</td>
                        <td class="px-4 py-4">{{ application.status }}</td>
                        <td class="px-4 py-4">
                            <a
                                @click="Allocate(application)"
                                class="font-medium text-indigo-600 hover:underline pl-2"
                                >Allocate
                            </a>
                            <!-- <a
                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                ><svg
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
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                    />
                                </svg>
                            </a> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { useRouter, useRoute } from "vue-router";
import { ref, watch, onMounted } from "vue";
import store from "../../store";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

const route = useRoute();

const router = useRouter();

let thumbnail_url = ref(null);

const reservationDetails = {
    booking_id: null,
    user_id: null,
    user_name: "",
    hostel_id: null,
    hostel_name: "",
    room_type: "",
    status: "",
    start_date: null,
    end_date: null,
};
const allocationDetails = ref({
    user_id: null,
    user_name: "",
    hostel: "",
    hostel_id: null,
    room_id: null,
    booking_id: null,
    room: "",
    hostel_name: "",
    room_type: "",
    active: true,
    start_date: null,
    end_date: null,
});

onMounted(async () => {
    //loading.value = true;
    await store.dispatch("getUser");
    await store.dispatch("getReservations");
});

async function Allocate(application) {
    reservationDetails.booking_id = application.id;
    reservationDetails.user_id = application.user_id;
    reservationDetails.user_name = application.user_name;
    reservationDetails.hostel_id = application.hostel_id;
    reservationDetails.hostel_name = application.hostel_name;
    reservationDetails.room_type = application.room_type;
    reservationDetails.status = application.status;
    reservationDetails.start_date = application.start_date;
    reservationDetails.end_date = application.end_date;
    await store.dispatch("getHostel", application.hostel_id);

    isOpen.value = true;
}
const assignRoom = async (ev) => {
    allocationDetails.value.user_id = reservationDetails.user_id;
    allocationDetails.value.hostel_id = reservationDetails.hostel_id;
    allocationDetails.value.booking_id = reservationDetails.booking_id;
    allocationDetails.value.user_name = reservationDetails.user_name;
    allocationDetails.value.hostel = reservationDetails.hostel_name;
    //allocationDetails.value.room = reservationDetails.room;
    allocationDetails.value.active = reservationDetails.active;
    allocationDetails.value.start_date = reservationDetails.start_date;
    allocationDetails.value.end_date = reservationDetails.end_date;
    //ev.preventDefault();
    //await userStore.getTokens();
    console.log(allocationDetails);
    await store
        .dispatch("assignRoom", allocationDetails.value)
        .then((data) => {
            console.log(data);
            store.dispatch("getReservations");
            closeModal();
            //loading.value = false;
            // router.push({
            //     name: "UserDashboard",
            // });
        })
        .catch((error) => {
            console.log(error);
        });
};

function deleteHostel(Hostel) {
    if (confirm(`Are you sure, this cant be undone!`)) {
        store.dispatch("deleteHostel", Hostel.id).then(() => {
            closeModal();
        });
    }
}

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
    reservationDetails.user_id = null;
    reservationDetails.user_name = "";
    reservationDetails.hostel_id = null;
    reservationDetails.hostel_name = "";
    reservationDetails.room_type = "";
    reservationDetails.status = "";
    reservationDetails.start_date = null;
    reservationDetails.end_date = null;
    thumbnail_url.value = null;
}
function openModal() {
    isOpen.value = true;
}
</script>

<style lang="scss" scoped></style>
