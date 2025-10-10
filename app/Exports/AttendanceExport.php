<?php

namespace App\Exports;

use App\Models\Attendance;
use Spatie\SimpleExcel\SimpleExcelWriter;

class AttendanceExport
{
    public static function export()
    {
        $rows = Attendance::with('empleado')->get()->map(function ($a) {
            return [
                'ID' => $a->id,
                'Empleado' => $a->empleado ? $a->empleado->name : 'Sin nombre',
                    'Fecha' => $a->date ?? 'Sin fecha',
                    'Hora' => $a->time ?? 'Sin hora',
                    'Estado' => $a->status ? ucfirst($a->status) : 'Desconocido',
                    'Tipo' => $a->type ?? 'Sin tipo',
            ];
        });

        $path = storage_path('app/public/asistencias.xlsx');

        SimpleExcelWriter::create($path)
            ->addHeader(['ID', 'Empleado', 'Fecha', 'Hora Entrada', 'Estado', 'Tipo'])
            ->addRows($rows->toArray());

        return response()->download($path);
    }
}
