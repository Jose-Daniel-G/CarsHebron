<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function index()
    {
        $configuraciones = Config::all();
        return view('admin.config.index', compact('configuraciones'));
    }
    public function create()
    {
        return view('admin.config.create');
    }
    public function store(Request $request)
    {
        // dd($request);
        // Validación de los datos
        $validatedData = $request->validate(['nombre' => 'required|string|', 'direccion' => 'required|string|', 'telefono' => 'required|numeric|', 'correo' => 'required|string|', 'logo' => 'required|image|mimes:jpeg,png,jpg']);

        // Almacenar el archivo de logo y asignarlo al array
        $validatedData['logo'] = $request->file('logo')->store('logos', 'public');

        // Crear un nuevo registro en la tabla 'config'
        Config::create($validatedData);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('admin.config.index')
            ->with('info', 'Se registró la configuración de forma correcta')
            ->with('icono', 'success');
    }
    public function show(Config $config)
    {
        return view('admin.config.show', compact('config'));
    }
    public function edit(Config $config)
    {
        // dd($config->id);
        return view('admin.config.edit', compact('config'));
    }

    public function update(Request $request, Config $config)
    {
        // Validación de los datos
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono'  => 'required|numeric',
            'correo'    => 'required|email|max:255',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Logo opcional pero debe ser imagen válida
        ]);

        // Asignación de los datos al modelo
        $config->nombre = $request->input('nombre');
        $config->direccion = $request->input('direccion');
        $config->telefono = $request->input('telefono');
        $config->correo = $request->input('correo');

        // Manejo de archivo logo si se ha subido
        if ($request->hasFile('logo')) {
            // Eliminar el logo anterior si existe
            if ($config->logo) {
                Storage::delete('public/' . $config->logo);
            }
            // Guardar el nuevo logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $config->logo = $logoPath;
        }

        // Guardar los cambios
        $config->save();

        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.config.index')->with('info', 'Configuración actualizada exitosamente');
    }

    public function destroy(Config $config)
    {
        // dd($config->logo);
        if (Storage::exists('logos/'.$config->logo)) {
            Storage::delete('logos/'.$config->logo);
        }
    
        $config->delete();

        return redirect()->route('admin.config.index')->with('info','La categoría se eliminó con éxito');
    }
}
