<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

            <div class="mb-8 text-center">
                <h1 class="text-2xl font-semibold text-gray-900">LN1 Pulse</h1>
                <p class="text-sm text-gray-500 mt-1">Ingresá con tu cuenta corporativa</p>
            </div>

            <form @submit.prevent="iniciarSesion" novalidate>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Correo electrónico
                    </label>
                    <input id="email" v-model="form.email" type="email" autocomplete="email"
                        placeholder="tucorreo@ejemplo.com" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-500
                               focus:border-transparent disabled:opacity-50" :disabled="cargando" />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Contraseña
                    </label>
                    <input id="password" v-model="form.password" type="password" autocomplete="current-password"
                        placeholder="••••••••" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                               focus:outline-none focus:ring-2 focus:ring-blue-500
                               focus:border-transparent disabled:opacity-50" :disabled="cargando" />
                </div>

                <AlertaBanner :mensaje="error" />

                <button type="submit" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-medium
                           text-sm rounded-lg py-2.5 transition-colors
                           disabled:opacity-60 disabled:cursor-not-allowed" :disabled="cargando">
                    <span v-if="cargando">Ingresando...</span>
                    <span v-else>Ingresar</span>
                </button>

            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import axiosInstance from '../services/axios'
import AlertaBanner from '../components/AlertaBanner.vue'

const router = useRouter()
const authStore = useAuthStore()

const form = ref({
    email: '',
    password: '',
})

const cargando = ref(false)
const error = ref('')

async function iniciarSesion() {
    error.value = ''
    cargando.value = true

    try {
        const { data } = await axiosInstance.post('/login', {
            email: form.value.email,
            password: form.value.password,
        })

        authStore.actualizarSesion(data.usuario.nombre, data.usuario.correo)
        router.push('/dashboard')

    } catch (err) {
        error.value = err.response?.data?.mensaje ?? 'Error al conectar con el servidor.'
    } finally {
        cargando.value = false
    }
}
</script>