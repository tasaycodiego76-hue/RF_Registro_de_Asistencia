<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Control de Asistencias</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
            min-height: 100vh;
            color: #fff;
            overflow-x: auto;
        }

        .header {
            background: linear-gradient(90deg, #000000 0%, #2d2d2d 50%, #000000 100%);
            padding: 30px 0;
            box-shadow: 0 4px 20px rgba(255, 193, 7, 0.3);
            border-bottom: 3px solid #ffc107;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20" fill="none"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23ffc107" stroke-width="0.5" opacity="0.1"/></pattern></defs><rect width="100" height="20" fill="url(%23grid)"/></svg>') repeat;
            opacity: 0.1;
        }

        h1 {
            text-align: center;
            font-size: 2.8rem;
            font-weight: 700;
            background: linear-gradient(45deg, #ffc107, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(255, 193, 7, 0.5);
            position: relative;
            z-index: 1;
        }

        .subtitle {
            text-align: center;
            margin-top: 10px;
            font-size: 1.1rem;
            color: #ccc;
            position: relative;
            z-index: 1;
        }

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .filter-section {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid #ffc107;
            position: relative;
        }

        .filter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffc107, #ffeb3b, #ffc107);
            border-radius: 15px 15px 0 0;
        }

        .date-filter-form {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-filter-form label {
            font-weight: 600;
            color: #2d2d2d;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .date-input {
            padding: 12px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            min-width: 180px;
            background: #fff;
            color: #2d2d2d;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .date-input:focus {
            border-color: #ffc107;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
            transform: translateY(-1px);
        }

        .btn-filter, .btn-clear {
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-filter {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            color: #000;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        }

        .btn-filter:hover {
            background: linear-gradient(135deg, #ffb300 0%, #ff8f00 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.6);
        }

        .btn-clear {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
        }

        .btn-clear:hover {
            background: linear-gradient(135deg, #495057 0%, #343a40 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.6);
        }

        .table-container {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            border: 1px solid #ffc107;
            position: relative;
        }

        .table-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffc107, #ffeb3b, #ffc107);
        }

        .table-header {
            background: linear-gradient(135deg, #000000 0%, #2d2d2d 100%);
            padding: 20px;
            color: #fff;
            text-align: center;
            position: relative;
        }

        .table-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(45deg, #ffc107, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .table-subtitle {
            color: #ccc;
            font-size: 0.9rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            background: #fff;
        }

        thead {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            color: #000;
        }

        thead th {
            padding: 18px 15px;
            text-align: left;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 13px;
            border-bottom: 2px solid #000;
        }

        tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background: linear-gradient(135deg, #fff9c4 0%, #fff3cd 100%);
            transform: scale(1.005);
            box-shadow: 0 2px 10px rgba(255, 193, 7, 0.2);
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        tbody tr:nth-child(even):hover {
            background: linear-gradient(135deg, #fff9c4 0%, #fff3cd 100%);
        }

        tbody td {
            padding: 16px 15px;
            color: #2d2d2d;
            font-weight: 500;
        }

        .employee-id {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 700;
            color: #000;
        }

        .employee-name {
            font-weight: 600;
            color: #000;
        }

        .status-entrada {
            color: #28a745;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-salida {
            color: #dc3545;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-puntual {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
        }

        .status-tardanza {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3); }
            50% { box-shadow: 0 2px 12px rgba(220, 53, 69, 0.6); }
            100% { box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3); }
        }

        .status-na {
            color: #6c757d;
            font-style: italic;
            font-weight: 500;
        }

        .time-display {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            color: #000;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 6px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        .date-display {
            font-weight: 600;
            color: #495057;
        }

        .btn-delete {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.5);
        }

        .btn-delete:active {
            transform: translateY(0);
        }

        .actions-column {
            text-align: center;
            width: 120px;
        }

        .alert {
            padding: 20px;
            margin: 30px auto;
            max-width: 1400px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 6px solid #28a745;
        }

        .alert-error {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 6px solid #dc3545;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #495057;
        }

        .empty-state p {
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-container {
                padding: 20px 15px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .date-filter-form {
                flex-direction: column;
                gap: 15px;
            }
            
            .filter-group {
                flex-direction: column;
                gap: 8px;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            table {
                min-width: 800px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1> Panel Administrativo</h1>
        <p class="subtitle">Sistema de Control de Asistencias Empresarial</p>
    </div>

    <div class="main-container">
        <!-- Filtro por fecha -->
        <div class="filter-section">
            <form method="GET" class="date-filter-form">
                <div class="filter-group">
                    <label for="date_filter">📅 Filtrar por fecha:</label>
                    <input type="date" 
                           id="date_filter" 
                           name="date_filter" 
                           value="{{ request('date_filter') }}"
                           class="date-input">
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-filter">
                        🔍 Filtrar
                    </button>
                    <a href="{{ url()->current() }}" class="btn-clear">
                        🔄 Limpiar Filtros
                    </a>
                </div>
            </form>
        </div>

        <!-- Mostrar mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-container">
            <div class="table-header">
                <h2 class="table-title">Registros de Asistencia</h2>
                <p class="table-subtitle">
                    @if(request('date_filter'))
                        Mostrando registros del {{ \Carbon\Carbon::parse(request('date_filter'))->format('d/m/Y') }}
                    @else
                        Mostrando todos los registros
                    @endif
                </p>
            </div>
            
            @if($attendances->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>ID Empleado</th>
                            <th>Nombre Completo</th>
                            <th>Tipo Registro</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th class="actions-column">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>
                                    <span class="employee-id">{{ $attendance->employee_id }}</span>
                                </td>
                                <td>
                                    <span class="employee-name">{{ $attendance->empleado->name ?? 'Usuario Desconocido' }}</span>
                                </td>
                                <td class="{{ $attendance->type === 'entrada' ? 'status-entrada' : 'status-salida' }}">
                                    {{ $attendance->type === 'entrada' ? '🟢 Entrada' : '🔴 Salida' }}
                                </td>
                                <td>
                                    @if($attendance->type === 'entrada')
                                        @if($attendance->status === 'puntual')
                                            <span class="status-puntual">✅ Puntual</span>
                                        @elseif($attendance->status === 'tardanza')
                                            <span class="status-tardanza">⏰ Tardanza</span>
                                        @else
                                            <span class="status-na">Sin estado</span>
                                        @endif
                                    @else
                                        <span class="status-na">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="date-display">{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</span>
                                </td>
                                <td>
                                    <span class="time-display">{{ \Carbon\Carbon::parse($attendance->time)->format('H:i:s') }}</span>
                                </td>
                                <td class="actions-column">
                                    <form method="POST" action="{{ route('attendance.destroy', $attendance->id) }}" 
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Eliminar registro"
                                                onclick="return confirm('⚠️ ¿Está seguro de eliminar este registro?\n\nEsta acción es irreversible.')">
                                            🗑️ Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div style="font-size: 4rem; margin-bottom: 20px;">📋</div>
                    <h3>No hay registros de asistencia</h3>
                    <p>
                        @if(request('date_filter'))
                            No se encontraron registros para la fecha seleccionada.
                        @else
                            Aún no hay registros de asistencia en el sistema.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Confirmación elegante para eliminar registros
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-ocultar alertas después de 6 segundos
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.transition = 'all 0.5s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 6000);

            // Agregar efecto de carga suave
            const tableContainer = document.querySelector('.table-container');
            tableContainer.style.opacity = '0';
            tableContainer.style.transform = 'translateY(20px)';
            setTimeout(() => {
                tableContainer.style.transition = 'all 0.6s ease';
                tableContainer.style.opacity = '1';
                tableContainer.style.transform = 'translateY(0)';
            }, 300);
        });
    </script>
</body>
</html>