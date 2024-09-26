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
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Jose Daniel Grijalba Osorio',
            'email' => 'jose.jdgo97@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('admin');
        //----------[  SECRETARIA  ]-------------
        User::create([
            'name' => 'Secretaria',
            'email' => 'secretaria@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('secretaria');

        Secretaria::create([
            'nombres' => 'Secretaria',
            'apellidos' => 'Catrana',
            'cc' => 'secretaria@email.com',
            'celular' => '3147078256',
            'fecha_nacimiento' => '10/10/2010',
            'direccion' => 'calle 5 o este',
            'user_id' => '3',
        ]);
        //-------------------------------------
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
            'licencia_medica' => '123123123',
            'especialidad' => 'A2,B1,',
            'user_id' => '4',
        ]);
        //--------------------------------------------]
        User::create([
            'name' => 'Profesor1',
            'email' => 'profesor1@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('profesor');
        Profesor::create([
            'nombres' => 'Profesor1',
            'apellidos' => 'Gallardo',
            'telefono' => '432324324',
            'licencia_medica' => '777777',
            'especialidad' => 'ODONTOLOGIA',
            'user_id' => '5',
        ]);
        //--------------------------------------------]
        User::create([
            'name' => 'Profesor2',
            'email' => 'profesor2@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('11111111'),
        ])->assignRole('profesor');
        Profesor::create([
            'nombres' => 'Profesor2',
            'apellidos' => 'Valdes',
            'telefono' => '123123213',
            'licencia_medica' => '222222',
            'especialidad' => 'FISIOTERAPIA',
            'user_id' => '6',
        ]);
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
        // -------------------------------------------------
        //-------------[ USUARIOS ]----------------]
        User::create([
            'name' => 'Fancisco Antonio Grijalba Osorio', // 'sexo'=> 'M', 'telefono'=>'314852684',
            'email' => 'francisco.grijalba@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('usuario');

        User::create([
            'name' => 'Juan David Grijalba Osorio',
            // 'sexo'=> 'M','telefono'=>'314852685',
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
        //-----------------[ CURSOS ]--------------------------
        Curso::create([
            'nombre' => 'Curso A1',
            'descripcion' => '1-1A',
            'horas_requeridas' => '15',
            'estado' => 'A',
        ]);
        Curso::create([
            'nombre' => 'Curso A1',
            'descripcion' => '1-1A',
            'horas_requeridas' => '15',
            'estado' => 'A',
        ]);
        Curso::create([
            'nombre' => 'Curso A1',
            'descripcion' => '1-1A',
            'horas_requeridas' => '15',
            'estado' => 'A',
        ]);
        Curso::create([
            'nombre' => 'Curso A1',
            'descripcion' => '1-1A',
            'horas_requeridas' => '15',
            'estado' => 'A',
        ]);

        User::factory(9)->create();

        /// CREACION DE HORARIOS
        Horario::create([
            'dia' => 'LUNES',
            'hora_inicio' => '8:00:00',
            'hora_fin' => '14:00:00',
            'profesor_id' => '1',
            'curso_id' => '1',
        ]);
    }
}
