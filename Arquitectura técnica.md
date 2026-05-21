# 1.- Arquitectura Técnica

## 1.1.- Frontend


| Componente         | Tecnología   |
| ------------------ | ------------ |
| Framework Frontend | Vue 3        |
| State Management   | Pinia        |
| Router             | Vue Router   |
| HTTP Client        | Axios        |
| Build Tool         | Vite         |
| UI Framework       | Tailwind CSS |
|                    |              |


---

## 1.2.- Backend


| Componente        | Tecnología               |
| ----------------- | ------------------------ |
| Framework Backend | Laravel 12               |
| Lenguaje          | PHP 8.3                  |
| Arquitectura API  | REST API                 |
| Autenticación     | Sesión web + Sanctum (usuarios en MySQL) |
| Conexiones BD     | MySQL (`legacy`) + PostgreSQL (`pgsql`)  |
| ORM               | Eloquent ORM + Functions                 |
| Scheduler         | Laravel Scheduler        |
|                   |                          |


---

## 3.3.- Base de Datos


| Componente            | Tecnología    | Responsabilidad                                       |
| --------------------- | ------------- | ----------------------------------------------------- |
| Identidad / seguridad | MySQL         | `users`, roles, permisos, departamentos, puestos      |
| Dominio Pulse         | PostgreSQL 16 | Issues, sprints, métricas, logs de sync, preferencias |
| Cache / sesiones      | Redis         | Sesiones web y cache de aplicación                    |
| Logs operativos Pulse | PostgreSQL    | Auditoría del dominio Pulse                           |

> Las tablas de identidad en MySQL **no se migran** a PostgreSQL. Pulse referencia usuarios por `user_id` (= `users.id` en MySQL), sin foreign keys entre motores.


---

## 3.4.- Integraciones


| Servicio          | Tipo                     |
| ----------------- | ------------------------ |
| Jira REST API     | Integración principal    |
| Webhooks Jira     | Eventos y sincronización |
| GitHub API        | Integración futura       |
| APIs internas LN1 | Integración futura       |


---

## 3.5.- Infraestructura Producción


| Componente           | Tecnología    |
| -------------------- | ------------- |
| Sistema Operativo    | Ubuntu Server |
| Contenedores         | Docker        |
| Proxy / Web Server   | Nginx         |
| Control de versiones | GitLab        |
| CI/CD                | GitLab CI/CD  |


---

# 3.6.- Arquitectura General del Sistema

```text
                      ┌──────────────┐
                      │     Jira     │
                      └──────┬───────┘
                             │ REST API / Webhooks
                             ▼
┌────────────────────────────────────────────────────────────────┐
│                     Laravel Backend                             │
│  Login · RBAC · Policies │ Sync Jira · KPIs · Reports          │
└───────┬────────────────────────────┬───────────────────┬────────┘
        │                            │                   │
        │ AUTH / SEGURIDAD           │ DOMINIO PULSE     │ SESIÓN
        ▼                            ▼                   ▼
 ┌─────────────────┐         ┌─────────────────┐   ┌─────────┐
 │     MySQL       │         │   PostgreSQL    │   │  Redis  │
 │   (legacy)      │         │     (pulse)     │   │         │
 ├─────────────────┤         ├─────────────────┤   ├─────────┤
 │ users           │         │ issues          │   │ sesión  │
 │ roles           │         │ sprints         │   │ cache   │
 │ permisos        │         │ metrics         │   └─────────┘
 │ departamentos   │         │ sync_logs       │
 │ puestos         │         │                 │
 │                 │         │ assignee_id,    │
 │ Fuente única de │         │ created_by, …   │
 │ identidad       │         │      │          │
 │ (NO migrate     │         │      │ user_id  │
 │  desde Pulse)   │◄────────┼──────┘ = users.id
 └────────┬────────┘  ref.   └─────────────────┘  (sin FK cruzada)
          │ lógica
          │ HTTP autenticado
          ▼
   ┌──────────────┐
   │ Vue + Pinia  │
   │ Frontend UI  │
   └──────────────┘
```

**Lectura del diagrama**

| Rama desde Laravel | Motor        | Para qué se usa                                      |
| ---------------- | ------------ | ---------------------------------------------------- |
| Izquierda        | **MySQL**    | Login, contraseñas, roles, permisos, organigrama     |
| Centro           | **PostgreSQL** | Issues, sprints, KPIs, métricas, logs de sync    |
| Derecha          | **Redis**    | Persistencia de sesión y cache                       |
| Flecha PG → MySQL | —           | Solo `user_id`; no hay JOIN ni FK entre bases      |

---

# 3.7.- Arquitectura por capas

| Capa            | Tecnología / ubicación              | Responsabilidad                                      |
| --------------- | ----------------------------------- | ---------------------------------------------------- |
| Presentación    | Vue 3, Pinia, Axios                 | UI, estado de vista, llamadas al backend             |
| Aplicación      | Laravel (`Http`, `Services`, `Jobs`) | Auth (MySQL), sync Jira, KPIs, `UserDirectory`      |
| Dominio         | Eloquent por conexión               | `legacy` → identidad; `pgsql` → datos Pulse          |
| Datos identidad | **MySQL**                           | `users` y tablas relacionadas (compartidas empresa)  |
| Datos Pulse     | **PostgreSQL**                      | Tablas operativas; migraciones solo aquí             |
| Infra transversal | **Redis**                         | Sesiones y cache                                     |

---

# 3.8.- Arquitectura Frontend

```text
src/
 ├── layouts
 ├── pages   
 ├── components              
 ├── stores
 ├── services           
 ├── router           
 └── composables
```

---

# 3.9.- Arquitectura Backend

```text
app/
 ├── Http
 │    ├── Controllers
 │    └── Middleware       # auth + RBAC → consulta MySQL
 ├── Services
 │    └── UserDirectory    # user_id (PG) → datos en MySQL
 ├── Repositories
 ├── Jobs
 ├── Models
 │    ├── User, Role, …    # conexión legacy (MySQL)
 │    └── Issue, Sprint, … # conexión pgsql (PostgreSQL)
 ├── Policies
 ├── Integrations
 └── Console
```

| Conexión Eloquent | Motor      | Uso                                              |
| ----------------- | ---------- | ------------------------------------------------ |
| `legacy`          | MySQL      | Autenticación, roles, permisos, organigrama      |
| `pgsql` (default) | PostgreSQL | Dominio Pulse (issues, sprints, métricas, logs)  |

