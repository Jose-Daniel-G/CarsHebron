<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $alumno =User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $alumno->assignRole('alumno');
        $this->call([
            RolesSeeder::class,
            CursoSeeder::class,
            UserSeeder::class,
            ClaseSeeder::class,
        ]);

        }
    }
