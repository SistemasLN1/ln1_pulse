<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'legacy';
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'usuario_nombres',
        'usuario_apater',
        'usuario_amater',
        'usuario_email',
        'usuario_codigo',
        'contraseña',
        'contraseña_desencriptada',
        'foto',
        'id_nivel',
        'estado',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    public function username()
    {
        return 'usuario_email';
    }

    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}