import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        sesionActiva: false,
        correoUsuario: '',
    }),

    actions: {
        cargarSesion(el) {
            this.sesionActiva = el.dataset.authenticated === '1';
            this.correoUsuario = el.dataset.userEmail ?? '';
        },

        actualizarSesion(email) {
            this.sesionActiva = true;
            this.correoUsuario = email;
        },

        limpiarSesion() {
            this.sesionActiva = false;
            this.correoUsuario = '';
        },
    },
});