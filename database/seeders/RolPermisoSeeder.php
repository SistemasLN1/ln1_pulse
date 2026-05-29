<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolPermisoSeeder extends Seeder
{
    public function run(): void
    {
        // Roles según el MD
        $roles = [
            ['nombre' => 'Administrador',       'descripcion' => 'Acceso total al sistema'],
            ['nombre' => 'Manager',              'descripcion' => 'Jefe de área, acceso a reportes y proyectos'],
            ['nombre' => 'Scrum Master',         'descripcion' => 'Gestión de sprints y proyectos'],
            ['nombre' => 'Desarrollador',        'descripcion' => 'Acceso a issues y avances'],
            ['nombre' => 'Viewer',               'descripcion' => 'Solo lectura'],
        ];

        DB::connection('mysql')->table('rol')->insert($roles);

        // Permisos según tabla RBAC del MD
        $permisos = [
            ['nombre' => 'ver_dashboard',           'modulo' => 'Dashboard'],
            ['nombre' => 'ver_kpis',                'modulo' => 'KPIs'],
            ['nombre' => 'ver_proyectos',           'modulo' => 'Proyectos'],
            ['nombre' => 'gestionar_proyectos',     'modulo' => 'Proyectos'],
            ['nombre' => 'ver_issues',              'modulo' => 'Avances'],
            ['nombre' => 'editar_issues',           'modulo' => 'Avances'],
            ['nombre' => 'gestionar_sprints',       'modulo' => 'Avances'],
            ['nombre' => 'ver_avances',             'modulo' => 'Avances'],
            ['nombre' => 'ver_integraciones',       'modulo' => 'Integraciones'],
            ['nombre' => 'configurar_integraciones','modulo' => 'Integraciones'],
            ['nombre' => 'ver_logs',                'modulo' => 'Integraciones'],
            ['nombre' => 'gestionar_usuarios',      'modulo' => 'Configuracion'],
            ['nombre' => 'exportar_reportes',       'modulo' => 'KPIs'],
        ];

        DB::connection('mysql')->table('permiso')->insert($permisos);

        // Relación roles-permisos según tabla RBAC del MD
        // Admin = todos los permisos
        $todosLosPermisos = DB::connection('mysql')->table('permiso')->pluck('id_permiso')->toArray();
        $admin = DB::connection('mysql')->table('rol')->where('nombre', 'Administrador')->value('id_rol');
        foreach ($todosLosPermisos as $idPermiso) {
            DB::connection('mysql')->table('rol_permiso')->insert([
                'id_rol'     => $admin,
                'id_permiso' => $idPermiso,
            ]);
        }

        // Manager
        $manager = DB::connection('mysql')->table('rol')->where('nombre', 'Manager')->value('id_rol');
        $permisosManager = ['ver_dashboard','ver_kpis','ver_proyectos','ver_issues',
                            'ver_avances','ver_integraciones','ver_logs','exportar_reportes'];
        foreach ($permisosManager as $nombre) {
            $id = DB::connection('mysql')->table('permiso')->where('nombre', $nombre)->value('id_permiso');
            DB::connection('mysql')->table('rol_permiso')->insert(['id_rol' => $manager, 'id_permiso' => $id]);
        }

        // Scrum Master
        $sm = DB::connection('mysql')->table('rol')->where('nombre', 'Scrum Master')->value('id_rol');
        $permisosSM = ['ver_dashboard','ver_kpis','ver_proyectos','gestionar_proyectos',
                       'ver_issues','editar_issues','gestionar_sprints','ver_avances','exportar_reportes'];
        foreach ($permisosSM as $nombre) {
            $id = DB::connection('mysql')->table('permiso')->where('nombre', $nombre)->value('id_permiso');
            DB::connection('mysql')->table('rol_permiso')->insert(['id_rol' => $sm, 'id_permiso' => $id]);
        }

        // Desarrollador
        $dev = DB::connection('mysql')->table('rol')->where('nombre', 'Desarrollador')->value('id_rol');
        $permisosDev = ['ver_dashboard','ver_proyectos','ver_issues','editar_issues','ver_avances'];
        foreach ($permisosDev as $nombre) {
            $id = DB::connection('mysql')->table('permiso')->where('nombre', $nombre)->value('id_permiso');
            DB::connection('mysql')->table('rol_permiso')->insert(['id_rol' => $dev, 'id_permiso' => $id]);
        }

        // Viewer
        $viewer = DB::connection('mysql')->table('rol')->where('nombre', 'Viewer')->value('id_rol');
        $permisosViewer = ['ver_dashboard','ver_kpis','ver_proyectos','ver_issues','ver_avances'];
        foreach ($permisosViewer as $nombre) {
            $id = DB::connection('mysql')->table('permiso')->where('nombre', $nombre)->value('id_permiso');
            DB::connection('mysql')->table('rol_permiso')->insert(['id_rol' => $viewer, 'id_permiso' => $id]);
        }
    }
}