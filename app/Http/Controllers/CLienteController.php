<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Curso;
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
        // Obtener todos los cursos disponibles
        $cursos = Curso::all();
        return view('admin.clientes.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
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
            'contacto_emergencia' => 'required|max:11',
        ]);

        try {


            $usuario = User::create(['name' => $request->nombres, 'email' => $request->correo, 'password' =>  Hash::make($request->password ?? $request->cc),]);

            // Asignar rol de 'cliente' al usuario
            $usuario->assignRole('cliente');

            // Asignar el `user_id` en los datos validados
            $validatedData['user_id'] = $usuario->id;

            // Crear un nuevo Cliente
            $cliente = Cliente::create($validatedData);

            // Asignar los cursos seleccionados al cliente
            $cliente->cursos()->sync($request->cursos);

            return redirect()->route('admin.clientes.index')
                ->with('title', 'Exito')
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



    public function show(Cliente $cliente)
    {
        return view('admin.clientes.show', compact('cliente'));
    }


    public function edit(Cliente $cliente)
    {
        // Cargar todos los cursos disponibles
        $cursos = Curso::all();

        // Obtener los IDs de los cursos ya asignados al cliente
        $cursosSeleccionados = $cliente->cursos->pluck('id')->toArray();

        return view('admin.clientes.edit', compact('cliente', 'cursos', 'cursosSeleccionados'));
        // $historial = Historial::all();
        // return view('admin.clientes.edit', compact('historial', 'cliente'));
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
            'contacto_emergencia' => 'required',
        ]);

        // Si el checkbox está marcado, restablecemos la contraseña
        if ($request->has('reset_password')) {
            // Restablecer la contraseña a la cédula
            $usuario = User::find($cliente->user_id); //dd($cliente->user_id);
            $usuario->password = Hash::make($request->cc); // Establecer la contraseña a la cédula
           
            $usuario->save();
        }

        // Actualizar los datos del Cliente y guardar en la base de datos en una sola línea
        $cliente->update($validatedData);

        // Actualizar los cursos asignados al cliente
        $cliente->cursos()->sync($request->cursos ?? []); // Sincroniza los cursos seleccionados en el formulario

        return redirect()->route('admin.clientes.index')
            ->with('title', 'Exito')
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
            ->with('title', 'Exito')
            ->with('info', 'El Cliente se eliminó con éxito')
            ->with('icono', 'success');
    }
}
