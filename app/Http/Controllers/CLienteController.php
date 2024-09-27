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
            'cc' => 'required|max:11',
            'nro_seguro' => 'required|max:11',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'celular' => 'required|max:11',
            'correo' => 'required|email|max:250|unique:clientes',
            'direccion' => 'required',
            'grupo_sanguineo' => 'required',
            'alergias' => 'required',
            'contacto_emergencia' => 'required|max:11',
        ]);
    
        try {
            $usuario = User::create(['name' => $request->nombres,'email' => $request->correo,'password' => Hash::make($request->password),]);
    
            // Asignar rol de 'cliente' al usuario
            $usuario->assignRole('cliente');
    
            // Asignar el `user_id` en los datos validados
            $validatedData['user_id'] = $usuario->id;
    
            // Crear un nuevo Cliente
            Cliente::create($validatedData);
    
            return redirect()->route('admin.clientes.index')
                ->with('info', 'Se registró al Cliente de forma correcta')
                ->with('icono', 'success');

        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // Código de error para entrada duplicada
                return back()->withErrors(['correo' => 'El correo ya está en uso. Por favor, utiliza otro.'])
                    ->withInput();
            }
            // Manejo de otros errores si es necesario
            return back()->withErrors(['error' => 'Ocurrió un error inesperado.'])
                ->withInput();
        }
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
