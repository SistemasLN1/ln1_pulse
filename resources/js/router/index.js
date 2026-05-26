import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const routes = [
    { path: '/', redirect: '/dashboard' },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../pages/LoginPage.vue'),
        meta: { soloInvitados: true },
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: () => import('../layouts/AppLayout.vue'),
        meta: { requiereAuth: true },
        children: [
            {
                path: '',
                component: () => import('../pages/DashboardPage.vue'),
            },
            {
                path: 'proyectos',
                component: () => import('../pages/ProyectosPage.vue'),
            },
            {
                path: 'avances',
                component: () => import('../pages/AvancesPage.vue'),
            },
            {
                path: 'kpis',
                component: () => import('../pages/KPIsPage.vue'),
            },
            {
                path: 'integraciones',
                component: () => import('../pages/IntegracionesPage.vue'),
            },
            {
                path: 'configuracion',
                component: () => import('../pages/ConfiguracionPage.vue'),
            },
        ],
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to) => {
    const auth = useAuthStore()

    if (to.meta.requiereAuth && !auth.sesionActiva) {
        return { name: 'Login' }
    }

    if (to.meta.soloInvitados && auth.sesionActiva) {
        return { name: 'Dashboard' }
    }
})

export default router