<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        // $vehiculos = Vehiculo::all();
        $vehiculos = Vehiculo::with('profesor:id,nombres,apellidos')
            ->select('vehiculos.*')
            ->get();
        return view("admin.vehiculos.index", compact('vehiculos'));
    }

    public function create()
    {
        return view('admin.vehiculos.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del request
        $request->validate([
            'placa' => 'required|string|max:10|unique:vehiculos,placa', // Validación para que la placa sea única
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|max:50', // Asegúrate de que 'tipo' sea válido
            'disponible' => 'required|boolean', // Asumiendo que quieres manejar disponibilidad
            'picoyplaca_id' => 'required|exists:picoyplaca,id', // Asumiendo que tienes esta validación
            'usuario_id' => 'required|exists:users,id', // Asegúrate de que el usuario exista
        ]);

        // Crear un nuevo vehículo con los datos proporcionados
        Vehiculo::create($request->all());

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.vehiculos.index')
            ->with('title', 'Éxito')
            ->with('icon', 'success')
            ->with('info', 'Vehículo creado correctamente.');
    }

    public function show(Vehiculo $vehiculo)
    {
        $vehiculo = Vehiculo::with('profesor:id,nombres,apellidos')
            ->select('vehiculos.*')
            ->get();
        return view('admin.vehiculos.show', compact('vehiculo')); // Asegúrate de tener esta vista
    }

    public function edit(Vehiculo $vehiculo)
    {
        $profesores = Profesor::all(); // Obtener todos los profesores
        $vehiculo->load('profesor'); // Cargar solo el profesor relacionado

        return response()->json([
            'vehiculo' => $vehiculo,
            'profesores' => $profesores,
        ]);
    }


    public function update(Request $request, Vehiculo $vehiculo)
    {
        // Validar los datos del request
        $request->validate([
            'placa' => 'required|string|max:7',
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'disponible' => 'required|boolean', // Validación para 'disponible'
            'picoyplaca_id' => 'nullable|exists:picoyplaca,id', // Si manejas un campo de pico y placa
            'profesor_id' => 'nullable|exists:profesores,id' // Validación para el profesor asociado
        ]);
    
        // Actualizar solo los campos que deben ser actualizados
        $vehiculo->update();
    
        // Redireccionar con un mensaje de éxito
        return redirect()->route('admin.vehiculos.index')
            ->with('title', 'Éxito')
            ->with('info', 'Vehículo actualizado correctamente.')
            ->with('icon', 'success');
    }
    

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('admin.vehiculos.index')
            ->with('title', 'Éxito')
            ->with('info', 'El vehículo ha sido eliminado exitosamente.')
            ->with('icon', 'success');
    }
}
