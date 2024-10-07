<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cliente;
use App\Models\Event as CalendarEvent;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function registrarAsistencia(Request $request)
    {
        $asistencia = Asistencia::create([
            'cliente_id' => $request->cliente_id,
            'evento_id' => $request->evento_id,
            'asistio' => $request->asistio, // Se pasa true o false según la asistencia
            'penalidad' => $request->asistio ? 0 : $request->duracion * 20000 // Si no asistió, calcula la penalidad
        ]);

        return redirect()->back()->with('success', 'Asistencia registrada correctamente');
    }

    // Función para la secretaria de ver inasistencias y habilitar cliente
    public function verInasistencias()
    {
        $clientes = Cliente::with('asistencias')->whereHas('asistencias', function ($query) {
            $query->where('asistio', false)->where('penalidad', '>', 0);
        })->get();

        return view('admin.secretarias.inasistencias', compact('clientes'));
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
    public function verFormulario()
    {
        // Obtenemos los clientes y eventos disponibles para el formulario
        $clientes = Cliente::all();
        $eventos = CalendarEvent::whereDate('start', '>=', now())->get(); // Filtra solo los eventos futuros o del día actual
        return view('admin.profesores.asistencia', compact('clientes', 'eventos'));
    }
}
