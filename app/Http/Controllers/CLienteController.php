<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('user')->get(); // viene con la relacion del Cliente
        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('admin.clientes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'cc' => 'required',
            'nro_seguro' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'celular' => 'required',
            'correo' => 'required|email|max:250|unique:Clientes',
            'direccion' => 'required',
            'grupo_sanguineo' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required',
        ]);
        // Crear un nuevo Cliente
        $Cliente = new Cliente();
        $Cliente->fill($validatedData); // Asignación masiva
        $Cliente->save();
        // $usuario->assignRole('Cliente');

        return redirect()->route('admin.Clientes.index')
            ->with('info', 'Se registro al Cliente de forma correcta')
            ->with('icono', 'success');
    }

    public function show(Cliente $Cliente)
    {
        return view('admin.clientes.show', compact('Cliente'));
    }

    public function edit(Cliente $Cliente)
    {
        // $historial = Historial::all();
        $Clientes = Cliente::orderBy('apellidos', 'asc')->get();
        // return view('admin.clientes.edit', compact('historial', 'Clientes'));
        return view('admin.clientes.edit', compact('Cliente'));
    }

    public function update(Request $request, Cliente $Cliente)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'cc' => 'required|unique:Clientes,cc,' . $Cliente->id,
            'nro_seguro' => 'required|unique:Clientes,nro_seguro,' . $Cliente->id,
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'celular' => 'required',
            'correo' => 'required|email|max:250|unique:Clientes,correo,' . $Cliente->id,
            'direccion' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required',
        ]);
    
        // Actualizar los datos del Cliente existente
        $Cliente->fill($validatedData); // Asignación masiva
        $Cliente->save(); // Guardar los cambios
    
        return redirect()->route('admin.clientes.index')
            ->with('info', 'Cliente actualizado correctamente.')
            ->with('icono', 'success');
    }
    

    public function destroy(Cliente $Cliente)
    {
        // Verificar si el Cliente tiene un usuario asociado
        if ($Cliente->user) {
            // Si existe un usuario asociado, eliminarlo
            $Cliente->user->delete();
        }
    
        // Eliminar el Cliente
        $Cliente->delete();
    
        return redirect()->route('admin.clientes.index')
            ->with('info', 'El Cliente se eliminó con éxito')
            ->with('icono', 'success');
    }
    
}
