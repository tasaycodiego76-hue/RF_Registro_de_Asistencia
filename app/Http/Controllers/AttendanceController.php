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
            'time' => now()->toTimeString(),
        ]);

        return redirect()->back()->with('success', '✅ Asistencia registrada correctamente.');
    }
    
}

