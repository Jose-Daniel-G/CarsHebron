<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cliente;
use App\Models\Event as CalendarEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsistenciaController extends Controller
{
    // public function verFormulario()
    public function index()
    {
        // Obtener los clientes
        $clientes = Cliente::all();

        // Filtrar solo los eventos programados para el día actual
        $hoy = Carbon::now()->format('Y-m-d');
        // $events = CalendarEvent::whereDate('start', '>=', now())->get(); // Filtra solo los eventos futuros o del día actual
        $events = CalendarEvent::whereDate('start', $hoy)->get();

        // Obtener las asistencias registradas para el día actual
        $asistencias = Asistencia::with('event', 'cliente')
            ->whereHas('event', function ($query) use ($hoy) {
                $query->whereDate('start', $hoy);
            })
            ->get();

        return view('admin.asistencias.index', compact('clientes', 'events', 'asistencias'));
    }

    // public function registrarAsistencia(Request $request)
    public function store(Request $request)
    {
        foreach ($request->eventos as $eventoId => $evento) {
            // Validamos los datos de cada evento
            $validatedData = Validator::make($evento, [
                'cliente_id' => 'required|exists:clientes,id',
                'asistio'    => 'nullable|boolean', // Puede ser null si no está marcado
            ])->validate();
    
            // Añadimos el evento_id al array de datos validados
            $validatedData['evento_id'] = $eventoId;
    
            // Asignamos 0 si no está marcado el checkbox de 'asistió'
            $validatedData['asistio'] = isset($validatedData['asistio']) ? $validatedData['asistio'] : 0;
    
            // Obtener el evento para calcular la duración
            $event = CalendarEvent::find($eventoId);
            if ($event) {
                // Asegúrate de que start y end sean instancias de Carbon
                $start = \Carbon\Carbon::parse($event->start);
                $end = \Carbon\Carbon::parse($event->end);
    
                // Calcular la duración en horas
                $duracionHoras = $end->diffInHours($start);
                $validatedData['duracion'] = $duracionHoras; // Asegúrate de tener una columna 'duracion' en la tabla 'asistencias'
            } else {
                // Manejar el caso si no se encuentra el evento
                continue; // O lanzar un error, según lo que necesites
            }
    
            // Creamos la asistencia con los datos validados
            Asistencia::create($validatedData);
        }
    
        return redirect()->route('admin.asistencias.index')
            ->with('info', 'Asistencia registrada correctamente.')
            ->with('icono', 'success');
    }
    



    // Función para la secretaria de ver inasistencias y habilitar cliente
    // public function verInasistencias()
    public function show()
    {
        // Filtra los clientes que tengan inasistencias con penalidad
        $clientes = Cliente::select('clientes.id', 'clientes.nombres AS nombre_cliente', 'asistencias.id AS asistencia_id', 'events.title AS nombre_evento', 'events.start', 'asistencias.asistio', 'asistencias.penalidad')
            ->join('asistencias', 'clientes.id', '=', 'asistencias.cliente_id')
            ->join('events', 'asistencias.evento_id', '=', 'events.id')
            // ->where('asistencias.asistio', 0)
            ->where('asistencias.penalidad', '>=', 0)
            ->limit(100)
            ->get();

        return view('admin.asistencias.inasistencias', compact('clientes'));
    }


    // Función para habilitar al cliente después de pagar la penalidad
    public function habilitarCliente($cliente_id)
    {
        $cliente = Cliente::findOrFail($cliente_id);

        // Elimina las penalidades de este cliente
        foreach ($cliente->asistencias as $asistencia) {
            if (!$asistencia->asistio) {
                $asistencia->penalidad = 0;
                $asistencia->save();
            }
        }

        return redirect()->back()->with('success', 'Cliente habilitado correctamente');
    }
    public function update(Request $request)
    {
        foreach ($request->eventos as $evento_id => $data) {
            $evento = CalendarEvent::find($evento_id);
            $asistio = isset($data['asistio']) ? 1 : 0;

            $evento->update([
                'asistio' => $asistio,
            ]);
        }

        return redirect()->back()->with('success', 'Asistencia registrada correctamente');
    }
}
