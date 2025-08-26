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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa')->unique();
            $table->string('modelo');
            $table->boolean('disponible')->default(true);
            // $table->unsignedBigInteger('tipo_id'); // solo una vez
            // $table->foreign('tipo_id')->references('id')->on('tipos_vehiculos')->onDelete('cascade');
            $table->foreignId('tipo_id')->constrained('tipos_vehiculos');
            $table->unsignedBigInteger('profesor_id')->nullable();
            $table->foreign('profesor_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos_tables');
    }
};
