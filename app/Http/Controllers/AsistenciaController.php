<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cliente;
use App\Models\Event as CalendarEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        // $events = CalendarEvent::whereDate('start', $hoy)->get();

        // Obtener las asistencias registradas para el día actual
        $asistencias = Asistencia::with('event', 'cliente')
            ->whereHas('event', function ($query) use ($hoy) {
                $query->whereDate('start', $hoy);
            })
            ->get();

        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superAdmin')) {
            $events = CalendarEvent::whereDate('start', '>=', now())
                ->join('profesors', 'events.profesor_id', '=', 'profesors.id')
                ->join('users', 'profesors.user_id', '=', 'users.id')
                ->select('events.*')
                ->get();
        } else {
            $events = CalendarEvent::whereDate('start', '>=', now())
                ->join('profesors', 'events.profesor_id', '=', 'profesors.id')
                ->join('users', 'profesors.user_id', '=', 'users.id')
                ->where('users.id', Auth::user()->id)
                ->select('events.*')
                ->get();
        }
        // dd($asistencias);
        return view('admin.asistencias.index', compact('clientes', 'events', 'asistencias'));
    }

    public function store(Request $request)/* registrarAsistencia(Request $request) */
    {
        // dd($request->all());
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
                $start = Carbon::parse($event->start);
                $end = Carbon::parse($event->end);

                // Calcular la duración en horas
                $duracionHoras = $end->diffInHours($start);
                if ($validatedData['asistio'] == 0) {
                    $validatedData['penalidad'] = $duracionHoras * 20000; // Si no asistió, calcular la penalidad
                } else {
                    $validatedData['penalidad'] = 0; // Si asistió, no hay penalidad
                }
            } else {
                // Manejar el caso si no se encuentra el evento
                continue; // O lanzar un error, según lo que necesites
            }

            // Verificar si ya existe una asistencia para este cliente y evento
            $asistenciaExistente = Asistencia::where('cliente_id', $validatedData['cliente_id'])
                ->where('evento_id', $eventoId)
                ->first();

            // if ($asistenciaExistente) {
                // Si existe, actualizamos el registro
                $asistenciaExistente->update($validatedData);
                // dd('hello:',$validatedData);

            // } else {
            //     // Si no existe, creamos un nuevo registro
            //     Asistencia::create($validatedData);
            //     dd('hello:',$validatedData);

            // }
        }
        // dd('hello:',$validatedData);

        return redirect()->route('admin.asistencias.index')
            ->with('info', 'Asistencia registrada correctamente.')
            ->with('icono', 'success');
    }

    // Función para la secretaria de ver inasistencias y habilitar cliente
    // public function verInasistencias()
    public function show() //INASISTENCIAS
    {
        // Filtra los clientes que tengan inasistencias con penalidad
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superAdmin')) {
            $clientes = Cliente::select('clientes.id', 'clientes.nombres AS nombre', 'clientes.apellidos AS apellido', 'asistencias.id AS asistencia_id', 'events.title AS nombre_evento', DB::raw('DATE(events.start) AS date'), DB::raw('TIME(events.start) AS start'), DB::raw('TIME(events.end) AS end'), 'asistio', 'penalidad', 'liquidado', 'fecha_pago_multa')
                ->join('asistencias', 'clientes.id', '=', 'asistencias.cliente_id')
                ->join('events', 'asistencias.evento_id', '=', 'events.id')
                ->get();
// dd($clientes);
            // Calcular las horas penalizadas en PHP
            foreach ($clientes as $cliente) {
                $start = new \DateTime($cliente->start);
                $end = new \DateTime($cliente->end);
                $diff = $start->diff($end);
                $hours = $diff->h + ($diff->i / 60); // Calcular horas con minutos convertidos a horas
                $cliente->cant_horas = round($hours, 2); // Asignar la cantidad de horas calculadas
            }
            return view('admin.asistencias.inasistencias', compact('clientes'));
        } else {
            $clientes = Cliente::select('clientes.id', 'clientes.nombres AS nombre', 'clientes.apellidos AS apellido', 'asistencias.id AS asistencia_id', 'events.title AS nombre_evento', DB::raw('DATE(events.start) AS date'), DB::raw('TIME(events.start) AS start'), DB::raw('TIME(events.end) AS end'), 'asistencias.asistio', 'asistencias.penalidad', 'asistencias.liquidado', 'asistencias.fecha_pago_multa')
                ->join('asistencias', 'clientes.id', '=', 'asistencias.cliente_id')
                ->join('events', 'asistencias.evento_id', '=', 'events.id')
                ->where('asistencias.asistio', 0)
                ->where('asistencias.penalidad', '>=', 0)
                ->get();

            // Calcular las horas penalizadas en PHP
            foreach ($clientes as $cliente) {
                $start = new \DateTime($cliente->start);
                $end = new \DateTime($cliente->end);
                $diff = $start->diff($end);
                $hours = $diff->h + ($diff->i / 60); // Calcular horas con minutos convertidos a horas
                $cliente->cant_horas = round($hours, 2); // Asignar la cantidad de horas calculadas
            }
            return view('admin.asistencias.inasistencias', compact('clientes'));
        }
        // ->get()->toArray();
        // dd($clientes);  
    }


    // Función para habilitar al cliente después de pagar la penalidad
    public function habilitarCliente($cliente_id)
    {
        $cliente = Cliente::findOrFail($cliente_id);

        // Recorre las asistencias del cliente
        foreach ($cliente->asistencias as $asistencia) {
            // Si ya está habilitado, deshabilitar y cambiar el valor de 'asistio' a true (o viceversa)
            if ($asistencia->liquidado) {
                // Invertir el valor de 'asistio'
                $asistencia->asistio = !$asistencia->asistio;

                // Restablecer la fecha de pago de multa si se deshabilita
                if (!$asistencia->asistio) {
                    $asistencia->fecha_pago_multa = null;
                    $asistencia->liquidado = false;
                } else {
                    $asistencia->fecha_pago_multa = now()->format('Y-m-d H:i:s');
                    $asistencia->liquidado = true;
                }
            } else {
                // Si el cliente no ha sido habilitado antes, habilitarlo
                if (!$asistencia->asistio) {
                    $asistencia->liquidado = true;
                    $asistencia->fecha_pago_multa = now()->format('Y-m-d H:i:s');
                }
            }

            $asistencia->save(); // Guardar los cambios en cada asistencia
        }

        return redirect()->back()->with('success', 'El estado del cliente ha sido actualizado correctamente');
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
