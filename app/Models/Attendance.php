<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'type', 'date', 'time'];

    public $timestamps = true;

    // 👇 Relación con empleados
public function empleado()
{
    return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
}

}
