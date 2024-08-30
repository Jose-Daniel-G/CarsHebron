<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    public function index()
    {
        $clases = Clase::all();
        return view('clases.index', compact('clases'));
    }

    public function create()
    {
        return view('clases.create');
    }

    public function store(Request $request)
    {
        $clase = new Clase();
        $clase->alumno_id = $request->alumno_id;
        $clase->profesor_id = $request->profesor_id;
        $clase->vehiculo_id = $request->vehiculo_id;
        $clase->curso_id = $request->curso_id;
        $clase->fecha_hora = $request->fecha_hora;
        $clase->duracion = $request->duracion;
        $clase->estado = $request->estado;
        $clase->save();

        return redirect()->route('clases.index');
    }

    public function edit($id)
    {
        $clase = Clase::find($id);
        return view('clases.edit', compact('clase'));
    }

    public function update(Request $request, $id)
    {
        $clase = Clase::find($id);
        $clase->alumno_id = $request->alumno_id;
        $clase->profesor_id = $request->profesor_id;
        $clase->vehiculo_id = $request->vehiculo_id;
        $clase->curso_id = $request->curso_id;
        $clase->fecha_hora = $request->fecha_hora;
        $clase->duracion = $request->duracion;
        $clase->estado = $request->estado;
        $clase->save();

        return redirect()->route('clases.index');
    }

    public function destroy($id)
    {
        $clase = Clase::find($id);
        $clase->delete();

        return redirect()->route('clases.index');
    }
}
