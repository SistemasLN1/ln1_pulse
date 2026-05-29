<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $connection = 'mysql';
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'usuario_nombres',
        'usuario_apater',
        'usuario_amater',
        'usuario_email',
        'usuario_codigo',
        'contraseña',
        'foto',
        'id_nivel',
        'estado',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    public function getAuthIdentifierName(): string
    {
        return 'id_usuario';
    }

    public function getAuthPasswordName(): string
    {
        return 'contraseña';
    }

    public function roles()
    {
        return $this->belongsToMany(
            Rol::class,
            'usuario_rol',
            'id_usuario',
            'id_rol'
        );
    }
}