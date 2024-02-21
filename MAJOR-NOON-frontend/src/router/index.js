import { createRouter, createWebHistory } from "vue-router";
import store from "../store";
import LandingPage from "../views/LandingPage.vue";
import UserDashboard from "../views/Dashboard.vue";
import AdminDash from "../views/Admin/Dashboard.vue";
import Login from "../views/Login.vue";
import Signup from "../views/Signup.vue";

const routes = [
    {
        path: "/",
        //redirect: "/index",
        name: "LandingPage",
        component: LandingPage,
        //children: [{ path: "/index", name: "Landing", component: Landing }],
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
        component: AdminDash,
        meta: { requiresAdmin: true, requiresAuth: true },
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
        next({ name: "UserDashboard" });
    } else if (!store.state.user.isAdmin && to.meta.requiresAdmin) {
        next({ name: "UserDashboard" });
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
