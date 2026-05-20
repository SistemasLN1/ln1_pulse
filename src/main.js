import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './router'
import './style.css'
import App from './App.vue'

const app = createApp(App)

app.use(createPinia())  // Estado global
app.use(router)         // Navegación
app.mount('#app')       // Monta la app en el HTML