## Revisión del commit `config inicial` (`8ff5994`)

Hola. Revisé este commit de configuración inicial. El stack elegido (Laravel 12 + Vue 3 + Sanctum + Pinia) es razonable para **LN1 Pulse**, pero la integración entre capas aún no está cerrada. A continuación, **8 puntos prioritarios** a corregir antes de avanzar con funcionalidad de negocio.

---

### 1. Seguridad e higiene del repositorio

- Se versiona **`.env` con `APP_KEY` real**.
- Se incluye todo el directorio **`vendor/`** en el commit (~8 500 archivos).
- El **`.gitignore` es solo de plantilla Vue** y no excluye `.env`, `vendor/`, `storage/logs`, etc.

**Sugerencia:** quitar `.env` y `vendor/` del historial (o revertir su inclusión), adoptar el `.gitignore` estándar de Laravel y documentar variables solo en `.env.example`.

---

### 2. La aplicación se sirve desde Vite (`:5173`), no desde Laravel (`:8000`)

- El flujo de desarrollo apunta a `npm run dev` → **puerto 5173**.
- Laravel en **`:8000`** solo entrega `welcome.blade.php`, no la SPA.
- Existe un **`index.html` en la raíz** como entrada independiente de Vite.

**Sugerencia:** la URL canónica debe ser Laravel (`APP_URL`, p. ej. `http://localhost:8000`). Vite debe actuar únicamente como bundler vía `@vite`, no como servidor de la aplicación.

---

### 3. Falta `resources/views/spa.blade.php` como núcleo de la SPA

No hay una vista Blade única que:

- Monte Vue en `#app`.
- Exponga `<meta name="csrf-token" content="{{ csrf_token() }}">`.
- Inyecte estado inicial vía `data-*` (`data-authenticated`, `data-user-email`, etc.).
- Cargue assets con `@vite(['resources/css/app.css', 'resources/js/app.js'])`.

**Sugerencia:** crear `spa.blade.php` como shell único de la aplicación frontend.

---

### 4. `routes/web.php` sin middleware ni rutas SPA

Actualmente solo existe:

```php
Route::get('/', function () {
    return view('welcome');
});
```

Faltan:

- Redirección `/` → `/dashboard` o `/login` según sesión.
- Grupo **`guest`**: `GET/POST /login`.
- Grupo **`auth`**: `GET /dashboard`, catch-all `/dashboard/{any}`, `POST /logout`.
- Todas las rutas protegidas deben devolver `view('spa')`.

**Sugerencia:** alinear el enrutamiento web con autenticación por sesión de Laravel antes de confiar solo en Vue Router.

---

### 5. Frontend y backend desacoplados (sin integración Laravel + Vite)

- Vue vive en **`src/`** en la raíz; Laravel espera el frontend en **`resources/js`**.
- No hay **`laravel-vite-plugin`** ni configuración de Vite acoplada a Laravel.
- Conviven dos plantillas: `welcome.blade.php` (Laravel) y componentes demo de Vite (`HelloWorld.vue`).

**Sugerencia:** unificar en un solo pipeline: assets en `resources/`, plugin de Laravel para Vite, eliminar `index.html` suelto en raíz.

---

### 6. Pinia instalado sin arquitectura de estado ni inyección de dependencias

- Pinia se registra en `main.js`, pero **no hay stores** (`auth`, `app`, etc.).
- No se consume el bootstrap que debería venir de Blade (`data-authenticated`, etc.).
- `axios` está configurado en `src/services/axios.js` pero **no se usa** en componentes ni se expone vía `provide`/store.

**Sugerencia:** store de autenticación (estado desde Blade) + servicio API inyectado para comunicar Vue con controladores Laravel.

---

### 7. API / Sanctum preparados en el cliente, inexistentes en el servidor

- `axios` apunta a `http://localhost:8000/api` con `withCredentials: true`.
- **No existe `routes/api.php`** ni controladores de API.
- `bootstrap/app.php` no registra rutas API.
- Sanctum está instalado sin flujo SPA completo (middleware stateful, CORS, endpoints).

**Sugerencia:** crear la API solo cuando existan endpoints reales; hasta entonces, priorizar rutas web + sesión para login/dashboard.

---

### 8. Configuración de dominio declarada pero no implementada

- Variables **`JIRA_*`** y **`PG_DB_*`** en `.env` sin uso en `config/services.php` ni `config/database.php`.
- Páginas Vue (`Dashboard`, `Proyectos`, `KPIs`, etc.) son **stubs** (solo un `<h1>`).
- Rutas Vue (`/proyectos`, `/kpis`) no coinciden con el esquema Laravel recomendado (`/dashboard/...`).
- README y nombres del paquete siguen siendo genéricos (`proyectojiraln1`).

**Sugerencia:** cablear config de Jira/DB cuando existan servicios; alinear rutas Vue bajo `/dashboard/*`; implementar dominio de negocio de forma incremental.

---

### Orden recomendado de corrección

1. Repo: `.gitignore`, eliminar `.env` y `vendor/` del control de versiones.
2. `spa.blade.php` + `web.php` con middlewares `guest`/`auth`.
3. Servir la app desde Laravel `:8000` con `@vite`.
4. Migrar Vue a `resources/js` + Pinia (auth + API).
5. Alinear rutas Vue con `/dashboard/*` y `/login`.
6. API/Sanctum cuando haya endpoints concretos.
7. Integración Jira y conexiones de BD en `config/`.
8. Implementar lógica en páginas y controladores.

---

Gracias por el avance en la base del proyecto. Con estos ajustes la arquitectura quedará lista para desarrollar KPIs, integraciones Jira y el resto del dominio sin deuda estructural.
