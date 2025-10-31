<!DOCTYPE html>
<html>
<head>
    <title>Código de Barras - {{ $employee->name }}</title>
</head>
<body>
    <h2>{{ $employee->name }}</h2>
    <p>ID: {{ $employee->employee_id }}</p>
    <!-- Código de barras -->
    <div>
        {!! DNS1D::getBarcodeHTML($employee->employee_id, 'C39') !!}
    </div>
</body>
</html>
