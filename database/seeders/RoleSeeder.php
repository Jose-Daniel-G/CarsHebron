<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
 
    public function run()
    {
        //-----------------------------------------------------------------------------------------------        

        // ----------------------------------------------------------------------------------------------
        $admin = Role::create(['name' => 'admin']);
        $secretaria = Role::create(['name' => 'secretaria']);
        $profesor = Role::create(['name' => 'profesor']);
        $cliente = Role::create(['name' => 'cliente']);
        // $usuario = Role::create(['name' => 'usuario']);

        //------------------------[ ALEJANDRO PROJECT  ]---------------------------------
        // Permission::create(['name'=>'admin.home'])->assignRole($admin);
        Permission::create(['name' => 'admin.home'])->syncRoles([$admin, $secretaria, $profesor, $cliente]);
        Permission::create(['name' => 'admin.index']);

        // //rutas para el admin


        //rutas - configuraciones
        Permission::create(['name' => 'admin.config.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.config.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.config.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.config.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.config.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.config.destroy'])->syncRoles([$admin]);

        //rutas para el admin - secretarias
        Permission::create(['name' => 'admin.secretarias.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretarias.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretarias.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretarias.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretarias.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.secretarias.destroy'])->syncRoles([$admin]);

        //rutas para el admin - clientes
        Permission::create(['name' => 'admin.clientes.index'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.clientes.create'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.clientes.store'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.clientes.show'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.clientes.edit'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.clientes.destroy'])->syncRoles([$admin, $secretaria]);
        //rutas para el admin - cursos
        Permission::create(['name' => 'admin.cursos.index'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.cursos.create'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.cursos.store'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.cursos.show'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.cursos.edit'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.cursos.destroy'])->syncRoles([$admin, $secretaria]);
        //rutas para el admin - profesores
        Permission::create(['name' => 'admin.profesores.index'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.profesores.create'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.profesores.store'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.profesores.show'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.profesores.edit'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.profesores.destroy'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.profesores.pdf'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.profesores.reportes'])->syncRoles([$admin, $secretaria]);

        //rutas para el admin - horarios
        Permission::create(['name' => 'admin.horarios.index'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.horarios.create'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.horarios.store'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.horarios.show'])->syncRoles([$admin, $secretaria]);
        Permission::create(['name' => 'admin.horarios.edit'])->syncRoles([$admin, $secretaria]);

        //----------------------------------------------------------------------------------------
        Permission::create(['name' => 'cargar_datos_cursos'])->syncRoles([$admin, $cliente]);
        Permission::create(['name' => 'admin.horarios.cargar_reserva_profesores'])->syncRoles([$admin, $cliente]);
        Permission::create(['name' => 'admin.ver_reservas'])->syncRoles([$admin, $cliente]);
        Permission::create(['name' => 'admin.eventos'])->syncRoles([$admin, $cliente]);
        //----------------------------------------------------------------------------------------

        // Permission::create(['name' => 'admin.users.index'])->syncRoles([$admin]);
        // //proximamente remplazadas estas rutas seran
        // Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$admin]);
        // Permission::create(['name' => 'admin.usuarios.create'])->syncRoles([$admin]);
        // Permission::create(['name' => 'admin.usuarios.store'])->syncRoles([$admin]);
        // Permission::create(['name' => 'admin.usuarios.show'])->syncRoles([$admin]);
        // Permission::create(['name' => 'admin.usuarios.edit'])->syncRoles([$admin]);
        // Permission::create(['name' => 'admin.users.update'])->syncRoles([$admin]);
        // Permission::create(['name' => 'admin.usuarios.destroy'])->syncRoles([$admin]);

        // $admin->permissions()->attach();

        // //VEHICULOS
        // Permission::create(['name'=>'admin.vehiculos.index'])->syncRoles([$admin,$role3,$role4]);
        // Permission::create(['name'=>'admin.vehiculos.create'])->syncRoles([$admin]);
        // Permission::create(['name'=>'admin.vehiculos.update'])->syncRoles([$admin]);  

        // //PICO Y PLACA
        // Permission::create(['name'=>'admin.vehiculos.pico_y_placa.index'])->syncRoles([$admin,$role3,$role4]);
        // Permission::create(['name'=>'admin.vehiculos.pico_y_placa.create'])->syncRoles([$admin]);
        // Permission::create(['name'=>'admin.vehiculos.pico_y_placa.update'])->syncRoles([$admin]);

        // //CURSOS
        // Permission::create(['name'=>'admin.cursos.index'])->syncRoles([$admin,$role3,$role4]);
        // Permission::create(['name'=>'admin.cursos.create'])->syncRoles([$admin]);
        // Permission::create(['name'=>'admin.cursos.update'])->syncRoles([$admin]);

        // //CLASES
        // Permission::create(['name'=>'admin.clases.index'])->syncRoles([$admin,$role3,$role4]);
        // Permission::create(['name'=>'admin.clases.create'])->syncRoles([$admin,$role3]);
        // Permission::create(['name'=>'admin.clases.update'])->syncRoles([$admin,$role3]);

    }
}
