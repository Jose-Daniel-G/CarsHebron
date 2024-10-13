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
            $table->enum('tipo', ['moto', 'carro'])->default('carro');
            $table->timestamps();
            $table->unsignedBigInteger('picoyplaca_id')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('picoyplaca_id')->references('id')->on('picoyplaca')->onDelete('set null');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
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
