import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  { path: '/', redirect: '/dashboard' },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: () => import('../pages/DashboardPage.vue')
  },
  {
    path: '/proyectos',
    name: 'Proyectos',
    component: () => import('../pages/ProyectosPage.vue')
  },
  {
    path: '/avances',
    name: 'Avances',
    component: () => import('../pages/AvancesPage.vue')
  },
  {
    path: '/kpis',
    name: 'KPIs',
    component: () => import('../pages/KPIsPage.vue')
  },
  {
    path: '/integraciones',
    name: 'Integraciones',
    component: () => import('../pages/IntegracionesPage.vue')
  },
  {
    path: '/configuracion',
    name: 'Configuracion',
    component: () => import('../pages/ConfiguracionPage.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router