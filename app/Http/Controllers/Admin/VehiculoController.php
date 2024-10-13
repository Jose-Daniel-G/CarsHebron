<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view("admin.vehiculos.index", compact('vehiculos'));
    }

    public function create()
    {
        return view('admin.vehiculos.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            // 'marca' => 'required|string|max:255','anio' => 'required|integer','color' => 'required|string|max:50',
            // 'placa' => 'required|string|max:10',
            'nombre' => 'required|string|max:30',
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
        ]);
        // Intentar encontrar el vehículo por la placa
        $vehiculo = Vehiculo::where('placa', $request->placa)->first();

        if ($vehiculo) {
            // Si el vehículo ya existe, redirigir con un mensaje de error
            return redirect()->back()->withErrors(['placa' => 'El vehículo con esa placa ya existe.']);
        } else {
            // Si no existe, crear uno nuevo con los datos proporcionados
            $vehiculo = new Vehiculo();
            $vehiculo->placa = $request->placa;
            $vehiculo->nombre = $request->nombre;
            $vehiculo->modelo = $request->modelo;
            $vehiculo->tipo = $request->tipo;
            $vehiculo->save();

            // Redirigir con un mensaje de éxito
            return redirect()->route('admin.vehiculos.index')->with('success', 'Vehículo creado correctamente.');
        }
    }

    public function show(Vehiculo $vehiculo) {}

    public function edit(Vehiculo $vehiculo)
    {
        return view('admin.vehiculos.edit', compact('vehiculo'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        // dd($request->all());
        // 'marca' => 'required|string|max:255','anio' => 'required|integer','color' => 'required|string|max:50',
        $request->validate([
            'modelo' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
        ]);
        $data = $request->except(['placa']); // Si no deseas que se actualice la placa
        $vehiculo->update($data);

        return redirect()->route('admin.vehiculos.index')->with('info', 'Vehículo actualizado correctamente.');
    }
    public function destroy(Vehiculo $vehiculo)
    {
        // $this->authorize('author',$vehiculo);
        $vehiculo->delete();
        return redirect()->route('admin.vehiculos.index')->with('success', 'El post ha sido eliminado exitosamente');
    }
}