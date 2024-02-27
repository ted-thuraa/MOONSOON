<template>
    <div>
        <div class="relative mt-16 overflow-x-auto shadow-md sm:rounded-lg">
            <!-- dialog -->
            <div>
                <div class="my-4 z-10 inset-0 flex items-center justify-center">
                    <button
                        location="button"
                        @click="openModal"
                        class="rounded-md bg-indigo-700 px-4 py-2 text-sm font-medium text-white hover:bg-indigo/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                    >
                        Add new room
                    </button>
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
                                            room details.
                                        </DialogTitle>
                                        <div class="mx-40 mt-20 mb-20">
                                            <form @submit.prevent="saveroom">
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
                                                                    for="room_no"
                                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                                    >Room
                                                                    No</label
                                                                >
                                                                <div
                                                                    class="mt-2"
                                                                >
                                                                    <input
                                                                        v-model="
                                                                            roomDetails.room_no
                                                                        "
                                                                        location="text"
                                                                        name="room_no"
                                                                        id="room_no"
                                                                        autocomplete="given-name"
                                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="sm:col-span-3"
                                                            >
                                                                <label
                                                                    for="location"
                                                                    class="block text-sm font-medium leading-6 text-gray-900"
                                                                    >Room
                                                                    Type</label
                                                                >
                                                                <div
                                                                    class="mt-2"
                                                                >
                                                                    <select
                                                                        v-model="
                                                                            roomDetails.room_type
                                                                        "
                                                                        id="room_type"
                                                                        name="room_type"
                                                                        autocomplete="family-name"
                                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                                                    >
                                                                        <option>
                                                                            Single
                                                                        </option>
                                                                        <option>
                                                                            Bedsitter
                                                                        </option>
                                                                        <option>
                                                                            One
                                                                            Bedroom
                                                                        </option>
                                                                        <option>
                                                                            Two
                                                                            Bedroom
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="sm:col-span-3"
                                                            >
                                                                <div
                                                                    class="sm:col-span-3"
                                                                >
                                                                    <label
                                                                        for="billing"
                                                                        class="block text-sm font-medium leading-6 text-gray-900"
                                                                        >Room
                                                                        billing</label
                                                                    >
                                                                    <div
                                                                        class="mt-2 flex flex-row"
                                                                    >
                                                                        <input
                                                                            v-model="
                                                                                roomDetails.billing
                                                                            "
                                                                            name="billing"
                                                                            id="billing"
                                                                            type="number"
                                                                            autocomplete="family-name"
                                                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                                        />
                                                                        <span
                                                                            class="pl-2 text-gray-700 whitespace-nowrap"
                                                                            >/
                                                                            month</span
                                                                        >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="sm:col-span-3 flex flex-row gap-x-1 items-center"
                                                            >
                                                                <legend
                                                                    class="text-sm font-semibold leading-6 text-gray-900"
                                                                >
                                                                    Available
                                                                    for booking
                                                                </legend>
                                                                <div
                                                                    class="mt-6 space-y-6"
                                                                >
                                                                    <div
                                                                        class="flex items-center gap-x-3"
                                                                    >
                                                                        <label
                                                                            class="inline-flex items-center mb-5 cursor-pointer"
                                                                        >
                                                                            <input
                                                                                v-model="
                                                                                    roomDetails.available
                                                                                "
                                                                                id="available"
                                                                                name="available"
                                                                                type="checkbox"
                                                                                value=""
                                                                                class="sr-only peer"
                                                                            />
                                                                            <div
                                                                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:bg-blue-600"
                                                                            ></div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="sm:col-span-6"
                                                            >
                                                                <label
                                                                    for="description"
                                                                    class="block mb-2 text-sm font-medium text-gray-900"
                                                                    >description</label
                                                                >
                                                                <textarea
                                                                    v-model="
                                                                        roomDetails.description
                                                                    "
                                                                    id="description"
                                                                    rows="4"
                                                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                                    placeholder="Write description here..."
                                                                ></textarea>
                                                            </div>

                                                            <div
                                                                class="sm:col-span-6"
                                                            >
                                                                <label
                                                                    class="block text-sm font-medium text-gray-700"
                                                                >
                                                                    room image
                                                                </label>
                                                                <div
                                                                    class="mt-1 w-full flex items-center"
                                                                >
                                                                    <img
                                                                        v-if="
                                                                            thumbnail_url
                                                                        "
                                                                        :src="
                                                                            thumbnail_url
                                                                        "
                                                                        :alt="
                                                                            roomDetails.room_name
                                                                        "
                                                                        class="w-64 h-48 object-cover"
                                                                    />
                                                                    <span
                                                                        v-else
                                                                        class="flex items-center justify-center h-[50%] w-[50%] overflow-hidden bg-gray-100"
                                                                    >
                                                                        <svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none"
                                                                            viewBox="0 0 24 24"
                                                                            stroke-width="1.5"
                                                                            stroke="currentColor"
                                                                            class="w-[80%] h-[80%] text-gray-300"
                                                                        >
                                                                            <path
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                                                                            />
                                                                        </svg>
                                                                    </span>
                                                                    <button
                                                                        type="button"
                                                                        class="relative overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                                    >
                                                                        <input
                                                                            type="file"
                                                                            @change="
                                                                                onImageChange
                                                                            "
                                                                            class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer"
                                                                        />
                                                                        Change
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="mt-6 flex items-center justify-end gap-x-6"
                                                >
                                                    <button
                                                        location="submit"
                                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                    >
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
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
                        <th scope="col" class="px-6 py-3">Image</th>
                        <th scope="col" class="px-6 py-3">Room No</th>
                        <th scope="col" class="px-6 py-3">Room Type</th>
                        <th scope="col" class="px-6 py-3">Billing</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="room in store.state.rooms.data"
                        :key="room"
                        class="bg-white border-b hover:bg-gray-50"
                    >
                        <th
                            scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"
                        >
                            <img
                                class="w-10 h-10 rounded-full"
                                :src="room.thumbnailimage"
                                alt="room"
                            />
                            <div class="ps-3">
                                <div class="text-base font-semibold">
                                    Neil Sims
                                </div>
                                <div class="font-normal text-gray-500">
                                    neil.sims@flowbite.com
                                </div>
                            </div>
                        </th>
                        <td class="px-6 py-4">{{ room.room_no }}</td>
                        <td class="px-6 py-4">{{ room.room_type }}</td>
                        <td class="px-6 py-4">{{ room.billing }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div
                                    class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"
                                ></div>
                                Online
                            </div>
                        </td>

                        <td>
                            <a
                                @click="editRoom(room)"
                                class="font-medium text-indigo-600 hover:underline pl-2"
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
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                    />
                                </svg>
                            </a>

                            <a
                                @click="deleteRoom(room)"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline"
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
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                    />
                                </svg>
                            </a>
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

const roomDetails = {
    hostel_id: null,
    hostel_name: "",
    available: false,
    room_type: "",
    room_no: "",
    description: "",
    billing: "",
    thumbnailimage: null,
};

if (route.params.id) {
    roomDetails.hostel_id = route.params.id;
}

onMounted(async () => {
    //loading.value = true;
    await store.dispatch("getUser");
    await store.dispatch("getRooms", route.params.id);
});

function onImageChange(ev) {
    //get the first one
    const file = ev.target.files[0];

    //file preview
    const reader = new FileReader();
    reader.onload = () => {
        //field tosend to backend
        roomDetails.thumbnailimage = reader.result;

        //field for the preview
        thumbnail_url.value = reader.result;
    };
    reader.readAsDataURL(file);
}

function editRoom(room) {
    roomDetails.room_name = room.room_name;
    roomDetails.location = room.location;
    roomDetails.available = room.available;
    roomDetails.description = room.description;
    roomDetails.room_type = room.room_type;
    roomDetails.room_no = room.room_no;
    roomDetails.billing = room.billing;
    thumbnail_url.value = room.thumbnailimage;

    isOpen.value = true;
}
const saveroom = async (ev) => {
    //loading.value = true;
    //errorMsg.value = null;
    ev.preventDefault();
    //await userStore.getTokens();
    await store
        .dispatch("createNewRoom", roomDetails)
        .then((data) => {
            console.log(data);
            store.dispatch("getRooms", route.params.id);
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

function deleteRoom(room) {
    if (confirm(`Are you sure, this cant be undone!`)) {
        store.dispatch("deleteRoom", room.id).then(() => {
            closeModal();
        });
    }
}

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
    roomDetails.room_name = "";
    roomDetails.room_no = "";
    roomDetails.location = "";
    roomDetails.available = "";
    roomDetails.description = "";
    roomDetails.total_rooms = "";
    roomDetails.billing = "";
    thumbnail_url.value = null;
}
function openModal() {
    isOpen.value = true;
}
</script>

<style lang="scss" scoped></style>
