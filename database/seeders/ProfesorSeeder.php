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

class ProfesorSeeder extends Seeder
{
    public function run(): void
    {
        //--------------------------------------------]
        User::create([
            'name' => 'Profesor',
            'email' => 'profesor@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('profesor');
        Profesor::create([
            'nombres' => 'Profesor',
            'apellidos' => 'Lewis',
            'telefono' => '4564564565',
            'especialidad' => 'A2,B1,',
            'user_id' => '4',
        ]);

        User::create([
            'name' => 'Profesor1',
            'email' => 'profesor1@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('profesor');
        Profesor::create([
            'nombres' => 'Wingston',
            'apellidos' => 'Gallardo',
            'telefono' => '432324324',
            'especialidad' => 'ODONTOLOGIA',
            'user_id' => '5',
        ]);
        User::create([
            'name' => 'Julio Profe',
            'email' => 'profesor2@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('11111111'),
        ])->assignRole('profesor');
        Profesor::create([
            'nombres' => 'Martin',
            'apellidos' => 'Valdes',
            'telefono' => '123123213',
            'especialidad' => 'FISIOTERAPIA',
            'user_id' => '6',
        ]);
    }
}
