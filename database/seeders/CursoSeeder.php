<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Horario;
use App\Models\Cliente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        //-----------------[ CURSOS ]--------------------------
        Curso::create([
            'nombre' => 'Curso A1',
            'descripcion' => 'Curso de conducción para obtener licencia tipo A1.',
            'horas_requeridas' => '15',
            'estado' => 'A',
        ]);
        Curso::create([
            'nombre' => 'Curso A2',
            'descripcion' => 'Curso de conducción para obtener licencia tipo A2.',
            'horas_requeridas' => '20',
            'estado' => 'A',
        ]);
        Curso::create([
            'nombre' => 'Curso B2',
            'descripcion' => 'Curso de conducción para obtener licencia tipo B2.',
            'horas_requeridas' => '10',
            'estado' => 'A',
        ]);
        Curso::create([
            'nombre' => 'Curso B1',
            'descripcion' => 'Curso de conducción para obtener licencia tipo B1.',
            'horas_requeridas' => '11',
            'estado' => 'A',
        ]);

        User::factory(9)->create();


    }
}
