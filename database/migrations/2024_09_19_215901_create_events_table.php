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
        Schema::create('events', function (Blueprint $table) {
            $table->id();  // Clave primaria
            $table->string("title",255);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('color');

            $table->unsignedBigInteger('asistente_id');
            $table->foreign('asistente_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id')->references('id')->on('profesors')->onDelete('cascade');

            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
