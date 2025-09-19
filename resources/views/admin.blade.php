<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Control de Asistencias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            color: #2d2d2d;
            overflow-x: auto;
        }

        .header {
            background: #000000;
            padding: 25px 0;
            box-shadow: 0 4px 20px rgba(255, 193, 7, 0.3);
            border-bottom: 3px solid #ffc107;
            position: relative;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .home-btn {
            background: #ffc107;
            color: #000;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.4);
            transition: all 0.3s ease;
        }

        .home-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(255, 193, 7, 0.6);
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, #ffc107, #ffeb3b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 20px rgba(255, 193, 7, 0.3);
        }

        .subtitle {
            font-size: 1.1rem;
            color: #ccc;
        }

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .filter-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 2px solid #ffc107;
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
            background: #2d2d2d;
            color: white;
            box-shadow: 0 4px 15px rgba(45, 45, 45, 0.4);
        }

        .btn-clear:hover {
            background: #000000;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6);
        }

        .table-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 2px solid #ffc107;
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
            background: #000000;
            padding: 20px;
            color: #fff;
            text-align: center;
            position: relative;
        }

        .table-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(45deg, #ffc107, #ffeb3b);
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
            background: rgba(255, 193, 7, 0.1);
            transform: scale(1.005);
            box-shadow: 0 2px 10px rgba(255, 193, 7, 0.1);
        }

        tbody tr:nth-child(even) {
            background: #fafafa;
        }

        tbody tr:nth-child(even):hover {
            background: rgba(255, 193, 7, 0.1);
        }

        tbody td {
            padding: 16px 15px;
            color: #2d2d2d;
            font-weight: 500;
        }

        .employee-id {
            font-family: 'Courier New', monospace;
            background: #f8f9fa;
            padding: 6px 10px;
            border-radius: 6px;
            font-weight: 700;
            color: #000;
            border: 1px solid #e0e0e0;
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
            background: #28a745;
            color: white;
            padding: 6px 12px;
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
            background: #dc3545;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
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
            background: #f8f9fa;
            padding: 6px 10px;
            border-radius: 6px;
            display: inline-block;
            border: 1px solid #e0e0e0;
        }

        .date-display {
            font-weight: 600;
            color: #495057;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-delete:hover {
            background: #c82333;
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 6px solid #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 6px solid #dc3545;
        }

        .alert i {
            font-size: 1.5rem;
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
            
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
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
        <div class="header-content">
            <div class="header-left">
                <a href="/dashboard" class="home-btn" title="Volver al inicio">
                    <i class="fas fa-home"></i>
                </a>
                <div>
                    <h1>Panel Administrativo</h1>
                    <p class="subtitle">Sistema de Control de Asistencias Empresarial</p>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <!-- Filtro por fecha -->
        <div class="filter-section">
            <form method="GET" class="date-filter-form">
                <div class="filter-group">
                    <label for="date_filter"><i class="fas fa-calendar-alt"></i> Filtrar por fecha:</label>
                    <input type="date" 
                           id="date_filter" 
                           name="date_filter" 
                           value="{{ request('date_filter') }}"
                           class="date-input">
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                    <a href="{{ url()->current() }}" class="btn-clear">
                        <i class="fas fa-times"></i> Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Mostrar mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('error') }}</div>
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
                                    @if($attendance->type === 'entrada')
                                        <i class="fas fa-sign-in-alt"></i> Entrada
                                    @else
                                        <i class="fas fa-sign-out-alt"></i> Salida
                                    @endif
                                </td>
                                <td>
                                    @if($attendance->type === 'entrada')
                                        @if($attendance->status === 'puntual')
                                            <span class="status-puntual"><i class="fas fa-check"></i> Puntual</span>
                                        @elseif($attendance->status === 'tardanza')
                                            <span class="status-tardanza"><i class="fas fa-clock"></i> Tardanza</span>
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
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div style="font-size: 4rem; margin-bottom: 20px;">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
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