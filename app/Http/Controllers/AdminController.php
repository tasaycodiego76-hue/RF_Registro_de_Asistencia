<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    // 🔹 Validar login de administrador
    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = $request->input('user');
        $pass = $request->input('password');

        // ✅ Credenciales temporales: admin / admin123
        if ($user === 'admin' && $pass === 'admin123') {
            return redirect()->route('admin.panel');
        }

        return redirect()->back()->with('admin_error', 'Credenciales administrativas incorrectas');
    }

    // 🔹 Mostrar el panel administrativo CON FILTRO

public function panel(Request $request)
{
    $query = \App\Models\Attendance::with('empleado');
    
    if ($request->filled('date_filter')) {
        $query->where('date', $request->date_filter);
    }

    $attendances = $query->orderBy('created_at', 'desc')->get();

    // 🔹 Contar empleados con más de 3 tardanzas en la quincena actual
    $fechaActual = Carbon::now();
    if ($fechaActual->day <= 15) {
        $inicio = $fechaActual->copy()->startOfMonth();
        $fin = $fechaActual->copy()->startOfMonth()->addDays(14);
    } else {
        $inicio = $fechaActual->copy()->startOfMonth()->addDays(15);
        $fin = $fechaActual->copy()->endOfMonth();
    }

    $empleados = \App\Models\Employee::with('asistencias')->get();
    $totalTardanzasAltas = 0;

    foreach ($empleados as $emp) {
        $tardanzas = $emp->asistencias()
                          ->where('status', 'tardanza')
                          ->whereBetween('date', [$inicio, $fin])
                          ->count();
        if ($tardanzas > 3) {
            $totalTardanzasAltas++;
        }
    }

    return view('admin', compact('attendances', 'totalTardanzasAltas'));
}

public function show($id)
{
    $asistencia = Attendance::with('empleado')->findOrFail($id);
    $empleadoId = $asistencia->employee_id;

    // Fecha actual
    $fechaActual = Carbon::now();

    // Determinar rango quincenal
    if ($fechaActual->day <= 15) {
        $inicio = $fechaActual->copy()->startOfMonth();
        $fin = $fechaActual->copy()->startOfMonth()->addDays(14);
    } else {
        $inicio = $fechaActual->copy()->startOfMonth()->addDays(15);
        $fin = $fechaActual->copy()->endOfMonth();
    }

    // Obtener solo las tardanzas del empleado en la quincena
    $tardanzas = Attendance::where('employee_id', $empleadoId)
        ->where('status', 'tardanza')
        ->whereBetween('date', [$inicio, $fin])
        ->orderBy('date', 'asc')
        ->get();

    // Contar tardanzas
    $totalTardanzas = $tardanzas->count();

    // Mensaje según cantidad
    $mensaje = $totalTardanzas > 3
        ? "⚠️ El empleado tiene más de 3 tardanzas en esta quincena."
        : "✅ El empleado tiene {$totalTardanzas} tardanza(s) en esta quincena.";

    return view('admin_detalle', compact('asistencia', 'tardanzas', 'mensaje', 'totalTardanzas'));
}


public function exportExcel()
{
    return AttendanceExport::export();
}

public function quincenal(Request $request)
{
    // Fecha por defecto
    $fechaActual = Carbon::now();
    $quincenaActual = $fechaActual->day <= 15 ? "1ª Quincena" : "2ª Quincena";

    // Valores iniciales de inicio y fin
    if ($fechaActual->day <= 15) {
        $inicio = $fechaActual->copy()->startOfMonth();
        $fin = $fechaActual->copy()->startOfMonth()->addDays(14);
    } else {
        $inicio = $fechaActual->copy()->startOfMonth()->addDays(15);
        $fin = $fechaActual->copy()->endOfMonth();
    }

    // Filtrado desde formulario
    $mesSeleccionado = $request->input('mes', null);
    $quincenaSeleccionada = $request->input('quincena', null);

    if ($mesSeleccionado && $quincenaSeleccionada) {
        $fecha = Carbon::parse($mesSeleccionado . '-01');

        if ($quincenaSeleccionada == 1) {
            $inicio = $fecha->copy()->startOfMonth();
            $fin = $fecha->copy()->startOfMonth()->addDays(14);
        } else {
            $inicio = $fecha->copy()->startOfMonth()->addDays(15);
            $fin = $fecha->copy()->endOfMonth();
        }

        $quincenaActual = $quincenaSeleccionada == 1 ? "1ª Quincena" : "2ª Quincena";
        $fechaActual = $fecha;
    }

    // Variables de inicio y fin para la vista
    $inicioActual = $inicio->format('Y-m-d');
    $finActual = $fin->format('Y-m-d');

    // Obtener empleados y calcular tardanzas
    $empleados = \App\Models\Employee::all();

    $empleadosData = $empleados->map(function($emp) use ($inicio, $fin) {
        $tardanzas = $emp->asistencias()
            ->whereBetween('date', [$inicio, $fin])
            ->where('status', 'tardanza')
            ->count();

        return [
            'id' => $emp->employee_id,
            'name' => $emp->name,
            'tardanzas' => $tardanzas,
        ];
    });

    // Contar empleados con más de 3 tardanzas
    $totalTardanzasAltas = $empleadosData->filter(fn($e) => $e['tardanzas'] > 3)->count();

    return view('admin_quincenal', compact(
        'empleadosData',
        'totalTardanzasAltas',
        'quincenaActual',
        'fechaActual',
        'inicioActual',
        'finActual'
    ));
}



}