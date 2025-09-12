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

    // 🔹 Mostrar el panel administrativo
public function panel()
{
    $attendances = \App\Models\Attendance::with('empleado')->get();
    return view('admin', compact('attendances'));
}



}
