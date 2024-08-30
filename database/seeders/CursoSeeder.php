<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::insert([
            [
                'nombre' => 'Curso A1',
                'descripcion' => 'Curso de conducción para obtener licencia tipo A1.',
                'horas_requeridas' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Curso A2',
                'descripcion' => 'Curso de conducción para obtener licencia tipo A2.',
                'horas_requeridas' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Curso B1',
                'descripcion' => 'Curso de conducción para obtener licencia tipo B1.',
                'horas_requeridas' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Curso B2',
                'descripcion' => 'Curso de conducción para obtener licencia tipo B2.',
                'horas_requeridas' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Curso B3',
                'descripcion' => 'Curso de conducción para obtener licencia tipo B3.',
                'horas_requeridas' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Curso C1',
                'descripcion' => 'Curso de conducción para obtener licencia tipo C1.',
                'horas_requeridas' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Curso C3',
                'descripcion' => 'Curso de conducción para obtener licencia tipo C3.',
                'horas_requeridas' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
