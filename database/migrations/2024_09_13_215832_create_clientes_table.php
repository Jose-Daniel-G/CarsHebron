<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres' , 100);
            $table->string('apellidos' , 100);
            $table->string('cc' , 100)->unique();
            $table->string('nro_seguro')->unique();
            $table->string('fecha_nacimiento' , 100);
            $table->string('genero' , 10);
            $table->string('celular' , 20);
            $table->string('correo' , 40)->unique();
            $table->string('direccion' , 150);
            $table->string('grupo_sanguineo' , 150);
            $table->string('alergias' , 255);
            $table->string('contacto_emergencia' , 255);
            $table->string('observaciones' , 255)->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
