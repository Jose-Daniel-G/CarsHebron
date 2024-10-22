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
        Schema::create('completed_courses', function (Blueprint $table) {
            $table->id(); // ID de la tabla
            $table->unsignedBigInteger('user_id'); // ID del usuario que completó el curso
            $table->unsignedBigInteger('course_id'); // ID del curso
            $table->timestamp('completed_at'); // Fecha y hora en que se completó el curso
            $table->timestamps(); // Created at & Updated at

            // Definición de las claves foráneas
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_courses');
    }
};
