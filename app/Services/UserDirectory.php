<?php

namespace App\Services;

use App\Models\User;

class UserDirectory
{
    public function resolverPorId(int $userId): ?User
    {
        return User::find($userId);
    }

    public function datosBasicos(int $userId): array
    {
        $user = $this->resolverPorId($userId);

        if (! $user) {
            return ['nombre' => 'Desconocido', 'correo' => ''];
        }

        return [
            'nombre' => $user->usuario_nombres,
            'correo' => $user->usuario_email,
        ];
    }
}