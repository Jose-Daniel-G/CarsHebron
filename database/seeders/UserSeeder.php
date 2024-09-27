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

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // -------------[ Cliente ]----------------------
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('cliente');

        Cliente::create([
            'nombres' => 'Cliente',
            'apellidos' => 'vargas',
            'cc' => '12312753',
            'nro_seguro' => '12395113',
            'fecha_nacimiento' => '01-01-1986',
            'genero' => 'M',
            'celular' => '12395113',
            'correo' => 'cliente.vargas@gmail.com',
            'direccion' => 'Cll 9 oeste',
            'grupo_sanguineo' => 'o+',
            'alergias' => 'polvo',
            'contacto_emergencia' => '65495113',
            'observaciones' => 'le irrita estar cerca del povo',
            'user_id' => '7',
        ]);
        //-------------[ USUARIOS ]----------------]
        User::create([
            'name' => 'Fancisco Antonio Grijalba Osorio', 
            'email' => 'francisco.grijalba@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('usuario');

        User::create([
            'name' => 'Juan David Grijalba Osorio',
            'email' => 'juandavidgo1997@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('usuario');

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@email.com',
            'password' => bcrypt('123123123'),
        ])->assignRole('usuario');

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@email.com',
            'password' => bcrypt('123123123'),
        ])->assignRole('usuario');
    
        Curso::create([
            'nombre' => 'Curso B1',
            'descripcion' => 'Curso de conducción para obtener licencia tipo B1.',
            'horas_requeridas' => '11',
            'estado' => 'A',
        ]);

        User::factory(9)->create();
    }
}
