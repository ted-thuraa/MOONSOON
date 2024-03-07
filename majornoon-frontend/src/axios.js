import axios from "axios";
import store from "./store";

const axiosClient = axios.create({
    baseURL: "http://127.0.0.1:8000/api",
});

axiosClient.interceptors.request.use((config) => {
    config.headers.authorization = `Bearer ${store.state.user.token}`;
    return config;
});

axiosClient.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        switch (error.response.status) {
            case 401: // Not logged in
                store.commit("setToken", null);
                window.location.href = "/login";
            default:
                // Allow individual requests to handle other errors
                throw error;
            //return Promise.reject(error);
        }
    }
);

export default axiosClient;
