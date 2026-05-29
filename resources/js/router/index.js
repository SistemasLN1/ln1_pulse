import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";

const routes = [
    { path: "/", redirect: "/dashboard" },
    {
        path: "/login",
        name: "Login",
        component: () => import("../pages/LoginPage.vue"),
        meta: { soloInvitados: true },
    },
    {
        path: "/dashboard",
        component: () => import("../layouts/AppLayout.vue"),
        meta: { requiereAuth: true },
        children: [
            {
                path: "",
                name: "Dashboard", // ← aquí
                component: () => import("../pages/DashboardPage.vue"),
            },
            {
                path: "proyectos",
                name: "Proyectos",
                component: () => import("../pages/ProyectosPage.vue"),
            },
            {
                path: "avances",
                name: "Avances",
                component: () => import("../pages/AvancesPage.vue"),
            },
            {
                path: "kpis",
                name: "KPIs",
                component: () => import("../pages/KPIsPage.vue"),
            },
            {
                path: "integraciones",
                name: "Integraciones",
                component: () => import("../pages/IntegracionesPage.vue"),
            },
            {
                path: "configuracion",
                name: "Configuracion",
                component: () => import("../pages/ConfiguracionPage.vue"),
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to) => {
    const auth = useAuthStore();

    if (to.meta.requiereAuth && !auth.sesionActiva) {
        return { name: "Login" };
    }

    if (to.meta.soloInvitados && auth.sesionActiva) {
        return { name: "Dashboard" };
    }
});

export default router;
