<!-- resources/views/colaborador.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registro de Asistencia</title>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('/images/fondo.jpeg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.6);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            animation: slideIn 0.6s ease-out;
            border-top: 5px solid #FFD700;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Área visual de escaneo */
        .scan-area {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 4px dashed #FFD700;
            border-radius: 20px;
            padding: 50px 30px;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .scan-area.scanning {
            border-color: #28a745;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(40,167,69,0.3);
        }

        .scan-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;
        }

        .scan-icon svg {
            width: 100%;
            height: 100%;
            fill: #FFD700;
            animation: pulse 2.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.08);
            }
        }

        .scan-line {
            position: absolute;
            left: 10%;
            right: 10%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #FFD700, transparent);
            box-shadow: 0 0 10px #FFD700;
            display: none;
            animation: scanAnimation 2s ease-in-out infinite;
        }

        .scan-area.scanning .scan-line {
            display: block;
        }

        @keyframes scanAnimation {
            0% {
                top: 25%;
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                top: 75%;
                opacity: 0;
            }
        }

        .scan-text {
            font-size: 22px;
            font-weight: 700;
            color: #222;
            margin-bottom: 12px;
            letter-spacing: -0.3px;
        }

        .scan-subtext {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
        }

        .scan-status {
            margin-top: 20px;
            font-size: 13px;
            color: #28a745;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .scan-area.scanning .scan-status {
            opacity: 1;
            animation: blink 1.5s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.4;
            }
        }

        /* Mensajes */
        .status-message {
            margin: 25px 0;
            padding: 18px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            text-align: center;
            display: none;
            position: relative;
            padding-left: 50px;
        }

        .message-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            font-weight: bold;
        }

        .status-message.success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 2px solid #28a745;
            box-shadow: 0 4px 15px rgba(40,167,69,0.2);
        }

        .status-message.error {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 2px solid #dc3545;
            box-shadow: 0 4px 15px rgba(220,53,69,0.2);
        }

        .status-message.warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
            border: 2px solid #ffc107;
            box-shadow: 0 4px 15px rgba(255,193,7,0.2);
        }

        /* Acceso administrativo */
        .admin-link {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #e1e5e9;
            padding-top: 20px;
        }

        .admin-link a {
            color: #000;
            font-weight: 600;
            cursor: pointer;
        }

        .admin-link a:hover {
            text-decoration: underline;
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 350px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            text-align: center;
            position: relative;
            border-top: 5px solid #FFD700;
        }

        .modal-content h2 {
            margin-bottom: 20px;
            color: #222;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 12px;
            font-size: 25px;
            color: #444;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all .3s ease;
        }

        .form-group input:focus {
            border-color: #FFD700;
            background: #fff;
            box-shadow: 0 0 8px rgba(255,215,0,0.6);
            outline: none;
        }

        .btn {
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all .3s;
            width: 100%;
        }

        .entrada-btn {
            background: #FFD700;
            color: #000;
        }

        .entrada-btn:hover {
            background: #e6c200;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Área de escaneo -->
    <div class="scan-area" id="scanArea">
        <div class="scan-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M4 4h4v2H6v2H4V4zm0 14h2v2h2v2H4v-4zm16 0v4h-4v-2h2v-2h2zM16 4h4v4h-2V6h-2V4zM3 8h2v8H3V8zm16 0h2v8h-2V8zM8 3h8v2H8V3zm0 16h8v2H8v-2z"/>
            </svg>
        </div>
        <div class="scan-line"></div>
        <div class="scan-text">Acerca tu tarjeta al lector</div>
        <div class="scan-subtext">El sistema registrará tu asistencia automáticamente</div>
        <div class="scan-status">● Sistema listo para escanear</div>
    </div>

    <!-- Input invisible -->
    <input type="text" id="barcodeInput" autofocus style="position:absolute;opacity:0;pointer-events:none;left:-9999px;">

    <!-- Formulario oculto -->
    <form id="attendanceForm" method="POST" action="{{ route('attendance.store') }}" style="display:none;">
        @csrf
        <input type="hidden" name="employee_id" id="formEmployeeId">
        <input type="hidden" name="type" id="formType">
    </form>

    <!-- Mensajes -->
    <div class="status-message" id="statusMessage"
         style="@if(session('success') || session('error') || session('warning')) display:block; @else display:none; @endif">
        @if(session('success'))
            <span class="message-icon">✓</span> {{ session('success') }}
        @elseif(session('error'))
            <span class="message-icon">✕</span> {{ session('error') }}
        @elseif(session('warning'))
            <span class="message-icon">⚠</span> {{ session('warning') }}
        @endif
    </div>

    <!-- Acceso administrativo -->
    <div class="admin-link">
        <a onclick="openAdminModal()">Acceso Administrativo</a>
    </div>
</div>

<!-- Modal administrativo -->
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
    const barcodeInput = document.getElementById('barcodeInput');
    const scanArea = document.getElementById('scanArea');
    const attendanceForm = document.getElementById('attendanceForm');
    const statusMessage = document.getElementById('statusMessage');

    // Efecto visual al escanear
    barcodeInput.addEventListener('input', function() {
        scanArea.classList.add('scanning');
    });

    // Registrar asistencia automáticamente con código de barras
    barcodeInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const employeeId = barcodeInput.value.trim();
            
            if (!employeeId) {
                scanArea.classList.remove('scanning');
                return showMessage('No se detectó código de barras', 'error');
            }

            // Lógica simple: antes de 12 -> entrada, después -> salida
            const now = new Date();
            const hours = now.getHours();
            const type = hours < 12 ? 'entrada' : 'salida';

            document.getElementById('formEmployeeId').value = employeeId;
            document.getElementById('formType').value = type;
            attendanceForm.submit();

            barcodeInput.value = '';
            scanArea.classList.remove('scanning');
        }
    });

    // Remover efecto de escaneo al perder foco
    barcodeInput.addEventListener('blur', function() {
        setTimeout(() => {
            scanArea.classList.remove('scanning');
            // Solo volver a enfocar si el modal NO está abierto
            if (document.getElementById('adminModal').style.display !== 'flex') {
                barcodeInput.focus();
            }
        }, 100);
    });

    // Mantener enfoque excepto cuando el modal está abierto
    document.addEventListener('click', function(e) {
        if (document.getElementById('adminModal').style.display !== 'flex') {
            barcodeInput.focus();
        }
    });

    // Funciones de mensajes
    function showMessage(text, type) {
        statusMessage.innerHTML = `<span class="message-icon">${type === 'success' ? '✓' : type === 'error' ? '✕' : '⚠'}</span> ${text}`;
        statusMessage.className = `status-message ${type}`;
        statusMessage.style.display = 'block';
        setTimeout(() => {
            statusMessage.style.display = 'none';
        }, 3500);
    }

    // Modal administrativo
    function openAdminModal() {
        document.getElementById('adminModal').style.display = 'flex';
        setTimeout(() => {
            document.getElementById('adminUser').focus();
        }, 100);
    }

    function closeAdminModal() {
        document.getElementById('adminModal').style.display = 'none';
        setTimeout(() => {
            barcodeInput.focus();
        }, 100);
    }

    // Cerrar modal con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('adminModal').style.display === 'flex') {
            closeAdminModal();
        }
    });

    // Eventos de sesión
    @if(session('admin_error'))
        document.addEventListener('DOMContentLoaded', function(){
            openAdminModal();
            alert("{{ session('admin_error') }}");
        });
    @endif

    @if(session('success'))
        document.addEventListener('DOMContentLoaded', function(){ 
            showMessage("{{ session('success') }}", 'success'); 
        });
    @endif

    @if(session('error'))
        document.addEventListener('DOMContentLoaded', function(){ 
            showMessage("{{ session('error') }}", 'error'); 
        });
    @endif

    @if(session('warning'))
        document.addEventListener('DOMContentLoaded', function(){ 
            showMessage("{{ session('warning') }}", 'warning'); 
        });
    @endif
</script>

</body>
</html>