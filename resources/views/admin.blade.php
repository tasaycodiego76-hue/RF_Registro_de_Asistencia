<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 40px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
            font-size: 32px;
        }

        .table-container {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            max-width: 1000px;
            margin: 0 auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        thead {
            background: #667eea;
            color: #fff;
        }

        thead th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        tbody tr {
            border-bottom: 1px solid #eee;
            transition: background 0.3s ease;
        }

        tbody tr:hover {
            background: #f4f6ff;
        }

        tbody td {
            padding: 12px 15px;
        }

        .status-entrada {
            color: #28a745;
            font-weight: bold;
        }

        .status-salida {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>📊 Panel Administrativo</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->employee_id }}</td>
                        <td>{{ $attendance->empleado->name ?? 'Desconocido' }}</td>
                        <td class="{{ $attendance->type === 'entrada' ? 'status-entrada' : 'status-salida' }}">
                            {{ ucfirst($attendance->type) }}
                        </td>
                        <td>{{ $attendance->date }}</td>
                        <td>{{ $attendance->time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
