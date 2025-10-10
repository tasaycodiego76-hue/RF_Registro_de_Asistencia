<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'password'];

    public $timestamps = false;

    // 👇 Relación con asistencias
    public function asistencias()
    {
          return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');
    }
}

