<script setup>
import { storeToRefs } from 'pinia'
import { inject, ref } from 'vue'
import { RouterView, useRouter } from 'vue-router'
import axiosInstance from '../services/axios'
import Navbar from '../components/layout/Navbar.vue'
import Sidenav from '../components/layout/Sidenav.vue'
import { useAuthStore } from '../stores/auth'

const appName = inject('appName', 'App')

const router = useRouter()
const authStore = useAuthStore()

const { correoUsuario, nombreUsuario } = storeToRefs(authStore)

const sidebarOpen = ref(false)

async function cerrarSesion() {
    try {
        await axiosInstance.post('/logout')
    } catch {
        //
    }

    authStore.limpiarSesion()

    await router.replace({ name: 'Login' })
}
</script>

<template>
    <div class="min-h-screen bg-transparent">
        <Sidenav :open="sidebarOpen" @close="sidebarOpen = false" />
        <div class="flex min-h-screen flex-col lg:pl-64">
            <Navbar :correo-usuario="correoUsuario" :nombre-usuario="nombreUsuario"
                @toggle-sidebar="sidebarOpen = !sidebarOpen" @cerrar-sesion="cerrarSesion" />
            <main class="flex flex-1 flex-col gap-6 p-6">
                <RouterView />
            </main>
        </div>
    </div>
</template>