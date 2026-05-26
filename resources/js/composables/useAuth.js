import { computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth'

export function useAuth() {
    const authStore = useAuthStore()
    const router    = useRouter()

    const estaAutenticado = computed(() => authStore.sesionActiva)
    const correoUsuario   = computed(() => authStore.correoUsuario)
    const nombreUsuario   = computed(() => authStore.nombreUsuario)

    async function cerrarSesion() {
        await authStore.cerrarSesion()
        router.push('/login')
    }

    return {
        estaAutenticado,
        correoUsuario,
        nombreUsuario,
        cerrarSesion,
    }
}