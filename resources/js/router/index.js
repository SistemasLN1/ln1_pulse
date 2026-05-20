import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    { path: '/', redirect: '/dashboard' },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../pages/LoginPage.vue')
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: () => import('../pages/DashboardPage.vue')
    },
    {
        path: '/dashboard/proyectos',
        name: 'Proyectos',
        component: () => import('../pages/ProyectosPage.vue')
    },
    {
        path: '/dashboard/avances',
        name: 'Avances',
        component: () => import('../pages/AvancesPage.vue')
    },
    {
        path: '/dashboard/kpis',
        name: 'KPIs',
        component: () => import('../pages/KPIsPage.vue')
    },
    {
        path: '/dashboard/integraciones',
        name: 'Integraciones',
        component: () => import('../pages/IntegracionesPage.vue')
    },
    {
        path: '/dashboard/configuracion',
        name: 'Configuracion',
        component: () => import('../pages/ConfiguracionPage.vue')
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router