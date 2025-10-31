<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee; // <-- Agregado
use Milon\Barcode\DNS1D;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string',
            'password' => 'required|string', // <-- Aseguramos que venga la contraseña
            'type' => 'required|in:entrada,salida',
        ]);

        $employee_id = $request->input('employee_id');
        $password = $request->input('password'); // <-- Obtenemos la contraseña ingresada
        $type = $request->input('type');
        $today = now()->toDateString();
        $currentTime = now();

        // ✅ Verificar si el ID y la contraseña coinciden
        $employee = Employee::where('employee_id', $employee_id)
                            ->where('password', $password)
                            ->first();

        if (!$employee) {
            return redirect()->back()->with('error', '❌ ID o contraseña incorrectos.');
        }

        // Verificar registros de hoy para este empleado
        $todayAttendances = Attendance::where('employee_id', $employee_id)
                                    ->where('date', $today)
                                    ->get();

        // Si intenta registrar ENTRADA
        if ($type === 'entrada') {
            $hasEntrada = $todayAttendances->where('type', 'entrada')->first();
            if ($hasEntrada) {
                return redirect()->back()->with('error', '⚠️ Ya registraste tu ENTRADA hoy a las ' .
                    \Carbon\Carbon::parse($hasEntrada->time)->format('H:i:s') .
                    '. Solo puedes registrar una entrada por día.');
            }
        }

        // Si intenta registrar SALIDA
        if ($type === 'salida') {
            $hasEntrada = $todayAttendances->where('type', 'entrada')->first();
            if (!$hasEntrada) {
                return redirect()->back()->with('error', '⚠️ Debes registrar tu ENTRADA primero.');
            }

            $hasSalida = $todayAttendances->where('type', 'salida')->first();
            if ($hasSalida) {
                return redirect()->back()->with('error', '⚠️ Ya registraste tu SALIDA hoy.');
            }
        }

        // Estado de tardanza solo para entradas
        $status = null;
        if ($type === 'entrada') {
            $limitTime = $currentTime->copy()->setTime(9, 15, 0);
            $status = $currentTime->lessThanOrEqualTo($limitTime) ? 'puntual' : 'tardanza';
        }

        Attendance::create([
            'employee_id' => $employee_id,
            'type' => $type,
            'date' => $today,
            'time' => $currentTime->format('H:i:s'),
            'status' => $status,
        ]);

        return redirect()->back()->with('success', '✅ Asistencia registrada correctamente.');
    }

    public function destroy($id)
    {
        try {
            $attendance = Attendance::findOrFail($id);
            $attendance->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
    public function showBarcode($employee_id)
{
    $employee = Employee::where('employee_id', $employee_id)->firstOrFail();
    return view('employee_barcode', compact('employee'));
}
}
