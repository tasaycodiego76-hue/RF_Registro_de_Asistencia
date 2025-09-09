<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;

// ✅ Vista principal (colaboradores)
Route::get('/', function () {
    return view('colaborador');
})->name('colaborador.login');

// ✅ Registrar asistencia (entrada/salida)
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

// ✅ Acceso administrativo (login admin)
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// ✅ Panel administrativo (ver registros)
Route::get('/admin/panel', [AdminController::class, 'panel'])->name('admin.panel');
