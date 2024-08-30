<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clase;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\Curso;
use Carbon\Carbon;

class ClaseSeeder extends Seeder
{
    public function run()
    {
        // Obtener IDs de usuarios con el rol 'alumno'
        $alumnos = User::role('alumno')->pluck('id')->toArray();

        // Obtener IDs de usuarios con el rol 'profesor'
        $profesores = User::role('profesor')->pluck('id')->toArray();

        // Obtener IDs de vehículos y cursos
        $vehiculos = Vehiculo::pluck('id')->toArray();
        $cursos = Curso::pluck('id')->toArray();

        // Crear 10 clases de ejemplo
        for ($i = 1; $i <= 4; $i++) {
            Clase::create([
                'alumno_id' => $alumnos[array_rand($alumnos)],
                'profesor_id' => $profesores[array_rand($profesores)],
                'vehiculo_id' => $vehiculos ? $vehiculos[array_rand($vehiculos)] : null,
                'curso_id' => $cursos[array_rand($cursos)],
                'fecha_hora' => Carbon::now()->addDays(rand(0, 30))->format('Y-m-d H:i:s'),
                'duracion' => rand(1, 4), // Duración en horas
                'estado' => 'programada',
            ]);
        }
    }
}
