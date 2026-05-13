# 1.- Arquitectura de navegación

```text
┌───────────────────────────────────────────────────────────┐
│                        SIDENAV                            │
├───────────────────────────────────────────────────────────┤
│ Dashboard                                                 │
│ Proyectos                                                 │
│ Avances                                                   │
│ KPIs                                                      │
│ Integraciones                                             │
│ Configuración                                             │
└───────────────────────────────────────────────────────────┘
```

---

## 1.1.-Navbar dinámico según el módulo seleccionado

## Dashboard

```text
┌──────────────────── DASHBOARD ────────────────────────────┐
│ Proyecto | Sprint | Resumen | Alertas | Usuarios          │
└───────────────────────────────────────────────────────────┘
```

---

## Proyectos

```text
┌──────────────────── PROYECTOS ────────────────────────────┐
│ Proyecto | Estado | Equipo | Última Sync | Usuarios       │
└───────────────────────────────────────────────────────────┘
```

---

## Avances

```text
┌──────────────────── AVANCES ──────────────────────────────┐
│ Sprint | Issues completados | Pendientes | Progreso %     │
└───────────────────────────────────────────────────────────┘
```

---

## KPIs

```text
┌──────────────────── KPIs ─────────────────────────────────┐
│ Fechas | Proyecto | Velocity | Burndown | Exportar        │
└───────────────────────────────────────────────────────────┘
```

---

## Integraciones

```text
┌──────────────────── INTEGRACIONES ────────────────────────┐
│ Estado Sync | Última Sync | Conectar | Errores            │
└───────────────────────────────────────────────────────────┘
```

---

## Configuración

```text
┌──────────────────── CONFIGURACIÓN ────────────────────────┐
│ Usuarios | Roles | Preferencias | Sistema                 │
└───────────────────────────────────────────────────────────┘
```


# 2.-ROLES

1. Administrador
2. Jefe de Área / Manager
3. Scrum Master / PM
4. Desarrollador
5. Solo Lectura (Viewer)

## 2.1.- Control de acceso (RBAC)

| Permiso / Módulo          | Admin | Manager | Scrum Master | Developer | Viewer |
|---------------------------|:-----:|:-------:|:-------------:|:---------:|:------:|
| Ver Dashboard             |   ✅   |    ✅    |       ✅       |     ✅     |   ✅    |
| Ver KPIs                  |   ✅   |    ✅    |       ✅       |     ❌     |   ✅    |
| Ver Proyectos             |   ✅   |    ✅    |       ✅       |     ✅     |   ✅    |
| Gestionar Proyectos       |   ✅   |    ❌    |       ✅       |     ❌     |   ❌    |
| Ver Issues                |   ✅   |    ✅    |       ✅       |     ✅     |   ✅    |
| Editar Issues             |   ✅   |    ❌    |       ✅       |     ✅     |   ❌    |
| Gestionar Sprints         |   ✅   |    ❌    |       ✅       |     ❌     |   ❌    |
| Ver Avances               |   ✅   |    ✅    |       ✅       |     ✅     |   ✅    |
| Ver Integraciones         |   ✅   |    ✅    |       ❌       |     ❌     |   ❌    |
| Configurar Integraciones  |   ✅   |    ❌    |       ❌       |     ❌     |   ❌    |
| Ver Logs                  |   ✅   |    ✅    |       ❌       |     ❌     |   ❌    |
| Gestionar Usuarios        |   ✅   |    ❌    |       ❌       |     ❌     |   ❌    |
| Configuración del Sistema |   ✅   |    ❌    |       ❌       |     ❌     |   ❌    |
| Exportar Reportes         |   ✅   |    ✅    |       ✅       |     ❌     |   ❌    |


