import { createRouter, createWebHistory } from "vue-router";
import store from "../store";
import LandingPage from "../views/Index.vue";
import HostelView from "../views/HostelView.vue";
import UserDashboard from "../views/Dashboard.vue";
import AdminDash from "../views/Admin/Dashboard.vue";
import users from "../views/Admin/Users.vue";
import Hostels from "../views/Admin/Hostels.vue";
import Reservations from "../views/Admin/Reservations.vue";
import Rooms from "../views/Admin/Rooms.vue";
import Login from "../views/Login.vue";
import Signup from "../views/Signup.vue";
import AdminLayout from "../layouts/AdminLayout.vue";

const routes = [
    {
        path: "/",
        name: "LandingPage",
        component: LandingPage,
        //meta: { isGuest: true },
    },
    {
        path: "/hostel/:id",
        name: "HostelView",
        component: HostelView,
        meta: { requiresAuth: true },
    },

    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: { isGuest: true },
    },

    {
        path: "/signup",
        name: "Signup",
        component: Signup,
        meta: { isGuest: true },
    },
    //   {
    //     path: "/verify/email",
    //     name: "Emailverification",
    //     component: EmailVerification,
    //   },

    {
        path: "/dashboard",
        name: "UserDashboard",
        component: UserDashboard,
        meta: { requiresAuth: true },
    },

    {
        path: "/admin/dashboard",
        name: "AdminDash",
        component: AdminLayout,
        meta: { requiresAdmin: true, requiresAuth: true },
        children: [
            {
                path: "/admin/dashboard",
                name: "AdminDash",
                component: AdminDash,
            },
            {
                path: "/admin/users",
                name: "users",
                component: users,
            },
            {
                path: "/admin/hostels",
                name: "Hostels",
                component: Hostels,
            },
            {
                path: "/admin/hostel/:id/rooms",
                name: "Rooms",
                component: Rooms,
            },
            {
                path: "/admin/reservations",
                name: "Reservations",
                component: Reservations,
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: "Login" });
    } else if (store.state.user.token && to.meta.isGuest) {
        next({ name: "LandingPage" });
    } else if (!store.state.user.isAdmin && to.meta.requiresAdmin) {
        next({ name: "LandingPage" });
    } else if (
        to.matched.some((record) => record.meta.requiresAuth) &&
        !store.state.user.token
    ) {
        next({ name: "Login" });
    } else {
        next();
    }
});
export default router;
