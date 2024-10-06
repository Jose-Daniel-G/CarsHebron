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
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $total_usuarios = User::count();
        $total_secretarias = Secretaria::count();
        $total_clientes = Cliente::count();
        $total_cursos = Curso::count();
        $total_profesores = Profesor::count();
        $total_horarios = Horario::count();
        $total_eventos = CalendarEvent::count();
        $total_configuraciones = Config::count();
    
        // Verifica si el usuario autenticado es un administrador
        if (Auth::user()->hasRole('admin')) {
            // Obtener todos los cursos
            $cursos = Curso::all();
        } else {
            // Obtener el cliente asociado al usuario autenticado
            $cliente = Cliente::where('user_id', Auth::id())->first(); // O la lógica adecuada para obtener el cliente
            // dd($cliente);
            if ($cliente) {
                // Obtener solo los cursos asociados al cliente
                $cursos = $cliente->cursos;
            } else {
                $cursos = collect(); // No hay cursos si no hay cliente
            }
        }
    //    dd($cursos);
        $profesores = Profesor::all();
        $events = CalendarEvent::all();
    
        return view('admin.index', compact('total_usuarios', 'total_secretarias', 'total_clientes', 'total_cursos', 'total_profesores', 'total_horarios', 'total_eventos', 'cursos', 'profesores', 'events', 'total_configuraciones'));
    }
    
    public function ver_reservas($id)
    { // echo $id;
        $eventos = CalendarEvent::where('user_id', $id)->get();
        return view('admin.ver_reservas', compact('eventos'));
    }
    public function cargar_reserva_profesores($id)
    { //echo $id;
        try { 
            $events = CalendarEvent::where('profesor_id', $id)->get();
                    // ->select('id','title', DB::raw('DATE_FORMAT(start, %Y-%m-%d) as start'),DB::raw('DATE_FORMAT(end, %Y-%m-%d) as end'),'color')
                    // ->get();
            return response()->json($events);
        } catch (\Exception $exception) {
            return response()->json(['mesaje' => 'Error']);
        }
    }
    public function create()
    {
        return view('admin.usuarios.create');
    }
}
