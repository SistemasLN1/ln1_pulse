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
        'contraseña_desencriptada',
        'foto',
        'id_nivel',
        'estado',
        'fec_ingreso',
        'fec_termino',
        'fec_reg',
        'user_reg',
        'fec_act',
        'useract',
        'fec_eli',
        'user_eli',
    ];

    protected $hidden = [
        'contraseña',
        'contraseña_desencriptada',
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

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
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

    public function hasRole($role): bool
    {
        return $this->roles()->where('nombre', $role)->exists();
    }

    public function permisos()
    {
        return $this->roles()
            ->with('permisos')
            ->get()
            ->pluck('permisos')
            ->flatten()
            ->unique('id_permiso');
    }
}
