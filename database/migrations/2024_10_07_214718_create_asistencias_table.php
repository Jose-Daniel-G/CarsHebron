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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();  // Clave primaria

            $table->unsignedBigInteger('cliente_id');  // Columna para la clave foránea de 'clientes'
            $table->unsignedBigInteger('evento_id');  // Columna para la clave foránea de 'eventos'

            $table->boolean('asistio')->default(true);  // Indicar asistencia
            $table->integer('penalidad')->default(0);  // Penalidad por inasistencia

            $table->timestamps();  // Timestamps

            // Definir las claves foráneas
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('evento_id')->references('id')->on('events')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
