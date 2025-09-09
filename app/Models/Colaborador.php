<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = 'colaboradores';

    protected $fillable = [
        'codigo',
        'nombre',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Si asignas password en claro (p.ej. en seeder) se guardará encriptado automáticamente:
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
