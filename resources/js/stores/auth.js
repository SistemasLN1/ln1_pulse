import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authenticated: false,
        user: null,
    }),
    actions: {
        init() {
            const el = document.getElementById('app')
            this.authenticated = el?.dataset.authenticated === 'true'
            this.user = {
                email: el?.dataset.userEmail ?? null,
            }
        },
        async logout() {
            await window.axios.post('/logout')
            this.authenticated = false
            this.user = null
            window.location.href = '/login'
        }
    }
})