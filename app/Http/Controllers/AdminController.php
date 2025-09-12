<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

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
        
        // Si hay filtro por fecha
        if ($request->filled('date_filter')) {
            $query->where('date', $request->date_filter);
        }
        
        $attendances = $query->orderBy('created_at', 'desc')->get();
        
        return view('admin', compact('attendances'));
    }
}