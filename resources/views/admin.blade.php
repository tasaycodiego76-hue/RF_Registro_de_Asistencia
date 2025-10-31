<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Control de Asistencias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* ---------------------------
   RESET & BASE STYLES
--------------------------- */
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

/* ---------------------------
   HEADER
--------------------------- */
.header {
  background: #000;
  padding: 25px 0;
  box-shadow: 0 4px 20px rgba(255, 193, 7, 0.3);
  border-bottom: 3px solid #ffc107;
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
  text-shadow: 0 0 20px rgba(255, 193, 7, 0.3);
}

.subtitle {
  font-size: 1.1rem;
  color: #ccc;
}

/* ---------------------------
   MAIN CONTAINER
--------------------------- */
.main-container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 40px 20px;
}

/* ---------------------------
   FILTER SECTION
--------------------------- */
.filter-section {
  background: #fff;
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

label {
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
  transition: 0.3s;
  font-weight: 500;
}

.date-input:focus {
  border-color: #ffc107;
  outline: none;
  box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
}

/* ---------------------------
   BUTTONS
--------------------------- */
.btn-filter,
.btn-clear {
  padding: 12px 24px;
  border-radius: 10px;
  font-size: 16px;
  font-weight: 600;
  text-decoration: none;
  transition: 0.3s;
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

.btn-clear {
  background: #2d2d2d;
  color: white;
  box-shadow: 0 4px 15px rgba(45, 45, 45, 0.4);
}

/* ---------------------------
   TABLE
--------------------------- */
.table-container {
  background: #fff;
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
  background: #000;
  padding: 20px;
  color: #fff;
  text-align: center;
}

.table-title {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 8px;
  background: linear-gradient(45deg, #ffc107, #ffeb3b);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

table {
  width: 100%;
  border-collapse: collapse;
  font-size: 15px;
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
  transition: 0.3s;
  border-bottom: 1px solid #e0e0e0;
}

tbody tr:hover {
  background: rgba(255, 193, 7, 0.1);
  transform: scale(1.005);
  box-shadow: 0 2px 10px rgba(255, 193, 7, 0.1);
}

tbody td {
  padding: 16px 15px;
  color: #2d2d2d;
  font-weight: 500;
}

/* ---------------------------
   STATUS & ACTIONS
--------------------------- */
.employee-id {
  font-family: 'Courier New', monospace;
  background: #f8f9fa;
  padding: 6px 10px;
  border-radius: 6px;
  font-weight: 700;
  color: #000;
  border: 1px solid #e0e0e0;
}

.status-entrada {
  color: #28a745;
  font-weight: 700;
  text-transform: uppercase;
}

.status-salida {
  color: #dc3545;
  font-weight: 700;
  text-transform: uppercase;
}

.status-puntual {
  background: #28a745;
  color: white;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
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
  box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
}

.status-na {
  color: #6c757d;
  font-style: italic;
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

/* ---------------------------
   ACTION BUTTONS
--------------------------- */
.btn-delete,
.btn-view {
  padding: 8px 14px;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.btn-delete {
  background: #dc3545;
  color: white;
  border: none;
}

.btn-view {
  background: #ffc107;
  color: #000;
  border: none;
}

.btn-delete:hover {
  background: #c82333;
}

.btn-view:hover {
  background: #ffb300;
}

.actions-column {
  text-align: center;
  white-space: nowrap;
}

/* ---------------------------
   EMPTY STATE
--------------------------- */
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

/* ---------------------------
   RESPONSIVE
--------------------------- */
@media (max-width: 768px) {
  .main-container {
    padding: 20px 15px;
  }

  table {
    min-width: 800px;
  }
}

    .btn-export {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 25px;
    background: linear-gradient(135deg, #28a745 0%, #218838 100%);
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
    transition: all 0.3s ease;
    font-size: 16px;
    text-transform: uppercase;
}

.btn-export i {
    font-size: 18px;
}

.btn-export:hover {
    background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.6);
}

.btn-export:active {
    transform: translateY(0);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
}

   .btn-quincenal {
    position: relative;
    display: inline-block;
    background-color: #3498db;
    color: #fff;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    margin-bottom: 15px;
}

.btn-quincenal .count {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #e74c3c;
    color: #fff;
    padding: 2px 6px;
    border-radius: 50%;
    font-weight: bold;
}

    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="header-left">
                <a href="/dashboard" class="home-btn"><i class="fas fa-home"></i></a>
                <div>
                    <h1>Panel Administrativo</h1>
                    <p class="subtitle">Sistema de Control de Asistencias Empresarial</p>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="filter-section">
            <form method="GET" class="date-filter-form">
                <div class="filter-group">
                    <label><i class="fas fa-calendar-alt"></i> Filtrar por fecha:</label>
                    <input type="date" name="date_filter" value="{{ request('date_filter') }}" class="date-input">
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-filter"><i class="fas fa-filter"></i> Filtrar</button>
                    <a href="{{ url()->current() }}" class="btn-clear"><i class="fas fa-times"></i> Limpiar</a>
               <a href="{{ route('admin.export') }}" class="btn-export">
    <i class="fas fa-file-excel"></i> Exportar a Excel
</a>

<a href="{{ route('admin.quincenal') }}" class="btn-quincenal">
    Quincenal
    @if($totalTardanzasAltas > 0)
        <span class="count">{{ $totalTardanzasAltas }}</span>
    @endif
</a>









                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
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
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th class="actions-column">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td><span class="employee-id">{{ $attendance->employee_id }}</span></td>
                                <td>{{ $attendance->empleado->name ?? 'Desconocido' }}</td>
                                <td class="{{ $attendance->type === 'entrada' ? 'status-entrada' : 'status-salida' }}">
                                    {{ ucfirst($attendance->type) }}
                                </td>
                                <td>
                                    @if($attendance->type === 'entrada')
                                        @if($attendance->status === 'puntual')
                                            <span class="status-puntual">Puntual</span>
                                        @elseif($attendance->status === 'tardanza')
                                            <span class="status-tardanza">Tardanza</span>
                                        @else
                                            <span class="status-na">Sin estado</span>
                                        @endif
                                    @else
                                        <span class="status-na">—</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                                <td><span class="time-display">{{ \Carbon\Carbon::parse($attendance->time)->format('H:i:s') }}</span></td>
                                <td class="actions-column">
                                    <!-- Botón Ver -->
                                    <a href="{{ route('admin.show', $attendance->id) }}" class="btn-view" title="Ver Detalle">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <!-- Botón Eliminar -->
                                    <form method="POST" action="{{ route('attendance.destroy', $attendance->id) }}" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('¿Eliminar este registro?')">
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
                    <i class="fas fa-clipboard-list"></i>
                    <h3>No hay registros de asistencia</h3>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
