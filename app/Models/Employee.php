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
    protected static function boot()
{
    parent::boot();

    static::creating(function ($employee) {
        $employee->barcode = 'EMP' . str_pad(Employee::count() + 1, 3, '0', STR_PAD_LEFT);
    });
}

}

