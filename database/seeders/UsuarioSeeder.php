<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'usuario_nombres' => 'Admin User',
                'usuario_apater' => 'Admin',
                'usuario_amater' => 'Sistema',
                'usuario_email' => 'admin@ln1.com',
                'contraseña' => Hash::make('Admin123!'),
                'contraseña_desencriptada' => 'Admin123!',
                'usuario_codigo' => 'ADM001',
                'id_nivel' => 1,
                'rol' => 'Administrador'
            ],
            [
                'usuario_nombres' => 'Manager User',
                'usuario_apater' => 'Manager',
                'usuario_amater' => 'Proyecto',
                'usuario_email' => 'manager@ln1.com',
                'contraseña' => Hash::make('Manager123!'),
                'contraseña_desencriptada' => 'Manager123!',
                'usuario_codigo' => 'MGR001',
                'id_nivel' => 2,
                'rol' => 'Manager'
            ],
            [
                'usuario_nombres' => 'Scrum Master',
                'usuario_apater' => 'Scrum',
                'usuario_amater' => 'Master',
                'usuario_email' => 'scrum@ln1.com',
                'contraseña' => Hash::make('Scrum123!'),
                'contraseña_desencriptada' => 'Scrum123!',
                'usuario_codigo' => 'SCR001',
                'id_nivel' => 2,
                'rol' => 'Scrum Master'
            ],
            [
                'usuario_nombres' => 'Desarrollador',
                'usuario_apater' => 'Dev',
                'usuario_amater' => 'Equipo',
                'usuario_email' => 'dev@ln1.com',
                'contraseña' => Hash::make('Dev123!'),
                'contraseña_desencriptada' => 'Dev123!',
                'usuario_codigo' => 'DEV001',
                'id_nivel' => 3,
                'rol' => 'Desarrollador'
            ],
            [
                'usuario_nombres' => 'Viewer User',
                'usuario_apater' => 'Viewer',
                'usuario_amater' => 'Sistema',
                'usuario_email' => 'viewer@ln1.com',
                'contraseña' => Hash::make('Viewer123!'),
                'contraseña_desencriptada' => 'Viewer123!',
                'usuario_codigo' => 'VIEW001',
                'id_nivel' => 4,
                'rol' => 'Viewer'
            ],
        ];

        foreach ($usuarios as $data) {
            $rol_nombre = $data['rol'];
            unset($data['rol']);

            $id = DB::connection('mysql')->table('usuarios')->insertGetId([
                'usuario_nombres' => $data['usuario_nombres'],
                'usuario_apater' => $data['usuario_apater'],
                'usuario_amater' => $data['usuario_amater'],
                'usuario_email' => $data['usuario_email'],
                'contraseña' => $data['contraseña'],
                'contraseña_desencriptada' => $data['contraseña_desencriptada'],
                'usuario_codigo' => $data['usuario_codigo'],
                'id_nivel' => $data['id_nivel'],
                'estado' => 1,
                'fec_ingreso' => now(),
                'fec_reg' => now(),
                'user_reg' => 1,
            ]);

            $rol = DB::connection('mysql')->table('rol')
                ->where('nombre', $rol_nombre)
                ->first();

            if ($rol) {
                DB::connection('mysql')->table('usuario_rol')->insert([
                    'id_usuario' => $id,
                    'id_rol' => $rol->id_rol,
                ]);
            }
        }
    }
}
