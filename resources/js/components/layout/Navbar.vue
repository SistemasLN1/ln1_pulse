<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

defineProps({
    correoUsuario: {
        type: String,
        default: '',
    },
    nombreUsuario: {
        type: String,
        default: '',
    },
})

defineEmits(['toggle-sidebar', 'cerrar-sesion'])

const route = useRoute()

const tabsPorModulo = {
    '/dashboard': ['Proyecto', 'Sprint', 'Resumen', 'Alertas', 'Usuarios'],
    '/dashboard/proyectos': ['Proyecto', 'Estado', 'Equipo', 'Última Sync', 'Usuarios'],
    '/dashboard/avances': ['Sprint', 'Issues completados', 'Pendientes', 'Progreso %'],
    '/dashboard/kpis': ['Fechas', 'Proyecto', 'Velocity', 'Burndown', 'Exportar'],
    '/dashboard/integraciones': ['Estado Sync', 'Última Sync', 'Conectar', 'Errores'],
    '/dashboard/configuracion': ['Usuarios', 'Roles', 'Preferencias', 'Sistema'],
}

const tabs = computed(() => tabsPorModulo[route.path] ?? [])

const nombreModulo = computed(() => {
    const modulos = {
        '/dashboard': 'Dashboard',
        '/dashboard/proyectos': 'Proyectos',
        '/dashboard/avances': 'Avances',
        '/dashboard/kpis': 'KPIs',
        '/dashboard/integraciones': 'Integraciones',
        '/dashboard/configuracion': 'Configuración',
    }
    return modulos[route.path] ?? ''
})
</script>

<template>
    <header class="sticky top-0 z-10 bg-white border-b border-gray-100">
        <div class="flex items-center justify-between px-6 py-3">

            <!-- Izquierda: botón mobile + módulo activo + tabs -->
            <div class="flex items-center gap-4">

                <!-- Botón hamburguesa mobile -->
                <button class="lg:hidden text-gray-500 hover:text-gray-900" @click="$emit('toggle-sidebar')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Nombre del módulo -->
                <span class="text-sm font-medium text-gray-900">{{ nombreModulo }}</span>

                <!-- Tabs dinámicos -->
                <div class="hidden md:flex items-center gap-1">
                    <span v-for="tab in tabs" :key="tab" class="px-3 py-1 text-xs text-gray-500 border border-gray-200
                               rounded-full bg-gray-50">
                        {{ tab }}
                    </span>
                </div>
            </div>

            <!-- Derecha: usuario + logout -->
            <div class="flex items-center gap-4">
                <span class="hidden md:block text-sm text-gray-500">
                    {{ nombreUsuario || correoUsuario }}
                </span>

                <button class="text-sm text-gray-500 hover:text-gray-900 transition-colors"
                    @click="$emit('cerrar-sesion')">
                    Salir
                </button>
            </div>

        </div>
    </header>
</template>