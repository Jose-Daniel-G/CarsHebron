<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Profesor;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::with('user')->get(); // viene con la relacion del profesor
        return view('admin.profesores.index', compact(('profesores')));
    }

    public function create()
    {
        return view('admin.profesores.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'licencia_medica' => 'required',
            'especialidad' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'nullable|max:255|confirmed',
        ]);
        
        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        // Crear un nuevo profesor
        $data = $request->all();
        $data['user_id'] = auth()->id();

        // Crea el nuevo profesor
        Profesor::create($data);
        $usuario->assignRole('profesor');


        return redirect()->route('admin.profesores.index')
            ->with('info', 'Se registro el profesor de forma correcta')
            ->with('icono', 'success');
    }

    public function show(Profesor $profesor)
    {
        return view('admin.profesores.show', compact('profesor'));
    }

    public function edit(Profesor $profesor)
    {
        return view('admin.profesores.edit', compact('profesor'));
    }

    public function update(Request $request, Profesor $profesor)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'licencia_medica' => 'required',
            'especialidad' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'nullable|max:255|confirmed',
        ]);
        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        // acrualiza un nuevo profesor
        $data = $request->all();
        $data['user_id'] = auth()->id();

        // Crea el nuevo profesor
        $profesor->update($data);


        return redirect()->route('admin.profesores.index')
            ->with('info', 'Profesor actualizado correctamente.')
            ->with('icono', 'success');
    }


    public function destroy(Profesor $profesor)
    {
        // dd($profesor);
        if ($profesor->user) {
            $profesor->user->delete(); // Si el profesor tiene un usuario asociado, eliminarlo
        }

        // Eliminar el profesor
        $profesor->delete();

        return redirect()->route('admin.profesores.index')
            ->with('info', 'El profesor se eliminó con éxito')
            ->with('icono', 'success');
    }
    public function reportes()
    {
        return view('admin.profesores.reportes');
    }
    public function pdf($id)
    {
        $config = Config::latest()->first();
        $profesores = Profesor::all();
        // dd($profesores);
        $pdf = PDF::loadView('admin.profesores.pdf', compact('config', 'profesores'));

        // Incluir la numeración de páginas y el pie de página
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->email, null, 10, array(0, 0, 0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y') . " - " . \Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0, 0, 0));

        return $pdf->stream();
    }
}
