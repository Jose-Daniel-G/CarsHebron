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
            'nombre' => 'A1',
            'descripcion' => 'Curso de conducción para obtener licencia tipo A1.',
            'horas_requeridas' => '15',

            'estado' => 'A',
        ]);
        // Curso::create([
        //     'nombre' => 'A2',
        //     'descripcion' => 'Curso de conducción para obtener licencia tipo A2.',
        //     'horas_requeridas' => '20',
        //     'estado' => 'A',
        // ]);
        Curso::create([
            'nombre' => 'B2',
            'descripcion' => 'Curso de conducción para obtener licencia tipo B2.',
            'horas_requeridas' => '20',
            'estado' => 'A',
        ]);
        Curso::create([
            'nombre' => 'C1',
            'descripcion' => 'Licencia tipo B1. PARA CARRO PUBLICO',
            'horas_requeridas' => '30',

            'estado' => 'A',
        ]);



    }
}
