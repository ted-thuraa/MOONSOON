import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            id: "",
            uuid: "",
            currentplan: "",
            page_font: "",
            theme_id: "",
            fullname: "",
            username: "",
            page_layout: "",
            email: "",
            image: "",
            bio: "",
            location: "",
            creator_category: "",
            colors: null,
            removeBranding: false,
            is_email_verified: false,
            isMailchimpAuthorized: false,
            isGooglesheetsAuthorized: false,
            isMobile: false,
            updatedLinkId: 0,
            addLinkOverlay: false,
            isPreviewOverlay: false,
            isAdmin: sessionStorage.getItem("isAdmin"),
            token: sessionStorage.getItem("TOKEN"),
            loading: true,
            //token: 124,
        },

        //Admin
        users: {
            loading: false,
            data: [],
        },
        analytics: {
            loading: false,
            data: {},
        },
        hostels: {
            loading: false,
            data: [],
        },
        currentHostel: {
            loading: false,
            data: {},
        },

        rooms: {
            loading: false,
            data: [],
        },

        reservations: {
            loading: false,
            data: [],
        },

        //loading and toasts
        notification: {
            show: false,
            type: null,
            message: null,
        },
    },
    getters: {},
    actions: {
        //auth
        async login({ commit }, user) {
            await axiosClient.post("/login", user).then(({ data }) => {
                commit("setUserLoading", true);
                commit("setUser", data.user);
                commit("setIsAdmin", data.user.isAdmin);
                commit("setToken", data.token);

                return data;
            });
        },

        async verifyemailtoken({ commit }, code) {
            commit("setUserLoading", true);
            return axiosClient
                .post("/verify-email-token", { code: code })
                .then(({ data }) => {
                    commit("setUser", data.user);
                    commit("setIsAdmin", data.user.isAdmin);
                    commit("setToken", data.token);
                    console.log(data.user);

                    return data;
                })
                .catch((error) => {
                    console.log(error);
                    //throw error;
                    return error;
                });
        },
        async register({ commit }, user) {
            await axiosClient.post("/register", user).then(({ data }) => {
                commit("setUserLoading", true);
                commit("setUser", data.user);
                commit("setIsAdmin", data.user.isAdmin);
                commit("setToken", data.token);

                return data;
            });
        },
        async logout({ commit }) {
            return axiosClient.post("/logout").then((response) => {
                commit("setToken", null);
                commit("setIsAdmin", null);
                commit("resetState");
                return response;
            });
        },

        async getUser({ commit }) {
            return axiosClient.get("/user").then(({ data }) => {
                commit("setUserLoading", true);
                commit("setUser", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                console.log(data.data);

                return data;
            });
        },

        async showHostels({ commit }) {
            await axiosClient.get("/showHostel").then(({ data }) => {
                //commit("setUserLoading", true);
                console.log(data);
                commit("setHostels", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                //console.log(data);
                return data;
            });
        },

        async getHostel({ commit }, id) {
            await axiosClient
                .get(`/getCurrentHostel/${id}`)
                .then(({ data }) => {
                    //commit("setUserLoading", true);
                    console.log(data);
                    commit("setCurrentHostel", data.data);
                    //commit("setIsAdmin", data.user.isAdmin);
                    //commit("setToken", data.token);
                    //console.log(data);
                    return data;
                });
        },

        async createReservation({ commit }, reservationDetails) {
            return axiosClient
                .post("/createreservation", reservationDetails)
                .then(({ data }) => {
                    //commit("setUserLoading", true);
                    //commit("setUser", data.data);
                    //commit("setIsAdmin", data.user.isAdmin);
                    //commit("setToken", data.token);
                    //console.log(data.data);

                    return data;
                });
        },

        //Admin

        async getAnalytics({ commit }) {
            return axiosClient.get("/admin/analytics").then(({ data }) => {
                //commit("setUserLoading", true);
                commit("setAnalytics", data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                console.log(data.data);

                return data;
            });
        },

        async getUsers({ commit }) {
            return axiosClient.get("/admin/users").then(({ data }) => {
                commit("setUserLoading", true);
                commit("setUsers", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                console.log(data.data);

                return data;
            });
        },

        async getHostels({ commit }) {
            await axiosClient.get("/admin/getHostel").then(({ data }) => {
                //commit("setUserLoading", true);
                console.log(data);
                commit("setHostels", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                //console.log(data);
                return data;
            });
        },
        async getReservations({ commit }) {
            await axiosClient.get("/admin/getReservations").then(({ data }) => {
                //commit("setUserLoading", true);
                console.log(data);
                commit("setReservations", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                //console.log(data);
                return data;
            });
        },
        async createNewHostel({ commit }, HostelDetails) {
            await axiosClient
                .post("/admin/newHostel", HostelDetails)
                .then(({ data }) => {
                    //commit("setUserLoading", true);
                    console.log(data);
                    commit("setHostels", data.data);
                    //commit("setIsAdmin", data.user.isAdmin);
                    //commit("setToken", data.token);
                    //console.log(data);
                    return data;
                });
        },
        async deleteHostel({ dispatch }, id) {
            await axiosClient.delete(`/admin/Hostel/${id}`).then(({ data }) => {
                dispatch("getHostels");
                return;
            });
        },
        async getRooms({ commit }, id) {
            await axiosClient.get(`/admin/getRoom/${id}`).then(({ data }) => {
                //commit("setUserLoading", true);
                console.log(data);
                commit("setRooms", data.data);
                //commit("setIsAdmin", data.user.isAdmin);
                //commit("setToken", data.token);
                //console.log(data);
                return data;
            });
        },
        async createNewRoom({ commit }, RoomDetails) {
            await axiosClient
                .post("/admin/newroom", RoomDetails)
                .then(({ data }) => {
                    //commit("setUserLoading", true);
                    console.log(data);
                    commit("setRoom", data.data);
                    //commit("setIsAdmin", data.user.isAdmin);
                    //commit("setToken", data.token);
                    //console.log(data);
                    return data;
                });
        },
        async assignRoom({ commit }, allocationDetails) {
            await axiosClient
                .post("/admin/assignroom", allocationDetails)
                .then(({ data }) => {
                    //commit("setUserLoading", true);
                    console.log(data);
                    //commit("setRoom", data.data);
                    //commit("setIsAdmin", data.user.isAdmin);
                    //commit("setToken", data.token);
                    //console.log(data);
                    return data;
                });
        },
        async deleteRoom({ dispatch }, id) {
            await axiosClient.delete(`/admin/room/${id}`).then(({ data }) => {
                dispatch("getRooms");
                return;
            });
        },
    },
    mutations: {
        logout: (state) => {
            state.user.data = {};
            state.user.token = null;
            state.user.isAdmin = false;
            //sessionStorage.setItem("isAdmin", false);
            //sessionStorage.setItem("TOKEN", null);
        },
        setUserLoading: (state, status) => {
            state.user.loading = status;
        },
        setUser: (state, user) => {
            console.log(user);
            state.user.id = user.id;
            state.user.uuid = user.id;
            state.user.email = user.email;

            state.user.name = user.name;

            state.user.loading = false;
            state.user.isAdmin = user.isAdmin === 1 ? true : false;
            console.log(user.isAdmin);
            if (user.isAdmin) {
                sessionStorage.setItem("isAdmin", true);
            } else {
                sessionStorage.removeItem("isAdmin");
            }
        },
        setIsAdmin: (state, isAdmin) => {
            console.log(isAdmin);
            state.user.isAdmin = isAdmin === 1 ? true : false;
            if (isAdmin) {
                sessionStorage.setItem("isAdmin", isAdmin === 1 ? true : false);
            } else {
                sessionStorage.removeItem("isAdmin");
            }
        },
        setToken: (state, token) => {
            state.user.token = token;
            if (token) {
                sessionStorage.setItem("TOKEN", token);
            } else {
                sessionStorage.removeItem("TOKEN");
            }
        },

        notify: (state, { message, type }) => {
            state.notification.show = true;
            state.notification.type = type;
            state.notification.message = message;
            setTimeout(() => {
                state.notification.show = false;
            }, 3000);
        },

        resetState: (state) => {
            state.user.id = "";
            state.user.name = "";
            state.user.email = "";
            //state.user.image = "";
        },

        // admin mutations
        setUsers: (state, data) => {
            console.log(data);
            state.users.data = data;
        },
        setHostels: (state, data) => {
            console.log(data);
            state.hostels.data = data;
        },
        setCurrentHostel: (state, data) => {
            console.log(data);
            state.currentHostel.data = data;
        },
        setRooms: (state, data) => {
            console.log(data);
            state.rooms.data = data;
        },
        setReservations: (state, data) => {
            console.log(data);
            state.reservations.data = data;
        },
        setAnalytics: (state, data) => {
            console.log(data);
            state.analytics.data = data;
        },
    },
    persist: true,
    modules: {},
});

export default store;
