<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Event as CalendarEvent;  // Usa un alias para el modelo Event
use App\Models\Horario;
use App\Models\Cliente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {   $total_usuarios = User::count();
        $total_secretarias = Secretaria::count();
        $total_clientes = Cliente::count();
        $total_cursos = Curso::count();
        $total_profesores = Profesor::count();
        $total_horarios = Horario::count();
        
        $cursos = Curso::all();
        $profesores =Profesor::all();
        $eventos = CalendarEvent::all();
        return view('admin.index', compact('total_usuarios', 'total_secretarias', 'total_clientes', 'total_cursos', 'total_profesores', 'total_horarios', 'cursos', 'profesores', 'eventos'));
    }
    public function ver_reservas($id)
    { // echo $id;
        $eventos = CalendarEvent::where('user_id',$id)->get();
        return view('admin.ver_reservas', compact('eventos'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Admin $admin)
    {
        //
    }

    public function update(Request $request, Admin $admin)
    {
        //
    }

    public function destroy(Admin $admin)
    {
        //
    }
}
