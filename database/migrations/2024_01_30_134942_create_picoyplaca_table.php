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
        Schema::create('picoyplaca', function (Blueprint $table) {
            $table->id(); // Asegúrate de que esto sea un unsigned big integer
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('dia');
            $table->time('horario'); // O puedes usar string si es más apropiado
            $table->string('placas_reservadas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picoyplaca');
    }
};
