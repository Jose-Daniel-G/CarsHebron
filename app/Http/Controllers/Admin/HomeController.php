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
        // $total_completados = Config::count();

        $profesores = Profesor::all();
        $events = CalendarEvent::all(); // dd(Auth::user()->getRoleNames());

        if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria') || Auth::user()->hasRole('profesor')) {
            $cursos = Curso::all();
            $clientes = Cliente::all();
            $role = 'admin'; // Asegúrate de tener un campo 'role'

            return view('admin.index', compact('total_usuarios', 'total_secretarias', 'total_clientes', 'total_cursos', 'total_profesores', 'total_horarios', 'total_eventos', 'cursos', 'profesores', 'clientes', 'events', 'total_configuraciones', 'role'));
        } else {
            $cliente = Cliente::where('user_id', Auth::id())->first();
            // dd($cliente);    
            $cursos = $cliente->cursos; // Cursos del cliente
            $profesores = Profesor::distinct()
                ->join('events', 'profesors.id', '=', 'events.profesor_id')
                ->join('clientes', 'clientes.id', '=', 'events.cliente_id')
                ->join('users', 'clientes.user_id', '=', 'users.id')
                ->where('clientes.user_id', Auth::id())
                ->select('profesors.*')
                ->get();
            return view('admin.index', compact('total_usuarios', 'total_secretarias', 'total_clientes', 'total_cursos', 'total_profesores', 'total_horarios', 'total_eventos', 'cursos', 'profesores', 'events', 'total_configuraciones'));
        }
    }

    public function show($id) //show_reservas
    { // echo $id;
        if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria')) {
            $events = CalendarEvent::with('cliente')->get(); // $events = CalendarEvent::all();
        } else {
            $events = CalendarEvent::where('cliente_id',  Auth::user()->cliente->id)->get();
        }
        return view('admin.reservas.show', compact('events'));
    }

    public function show_reserva_profesores($id) //calendar
    {
        try {
            // Verifica si el usuario autenticado es un administrador
            if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria')) {
                // Obtener todos los eventos del profesor específico
                $events = CalendarEvent::with(['profesor', 'cliente']) // Asegúrate de que estas relaciones estén definidas en el modelo
                    ->where('profesor_id', $id)
                    ->get();
                return response()->json($events);
            } else {

                $events = CalendarEvent::with(['profesor', 'cliente'])
                ->join('users as profesores', 'profesores.id', '=', 'events.profesor_id')
                ->join('clientes', 'clientes.id', '=', 'events.cliente_id')
                ->join('users as clientes_users', 'clientes.user_id', '=', 'clientes_users.id')
                ->where('clientes.user_id', Auth::id())
                ->where('events.profesor_id', $id)
                ->select('events.*')
                ->get();

                return response()->json($events);
            }
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error: ' . $exception->getMessage()]);
        }
    }

    // public function create()
    // {
    //     return view('admin.usuarios.create');
    // }
}
