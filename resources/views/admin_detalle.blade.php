<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tardanzas del Empleado</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f3f4f6;
            padding: 40px;
            color: #333;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            border-left: 6px solid #000;
        }
        h2 { text-align: center; color: #111; margin-bottom: 10px; }
        h3 { color: #555; margin-bottom: 20px; text-align: center; }
        .mensaje {
            text-align: center;
            font-weight: bold;
            font-size: 1.1rem;
            margin: 15px 0;
        }
        .alerta { color: #dc2626; }
        .ok { color: #16a34a; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px;
            text-align: center;
        }
        th { background: #000; color: #FFD700; text-transform: uppercase; }
        .volver {
            display: block;
            text-align: center;
            margin-top: 25px;
            background: #000;
            color: #FFD700;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
        }
        .volver:hover { background: #333; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Empleado: {{ $asistencia->empleado->name ?? 'Desconocido' }}</h2>
        <h3>ID: {{ $asistencia->employee_id }}</h3>

        <div class="mensaje {{ $totalTardanzas > 3 ? 'alerta' : 'ok' }}">
            {{ $mensaje }}
        </div>

        <h3>📅 Tardanzas en esta quincena</h3>
        @if($tardanzas->isEmpty())
            <p style="text-align:center;">No tiene tardanzas registradas.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tardanzas as $t)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($t->date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->time)->format('H:i:s') }}</td>
                            <td style="color:#dc2626;font-weight:bold;">Tardanza</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('admin.panel') }}" class="volver">
            <i class="fa-solid fa-arrow-left"></i> Volver al panel
        </a>
    </div>
</body>
</html>
