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
| Autenticación     | Laravel Sanctum          |
| ORM               | Eloquent ORM + Functions |
| Scheduler         | Laravel Scheduler        |
|                   |                          |

---

## 3.3.- Base de Datos

| Componente | Tecnología |
|---|---|
| Motor Base de Datos | PostgreSQL 16 |
| Cache | Redis |
| Logs | PostgreSQL |

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

| Componente | Tecnología |
|---|---|
| Sistema Operativo | Ubuntu Server |
| Contenedores | Docker |
| Proxy / Web Server | Nginx |
| Control de versiones | GitLab |
| CI/CD | GitLab CI/CD |

---

# 3.6.- Arquitectura General del Sistema

```text
                 ┌──────────────┐
                 │     Jira     │
                 └──────┬───────┘
                        │ REST API
                        ▼
        ┌────────────────────────────┐
        │      Laravel Backend       │
        │                            │
        │ - Sync Jira                │
        │ - KPIs                     │
        │ - RBAC                     │
        │ - Business Logic           │
        │ - Reports                  │
        └───────────┬────────────────┘
                    │
                    ▼
             ┌──────────────┐
             │ PostgreSQL   │
             │              │
             │ Issues       │
             │ Sprints      │
             │ Metrics      │
             │ Logs         │
             └──────┬───────┘
                    │
                    ▼
             ┌──────────────┐
             │ Vue + Pinia  │
             │ Frontend UI  │
             └──────────────┘
```

---

# 3.7.- Arquitectura Frontend

```text
src/
 ├── layouts
 ├── pages   X
 ├── components              Z
 ├── stores
 ├── services           Z
 ├── router           Z
 └── composables
```

---

# 3.8.- Arquitectura Backend

```text
app/
 ├── Http  F
 ├── Services
 ├── Repositories
 ├── Jobs
 ├── Models  FFFFFF
 ├── Integrations
 └── Console
```