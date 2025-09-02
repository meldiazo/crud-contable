<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asiento_contables', function (Blueprint $table) {
            $table->id(); // Columna para la clave primaria, autoincremental
            $table->date('fecha'); // La fecha del asiento
            $table->string('descripcion'); // Una breve descripción de la transacción
            $table->decimal('monto_debe', 10, 2); // El monto en el lado del debe
            $table->decimal('monto_haber', 10, 2); // El monto en el lado del haber
            $table->string('cuenta_debe'); // La cuenta que se debita (ej: "Caja")
            $table->string('cuenta_haber'); // La cuenta que se acredita (ej: "Ingresos por ventas")
            $table->timestamps(); // Columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asiento_contables');
    }
};
