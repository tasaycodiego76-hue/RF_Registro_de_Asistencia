<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string',
            'type' => 'required|in:entrada,salida',
        ]);

        $employee_id = $request->input('employee_id');
        $type = $request->input('type');
        $today = now()->toDateString();
        $currentTime = now(); // ← Solo agregué esta línea

        // Verificar registros de hoy para este empleado
        $todayAttendances = Attendance::where('employee_id', $employee_id)
                                    ->where('date', $today)
                                    ->get();

        // Si intenta registrar ENTRADA
        if ($type === 'entrada') {
            // Verificar si ya tiene entrada hoy
            $hasEntrada = $todayAttendances->where('type', 'entrada')->first();
            
            if ($hasEntrada) {
                return redirect()->back()->with('error', '⚠️ Ya registraste tu ENTRADA hoy a las ' . 
                    \Carbon\Carbon::parse($hasEntrada->time)->format('H:i:s') . 
                    '. Solo puedes registrar una entrada por día.');
            }
        }

        // Si intenta registrar SALIDA
        if ($type === 'salida') {
            // Verificar si tiene entrada hoy
            $hasEntrada = $todayAttendances->where('type', 'entrada')->first();
            
            if (!$hasEntrada) {
                return redirect()->back()->with('error', '⚠️ Debes registrar tu ENTRADA primero antes de poder registrar la salida.');
            }

            // Verificar si ya tiene salida hoy
            $hasSalida = $todayAttendances->where('type', 'salida')->first();
            
            if ($hasSalida) {
                return redirect()->back()->with('error', '⚠️ Ya registraste tu SALIDA hoy a las ' . 
                    \Carbon\Carbon::parse($hasSalida->time)->format('H:i:s') . 
                    '. Solo puedes registrar una salida por día.');
            }
        }

        // ↓ NUEVA LÓGICA DE TARDANZA (solo para entradas) ↓
        $status = null;
        if ($type === 'entrada') {
            // Hora límite: 9:15 AM
            $limitTime = $currentTime->copy()->setTime(9, 15, 0);
            $status = $currentTime->lessThanOrEqualTo($limitTime) ? 'puntual' : 'tardanza';
        }
        // ↑ HASTA AQUÍ ↑

        // Si pasa todas las validaciones, crear el registro
 // Si pasa todas las validaciones, crear el registro
        $attendance = Attendance::create([
            'employee_id' => $employee_id,
            'type' => $type,
            'date' => $today,
            'time' => $currentTime->format('H:i:s'),
            'status' => $status,
        ]);

        // ↓ MENSAJE ÚNICO SILENCIOSO ↓
        return redirect()->back()->with('success', '✅ Asistencia registrada correctamente.');
    }

    public function destroy($id)
    {
        try {
            $attendance = Attendance::findOrFail($id);
            $attendance->delete();
            
            return redirect()->back()->with('success', '🗑️ Registro eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error al eliminar el registro.');
        }
    }
}