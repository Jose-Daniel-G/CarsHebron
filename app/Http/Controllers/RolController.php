<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $rol = new Rol();
        $rol->nombre = $request->nombre;
        $rol->save();

        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $rol = Rol::find($id);
        return view('roles.edit', compact('rol'));
    }

    public function update(Request $request, $id)
    {
        $rol = Rol::find($id);
        $rol->nombre = $request->nombre;
        $rol->save();

        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $rol = Rol::find($id);
        $rol->delete();

        return redirect()->route('roles.index');
    }
}
