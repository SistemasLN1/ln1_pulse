<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

defineProps({
    open: {
        type: Boolean,
        default: false,
    },
})

defineEmits(['close'])

const route = useRoute()

const menu = [
    { nombre: 'Dashboard',     ruta: '/dashboard' },
    { nombre: 'Proyectos',     ruta: '/dashboard/proyectos' },
    { nombre: 'Avances',       ruta: '/dashboard/avances' },
    { nombre: 'KPIs',          ruta: '/dashboard/kpis' },
    { nombre: 'Integraciones', ruta: '/dashboard/integraciones' },
    { nombre: 'Configuración', ruta: '/dashboard/configuracion' },
]

function estaActivo(ruta) {
    if (ruta === '/dashboard') {
        return route.path === '/dashboard'
    }
    return route.path.startsWith(ruta)
}
</script>

<template>
    <!-- Mobile overlay -->
    <div
        v-if="open"
        class="fixed inset-0 z-20 bg-black/30 lg:hidden"
        @click="$emit('close')"
    />

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-56 bg-white border-r border-gray-100
               flex flex-col transform transition-transform duration-200
               lg:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full'"
    >
        <!-- Logo -->
        <div class="px-6 py-5 border-b border-gray-100">
            <span class="text-base font-semibold text-gray-900">LN1 Pulse</span>
        </div>

        <!-- Navegación -->
        <nav class="flex-1 px-3 py-4 space-y-0.5">
            <router-link
                v-for="item in menu"
                :key="item.ruta"
                :to="item.ruta"
                class="flex items-center px-3 py-2 rounded-lg text-sm transition-colors"
                :class="estaActivo(item.ruta)
                    ? 'bg-blue-50 text-blue-600 font-medium'
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'"
                @click="$emit('close')"
            >
                {{ item.nombre }}
            </router-link>
        </nav>
    </aside>
</template>