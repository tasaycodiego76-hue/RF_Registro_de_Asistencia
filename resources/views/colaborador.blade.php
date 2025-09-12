<!-- resources/views/colaborador.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro de Asistencia</title>
    <style>
        * {margin:0; padding:0; box-sizing:border-box;}
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('/images/fondo.jpeg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .container {
            background:white;
            border-radius:15px;
            box-shadow:0 8px 25px rgba(0,0,0,0.6);
            padding:40px;
            width:100%;
            max-width:400px;
            animation: slideIn 0.6s ease-out;
            border-top:5px solid #FFD700; /* Amarillo corporativo */
        }

        .form-group {margin-bottom:20px;}
        .form-group label {
            display:block;
            margin-bottom:8px;
            font-weight:600;
            font-size:14px;
            color:#222;
        }

        .form-group input {
            width:100%;
            padding:12px;
            border:2px solid #ddd;
            border-radius:8px;
            font-size:16px;
            transition: all .3s ease;
        }

        .form-group input:focus {
            border-color:#FFD700;
            background:#fff;
            box-shadow:0 0 8px rgba(255,215,0,0.6);
            outline:none;
        }

        .buttons {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:15px;
            margin-top:30px;
        }

        .btn {
            padding:15px;
            border:none;
            border-radius:8px;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:all .3s;
        }

        .entrada-btn {
            background:#FFD700;
            color:#000;
        }
        .entrada-btn:hover {
            background:#e6c200;
        }

        .salida-btn {
            background:#000;
            color:#FFD700;
            border:2px solid #FFD700;
        }
        .salida-btn:hover {
            background:#222;
        }

        .status-message {
            margin:20px 0;
            padding:15px;
            border-radius:8px;
            font-weight:600;
            text-align:center;
            display:none;
        }
        .status-message.success {background:#d4edda; color:#155724;}
        .status-message.error {background:#f8d7da; color:#721c24;}
        .status-message.warning {background:#fff3cd; color:#856404;}

        .admin-link {
            text-align:center;
            margin-top:30px;
            border-top:1px solid #e1e5e9;
            padding-top:20px;
        }
        .admin-link a {
            color:#FFD700;
            font-weight:600;
            cursor:pointer;
        }
        .admin-link a:hover {
            text-decoration:underline;
        }

        /* Modal */
        .modal {
            position:fixed;
            top:0; left:0; width:100%; height:100%;
            background:rgba(0,0,0,0.7);
            display:none;
            justify-content:center;
            align-items:center;
        }
        .modal-content {
            background:white;
            padding:30px;
            border-radius:12px;
            width:90%;
            max-width:350px;
            box-shadow:0 10px 25px rgba(0,0,0,0.5);
            text-align:center;
            position:relative;
            border-top:5px solid #FFD700;
        }
        .modal-content h2 {
            margin-bottom:20px;
            color:#222;
        }
        .close-btn {
            position:absolute;
            top:10px; right:12px;
            font-size:25px;
            color:#444;
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-group">
            <label for="employeeId">ID de Colaborador</label>
            <input type="text" id="employeeId" placeholder="Ingrese su ID" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" placeholder="Ingrese su contraseña" required>
        </div>
        <div class="buttons">
            <button class="btn entrada-btn" onclick="registerAttendance('entrada')">ENTRADA</button>
            <button class="btn salida-btn" onclick="registerAttendance('salida')">SALIDA</button>
        </div>

        <!-- Mensajes -->
        <div class="status-message" id="statusMessage"
             style="@if(session('success') || session('error') || session('warning')) display:block; @else display:none; @endif">
            @if(session('success')) {{ session('success') }}
            @elseif(session('error')) {{ session('error') }}
            @elseif(session('warning')) {{ session('warning') }}
            @endif
        </div>

        <div class="admin-link">
            <a onclick="openAdminModal()">Acceso Administrativo</a>
        </div>
    </div>

    <!-- FORMULARIO OCULTO -->
    <form id="attendanceForm" method="POST" action="{{ route('attendance.store') }}" style="display:none;">
        @csrf
        <input type="hidden" name="employee_id" id="formEmployeeId">
        <input type="hidden" name="password" id="formPassword">
        <input type="hidden" name="type" id="formType">
    </form>

    <!-- Modal admin -->
    <div class="modal" id="adminModal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeAdminModal()">&times;</span>
            <h2>Acceso Administrativo</h2>
            <form id="adminLoginForm" method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-group">
                    <input type="text" id="adminUser" name="user" placeholder="Usuario" required>
                </div>
                <div class="form-group">
                    <input type="password" id="adminPass" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn entrada-btn">Ingresar</button>
            </form>
        </div>
    </div>

    <script>
        function registerAttendance(type) {
            const employeeId = document.getElementById('employeeId').value.trim();
            const password = document.getElementById('password').value.trim();
            if (!employeeId || !password) {
                showMessage('Por favor complete todos los campos', 'error');
                return;
            }
            document.getElementById('formEmployeeId').value = employeeId;
            document.getElementById('formPassword').value = password;
            document.getElementById('formType').value = type;
            document.getElementById('attendanceForm').submit();
        }

        function showMessage(text, type) {
            const msg = document.getElementById('statusMessage');
            msg.textContent = text;
            msg.className = `status-message ${type}`;
            msg.style.display = 'block';
            setTimeout(hideMessage, 3500);
        }

        function hideMessage() {
            document.getElementById('statusMessage').style.display = 'none';
        }

        function openAdminModal(){ document.getElementById('adminModal').style.display = 'flex'; }
        function closeAdminModal(){ document.getElementById('adminModal').style.display = 'none'; }

        @if(session('admin_error'))
            document.addEventListener('DOMContentLoaded', function(){
                openAdminModal();
                alert("{{ session('admin_error') }}");
            });
        @endif

        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function(){ showMessage("{{ session('success') }}",'success'); });
        @endif
        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function(){ showMessage("{{ session('error') }}",'error'); });
        @endif
@if(session('warning'))
    document.addEventListener('DOMContentLoaded', function(){
        showMessage("{{ session('warning') }}", 'warning'); // O 'error' si no tienes tipo warning
    });
@endif
    </script>
</body>
</html>
