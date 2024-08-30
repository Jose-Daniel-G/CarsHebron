<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        $profesor = User::create([
            'name' => 'Profesor',
            'email' => 'profesor@example.com',
            'password' => bcrypt('password'),
        ]);
        $profesor->assignRole('profesor');

        $alumno = User::create([
            'name' => 'Alumno',
            'email' => 'alumno@example.com',
            'password' => bcrypt('password'),
        ]);
        $alumno->assignRole('alumno');
    }
}
