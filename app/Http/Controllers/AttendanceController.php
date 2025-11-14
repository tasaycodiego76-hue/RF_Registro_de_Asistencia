<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string',
        ]);

        $employee_id = $request->input('employee_id');
        $today = now()->toDateString();
        $currentTime = now();

        // Buscar empleado
        $employee = Employee::where('employee_id', $employee_id)->first();

        if (!$employee) {
            return redirect()->back()->with('error', '❌ ID de empleado no existe.');
        }

        // Registros de hoy
        $todayAttendances = Attendance::where('employee_id', $employee_id)
                                      ->where('date', $today)
                                      ->get();

        $hasEntrada = $todayAttendances->where('type','entrada')->first();
        $hasSalida  = $todayAttendances->where('type','salida')->first();

        if (!$hasEntrada) {
            // Registrar entrada
            $status = $currentTime->lessThanOrEqualTo($currentTime->copy()->setTime(9,15,0)) ? 'puntual' : 'tardanza';

            Attendance::create([
                'employee_id' => $employee_id,
                'type' => 'entrada',
                'date' => $today,
                'time' => $currentTime->format('H:i:s'),
                'status' => $status,
            ]);

            return redirect()->back()->with('success', '✅ ENTRADA registrada correctamente.');
        }

        // Si ya tiene entrada, no registrar otra
        if (!$hasSalida) {
            $limitExit = $currentTime->copy()->setTime(18,0,0);
            if ($currentTime->lessThan($limitExit)) {
                return redirect()->back()->with('warning', '⚠️ Solo puedes registrar tu SALIDA después de las 6:00 PM.');
            } else {
                // Registrar salida
                Attendance::create([
                    'employee_id' => $employee_id,
                    'type' => 'salida',
                    'date' => $today,
                    'time' => $currentTime->format('H:i:s'),
                    'status' => null,
                ]);
                return redirect()->back()->with('success', '✅ SALIDA registrada correctamente.');
            }
        }

        // Ya tiene entrada y salida
        return redirect()->back()->with('warning', '⚠️ Ya registraste tu ENTRADA y SALIDA hoy.');
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
