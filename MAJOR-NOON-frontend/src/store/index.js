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

        socialicons: {
            loading: false,
            data: [],
        },

        linkitems: {
            loading: false,
            data: [],
        },
        questionTypes: [
            "text",
            "select",
            "radio",
            "checkbox",
            "input",
            "textarea",
            "email",
            "date",
        ],

        //guest
        guestpagedata: {
            loading: false,
            themeId: "",
            data: [],
        },

        //Admin
        users: {
            loading: false,
            data: [],
        },
        userToEdit: {
            loading: false,
            data: [],
        },
        plans: {
            loading: false,
            data: [],
        },

        payments: {
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
                this.dispatch("getUserTheme");
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
                    this.dispatch("getUserTheme");
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
                this.dispatch("getUserTheme");
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

        //Admin
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
        // setUsersLoading: (state, loading) => {
        //   state.users.loading = loading;
        // },
        // setUsers: (state, data) => {
        //   state.users.data = data;
        // },
    },
    persist: true,
    modules: {},
});

export default store;
