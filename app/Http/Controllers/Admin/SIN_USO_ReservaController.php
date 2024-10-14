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
// NO SE ESTA USANDO  NO SE ESTA USANDO NO SE ESTA USANDO
class ReservaController extends Controller
{
    public function index()
    {

    }

    public function show($id)//show_reservas
    { // echo $id;
        if (Auth::user()->hasRole('superAdmin') ||  Auth::user()->hasRole('admin') || Auth::user()->hasRole('secretaria')) {
            $events = CalendarEvent::with('cliente')->get();
            // $events = CalendarEvent::all();
        } else {
            $events = CalendarEvent::where('cliente_id',  Auth::user()->cliente->id)->get();
        }
        return view('admin.reservas.show', compact('events'));
    }
    public function show_reserva_profesores($id) //calendar
    {

    }

    public function create()
    {
        return view('admin.usuarios.create');
    }
}
