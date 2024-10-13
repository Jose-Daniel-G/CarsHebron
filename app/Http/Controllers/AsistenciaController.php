<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cliente;
use App\Models\Event as CalendarEvent;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    // public function verFormulario()
    public function index()
    {
        // Obtenemos los clientes y eventos disponibles para el formulario
        $clientes = Cliente::all();
        $eventos = CalendarEvent::whereDate('start', '>=', now())->get(); // Filtra solo los eventos futuros o del día actual

        // // Filtra solo los eventos programados para el día actual// $eventos = CalendarEvent::whereDate('start', '=', now()->toDateString())->get();

        //    dd($eventos,$clientes);
        // return view('admin.asistencias.asistencia', compact('clientes', 'eventos'));
        return view('admin.asistencias.index', compact('clientes', 'eventos'));
    }
    // public function registrarAsistencia(Request $request)
    public function create(Request $request)
    {
        // Validamos los datos requeridos
        $validatedData = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'evento_id'  => 'required|exists:calendar_events,id',
            'asistio'    => 'required|boolean',
            'duracion'   => 'required_if:asistio,false|numeric|min:1'
        ]);
    
        // Creamos la asistencia con penalidad en caso de inasistencia
        $asistencia = Asistencia::create([
            'cliente_id' => $validatedData['cliente_id'],
            'evento_id'  => $validatedData['evento_id'],
            'asistio'    => $validatedData['asistio'],
            'penalidad'  => $validatedData['asistio'] ? 0 : $validatedData['duracion'] * 20000
        ]);
    
        return redirect()->back()->with('success', 'Asistencia registrada correctamente');
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
