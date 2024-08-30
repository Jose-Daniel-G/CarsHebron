<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $curso = new Curso();
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->horas_requeridas = $request->horas_requeridas;
        $curso->save();

        return redirect()->route('cursos.index');
    }

    public function edit($id)
    {
        $curso = Curso::find($id);
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->horas_requeridas = $request->horas_requeridas;
        $curso->save();

        return redirect()->route('cursos.index');
    }

    public function destroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();

        return redirect()->route('cursos.index');
    }
}
