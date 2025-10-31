<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;

// ✅ Vista principal (colaboradoress)
Route::get('/', function () {
    return view('colaborador');
})->name('colaborador.login');

// ✅ Registrar asistencia (entrada/salida)
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');

// ✅ Acceso administrativo (login admin)
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// ✅ Panel administrativo (ver registros)
Route::get('/admin/panel', [AdminController::class, 'panel'])->name('admin.panel');

// En routes/web.php - agrega esta línea
Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

Route::get('/admin/asistencia/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::get('/admin/export-excel', [AdminController::class, 'exportExcel'])->name('admin.export');
Route::get('/admin/quincenal', [AdminController::class, 'quincenal'])->name('admin.quincenal');
Route::get('/attendance/{employee_id}/barcode', [AttendanceController::class, 'showBarcode'])->name('attendance.barcode');
