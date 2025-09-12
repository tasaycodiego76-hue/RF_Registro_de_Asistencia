<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// Crea una migración:
// php artisan make:migration add_status_to_attendances_table

public function up()
{
    Schema::table('attendances', function (Blueprint $table) {
        $table->enum('status', ['puntual', 'tardanza'])->nullable()->after('time');
    });
}

public function down()
{
    Schema::table('attendances', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
