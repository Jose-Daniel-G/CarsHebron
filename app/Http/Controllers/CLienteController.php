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

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        // Asignar el `user_id` en los datos validados
        $validatedData['user_id'] = $usuario->id;
        // Si no se ingresa un password, se utiliza el valor de `cc`
        $validatedData['password'] = $validatedData['password'] ?? $validatedData['cc'];

        // Crear un nuevo Cliente
        $Cliente = new Cliente();
        $Cliente->fill($validatedData); // Asignación masiva
        $Cliente->save();
        // $usuario->assignRole('Cliente');

        return redirect()->route('admin.clientes.index')
            ->with('info', 'Se registro al Cliente de forma correcta')
            ->with('icono', 'success');
    }

    public function show(Cliente $Cliente)
    {
        return view('admin.clientes.show', compact('Cliente'));
    }

    public function edit(Cliente $cliente)
    {
        // $historial = Historial::all();
        // return view('admin.clientes.edit', compact('historial', 'cliente'));
        return view('admin.clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'cc' => 'required|unique:clientes,cc,' . $cliente->id,
            'nro_seguro' => 'required|unique:clientes,nro_seguro,' . $cliente->id,
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'celular' => 'required',
            'correo' => 'required|email|max:250|unique:clientes,correo,' . $cliente->id,
            'direccion' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required',
        ]);
    
        // Si el checkbox está marcado, restablecemos la contraseña
        if ($request->has('reset_password')) {
            // Restablecer la contraseña a la cédula
            $usuario = User::find($cliente->user_id);
            $usuario->password = Hash::make($request->cc); // Establecer la contraseña a la cédula
            $usuario->save();
        }
    
        // Actualizar los datos del Cliente existente
        $cliente->fill($validatedData); // Asignación masiva
        $cliente->save(); // Guardar los cambios
    
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
