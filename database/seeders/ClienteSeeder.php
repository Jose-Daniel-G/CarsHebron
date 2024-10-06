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

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        //--------------------------------------------]
        // -------------[ Cliente ]----------------------
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('cliente');

        $cliente = Cliente::create([
            'nombres' => 'Cliente',
            'apellidos' => 'alracona',
            'cc' => '12312753',
            'nro_seguro' => '12395113',
            'fecha_nacimiento' => '01-01-1986',
            'genero' => 'M',
            'celular' => '12395113',
            'correo' => 'cliente@gmail.com',
            'direccion' => 'Cll 9 oeste',
            'contacto_emergencia' => '65495113',
            'observaciones' => 'le irrita estar cerca del povo',
            'user_id' => '7',
        ]);
        // Relacionar con los cursos (asumiendo que los cursos ya existen)
        $cursos = Curso::whereIn('id', [1, 2])->get(); // Obtener los cursos con ID 1 y 2
        $cliente->cursos()->attach($cursos); // Crear las relaciones

        User::create([
            'name' => 'Fancisco Antonio Grijalba',
            'email' => 'francisco.grijalba@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('cliente');
        $cliente = Cliente::create([
            'nombres' => 'Fancisco Antonio',
            'apellidos' => 'Grijalba',
            'cc' => '23548965',
            'nro_seguro' => '9654321',
            'fecha_nacimiento' => '01-01-1983',
            'genero' => 'M',
            'celular' => '987654321',
            'correo' => 'francisco.grijalba@email.com',
            'direccion' => 'Cll 7 oeste',
            'contacto_emergencia' => '65495113',
            'observaciones' => 'migrana',
            'user_id' => '8',
        ]);
        // Relacionar con los cursos (asumiendo que los cursos ya existen)
        $cursos = Curso::whereIn('id', [1, 3])->get(); // Obtener los cursos con ID 1 y 2
        $cliente->cursos()->attach($cursos); // Crear las relaciones
        
        User::create([
            'name' => 'ARGEMIRO ESCOBAR GUTIERRES',
            'email' => 'argemiro.escobar@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('cliente');

        Cliente::create([
            'nombres' => 'ARGEMIRO',
            'apellidos' => 'ESCOBAR',
            'cc' => '2354765',
            'nro_seguro' => '9654331',
            'fecha_nacimiento' => '01-01-1987',
            'genero' => 'M',
            'celular' => '987654321',
            'correo' => 'argemiro.escobar@gmail.com',
            'direccion' => 'Cll 7 oeste',
            'contacto_emergencia' => '65495113',
            'observaciones' => 'migrana',
            'user_id' => '9',
        ]);
        //    //-------------[ USUARIOS ]----------------]
        //         User::create([
        //             'name' => 'Juan David Grijalba Osorio',
        //             'email' => 'juandavidgo1997@email.com',
        //             'email_verified_at' => now(),
        //             'password' => bcrypt('123123123'),
        //         ])->assignRole('usuario');

        //         User::factory()->create([
        //             'name' => 'Test User',
        //             'email' => 'test@email.com',
        //             'password' => bcrypt('123123123'),
        //         ])->assignRole('usuario');

        //         User::factory()->create([
        //             'name' => 'user',
        //             'email' => 'user@email.com',
        //             'password' => bcrypt('123123123'),
        //         ])->assignRole('usuario');

        //         Curso::create([
        //             'nombre' => 'Curso B1',
        //             'descripcion' => 'Curso de conducción para obtener licencia tipo B1.',
        //             'horas_requeridas' => '11',
        //             'estado' => 'A',
        //         ]);

        //         User::factory(9)->create();
    }
}
