<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            SecretariaSeeder::class,
            ProfesorSeeder::class,
            CursoSeeder::class,
            HorarioSeeder::class,
            ClienteSeeder::class,
        ]);
        User::factory(9)->create();

    }
}
