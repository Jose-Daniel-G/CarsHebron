<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all(); // viene con la relacion del curso
        return view('admin.cursos.index', compact(('cursos')));
    }

    public function create()
    {
        return view('admin.cursos.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'capacidad' => 'required',
            'especialidad' => 'required',
            'estado' => 'required',
        ]);
        // Crear un nuevo curso
        Curso::create($request->all());

        return redirect()->route('admin.cursos.index')
            ->with('info', 'Se registro el curso de forma correcta')
            ->with('icono', 'success');
    }

    public function show(Curso $curso)
    {
        return view('admin.cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        return view('admin.cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        // dd($request->all());
        // Validación de los datos
        $validatedData = $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'capacidad' => 'required',
            'especialidad' => 'required',
            'estado' => 'required',
        ]);
    
        // Actualizar los datos del curso existente
        $curso->update($request->all()); // Actualizar el registro específico
    
        return redirect()->route('admin.cursos.index')
            ->with('info', 'Curso actualizado correctamente.')
            ->with('icono', 'success');
    }
    

    public function destroy(Curso $curso)
    {
        // Verificar si el curso tiene un usuario asociado
        if ($curso->user) {
            // Si existe un usuario asociado, eliminarlo
            $curso->user->delete();
        }
    
        // Eliminar el curso
        $curso->delete();
    
        return redirect()->route('admin.cursos.index')
            ->with('info', 'El curso se eliminó con éxito')
            ->with('icono', 'success');
    }
    
}
