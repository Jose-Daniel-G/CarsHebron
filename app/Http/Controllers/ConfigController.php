<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function index()
    {
        // $configs = Config::first(); // Obtén la primera fila de la tabla de configuración
        $configs = Config::all(); // Obtén la primera fila de la tabla de configuración
        return view('admin.config.index', compact('configs'));
    }

    public function create()
    {
        return view('admin.config.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validación de los datos
        $request->validate([
            'site_name'    => 'required|string',
            'email_contact'    => 'required|email',
            'address' => 'required|string|max:255',
            'phone'  => 'required|numeric',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        // Crear una nueva instancia del modelo Config
        $config = new Config();
        $config->site_name = $request->input('site_name');
        $config->email_contact = $request->input('email_contact');
        $config->address = $request->input('address');
        $config->phone = $request->input('phone');

        // Manejo de archivo logo si se ha subido
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $config->logo = $logoPath;
        }

        // Guardar la nueva configuración
        $config->save();

        return redirect()->route('admin.config.index')->with('title', 'Exito')
                                                      ->with('info', 'Configuración creada')->with('icono', 'success');
    }

    public function edit(Config $config)
    {
        return view('admin.config.edit', compact('config'));
    }

    public function update(Request $request, Config $config)
    {
        // Validación de los datos
        $request->validate([
            'site_name'    => 'required|string',
            'email_contact'    => 'required|email',
            'address' => 'required|string|max:255',
            'phone'  => 'required|numeric',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        // Asignación de los datos al modelo
        $config->site_name = $request->input('site_name');
        $config->email_contact = $request->input('email_contact');
        $config->address = $request->input('address');
        $config->phone = $request->input('phone');

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

        return redirect()->route('admin.config.index')->with('title', 'Exito')
        ->with('icono', 'success')->with('info', 'Configuración actualizada exitosamente');
    }

    public function destroy(Config $config)
    {
        // Eliminar el logo si existe
        if (Storage::exists('logos/' . $config->logo)) {
            Storage::delete('logos/' . $config->logo);
        }

        // Eliminar la configuración
        $config->delete();

        return redirect()->route('admin.config.index')->with('title', 'Exito')
        ->with('icono', 'success')->with('info', 'Configuración eliminada correctamente');
    }
}
