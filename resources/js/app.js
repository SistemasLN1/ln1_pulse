import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import { useAuthStore } from './stores/auth';

const el = document.getElementById('app');

if (el) {
    const pinia = createPinia();

    const app = createApp(App);

    app.use(pinia);
    app.use(router);

    useAuthStore(pinia).cargarSesion(el);

    app.mount(el);
}