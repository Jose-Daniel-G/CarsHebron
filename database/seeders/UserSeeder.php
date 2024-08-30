<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{   
    public function run()
    {
    // Crea un usuario administrador y le asigna el rol 'admin'
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'), // Asegúrate de cifrar la contraseña
    ]);
    $admin->assignRole('admin');

    // Crea un usuario profesor y le asigna el rol 'profesor'
    $profesor = User::create([
        'name' => 'Profesor User',
        'email' => 'profesor@example.com',
        'password' => bcrypt('password'),
    ]);
    $profesor->assignRole('profesor');
    // Crea un usuario profesor y le asigna el rol 'profesor'
    $profesor = User::create([
        'name' => 'Jose',
        'email' => 'jose.jdgo97@gmail.com',
        'password' => bcrypt('password'),
    ]);
    $profesor->assignRole('profesor');

    // Crea un usuario alumno y le asigna el rol 'alumno'
    $alumno = User::create([
        'name' => 'Alumno User',
        'email' => 'alumno@example.com',
        'password' => bcrypt('password'),
    ]);
    $alumno->assignRole('alumno');
    }
}
