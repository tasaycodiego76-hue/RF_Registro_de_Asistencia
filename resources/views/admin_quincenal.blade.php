<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Quincenal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #f4f4f4; }
        .status-red { color: #fff; background-color: #e74c3c; padding: 5px 10px; border-radius: 5px; }
        .status-green { color: #fff; background-color: #27ae60; padding: 5px 10px; border-radius: 5px; }
        .status-gray { color: #fff; background-color: #7f8c8d; padding: 5px 10px; border-radius: 5px; }
        .btn-quincenal { display: inline-block; background-color: #3498db; color: #fff; padding: 8px 15px; border-radius: 5px; text-decoration: none; margin-bottom: 15px; }
        .btn-quincenal .count { background: #e74c3c; padding: 2px 6px; border-radius: 50%; margin-left: 5px; font-weight: bold; }
        .select-quincena { margin-bottom: 15px; padding: 5px; border-radius: 5px; border: 1px solid #ccc; }
    </style>
</head>
<body>
<h2>Reporte de Tardanzas - {{ $quincenaActual }} del mes de {{ $fechaActual->format('F Y') }}</h2>


    <!-- Botón Quincenal con contador -->
    <a href="{{ route('admin.quincenal') }}" class="btn-quincenal">
        Quincenal
        @if($totalTardanzasAltas > 0)
            <span class="count">{{ $totalTardanzasAltas }}</span>
        @endif
    </a>

    <!-- Selector de quincena -->
<form method="GET" action="{{ route('admin.quincenal') }}">
    <label>Selecciona quincena:</label>
    <select name="quincena">
<option value="1" @if(request('quincena') == 1) selected @endif>1ª Quincena</option>
<option value="2" @if(request('quincena') == 2) selected @endif>2ª Quincena</option>

    </select>

    <label>Selecciona mes:</label>
    <input type="month" name="mes" value="{{ request('mes', now()->format('Y-m')) }}">

    <button type="submit">Filtrar</button>
</form>


    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Total Tardanzas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleadosData as $emp)
                <tr>
                    <td>{{ $emp['id'] }}</td>
                    <td>{{ $emp['name'] }}</td>
                    <td>
                        @if($emp['tardanzas'] > 3)
                            <span class="status-red">{{ $emp['tardanzas'] }}</span>
                        @elseif($emp['tardanzas'] > 0)
                            <span class="status-green">{{ $emp['tardanzas'] }}</span>
                        @else
                            <span class="status-gray">0</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
