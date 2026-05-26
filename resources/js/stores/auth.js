import { defineStore } from 'pinia'
import axiosInstance from '../services/axios'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        sesionActiva:  false,
        correoUsuario: '',
        nombreUsuario: '',
    }),

    actions: {
        cargarSesion(el) {
            this.sesionActiva  = el.dataset.authenticated === '1'
            this.correoUsuario = el.dataset.userEmail     ?? ''
            this.nombreUsuario = el.dataset.userName      ?? ''
        },

        actualizarSesion(nombre, correo) {
            this.sesionActiva  = true
            this.correoUsuario = correo
            this.nombreUsuario = nombre
        },

        limpiarSesion() {
            this.sesionActiva  = false
            this.correoUsuario = ''
            this.nombreUsuario = ''
        },

        async cerrarSesion() {
            try {
                await axiosInstance.post('/logout')
            } catch {
                //
            }
            this.limpiarSesion()
        },
    },
})