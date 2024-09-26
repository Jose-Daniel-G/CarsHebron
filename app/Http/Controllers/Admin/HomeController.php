<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Event as CalendarEvent;  // Usa un alias para el modelo Event
use App\Models\Horario;
use App\Models\Cliente;
use App\Models\Secretaria;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $total_usuarios = User::count();
        $total_secretarias = Secretaria::count();
        $total_clientes = Cliente::count();
        $total_cursos = Curso::count();
        $total_profesores = Profesor::count();
        $total_horarios = Horario::count();
        $total_eventos = CalendarEvent::count();
        $total_configuraciones = Config::count();
        
        $cursos = Curso::all();
        $profesores =Profesor::all();
        $eventos = CalendarEvent::all();
        return view('admin.index', compact('total_usuarios', 'total_secretarias', 'total_clientes', 'total_cursos', 'total_profesores', 'total_horarios','total_eventos','cursos', 'profesores', 'eventos','total_configuraciones'));
    }
}
