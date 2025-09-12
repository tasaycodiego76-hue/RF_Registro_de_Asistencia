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

        $attendance = Attendance::create([
            'employee_id' => $request->input('employee_id'),
            'type' => $request->input('type'),
            'date' => now()->toDateString(),
            'time' => now()->format('H:i:s'),
        ]);

        return redirect()->back()->with('success', '✅ Asistencia registrada correctamente.');
    }

    // En AttendanceController.php - agrega este método después de store()

// En AttendanceController.php - agrega este método después de store()

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

