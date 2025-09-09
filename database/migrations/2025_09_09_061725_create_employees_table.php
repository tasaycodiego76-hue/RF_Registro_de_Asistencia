<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // id autoincremental
            $table->string('employee_id')->unique(); // Cambié employee_code → employee_id
            $table->string('name'); // Nombre del colaborador
            $table->string('password'); // Contraseña simple
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('employees');
    }
};
