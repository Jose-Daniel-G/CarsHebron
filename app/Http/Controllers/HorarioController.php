<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Horario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class HorarioController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        $horarios = Horario::with('profesor', 'curso')->get(); // viene con la relacion del horario
        return view('admin.horarios.index', compact('horarios', 'cursos'));
    }

    public function create()
    {
        $profesores = Profesor::all();
        $cursos = Curso::all();
        $horarios = Horario::with('profesor', 'curso')->get(); // viene con la relacion del horario

        return view('admin.horarios.create', compact('profesores', 'cursos', 'horarios'));
    }
    public function cargar_datos_cursos($id)
    { 
        // echo $id;   
      
        try {
            $horarios = Horario::with('profesor', 'curso')->where('curso_id', $id)->get();
            return view('admin.horarios.cargar_datos_cursos', compact('horarios'));
        } catch (\Exception $exception) {
            return response()->json(['mesaje' => 'Error']);
        }
    }


    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);
        // Verificar si el horario ya existe para ese día, rango de horas y curso
        $horarioExistente = Horario::where('dia', $request->dia)
            ->where('curso_id', $request->curso_id) // Filtrar por curso
            ->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('hora_inicio', '>=', $request->hora_inicio) 
                        ->where('hora_inicio', '<', $request->hora_fin);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('hora_fin', '>', $request->hora_inicio)
                        ->where('hora_fin', '<=', $request->hora_fin);
                })
                ->orWhere(function ($query) use ($request) {
                    $query->where('hora_inicio', '<', $request->hora_inicio)
                        ->where('hora_fin', '>', $request->hora_fin);
                });
            })
            ->exists();

        // Si ya existe un horario en ese rango, regresar con un mensaje de error
        if ($horarioExistente) {
            return redirect()->back()
                ->withInput()
                ->with('mensaje', 'Ya existe un horario que se superpone con el horario ingresado')
                ->with('icono', 'error');
        }

        // Crear el nuevo horario
        Horario::create($request->all());

        // Redirigir a la lista de horarios con un mensaje de éxito
        return redirect()->route('admin.horarios.create')
            ->with('info', 'Se registró el horario de forma correcta')
            ->with('icono', 'success');
    }


    public function show(Horario $horario)
    {
        $horario = $horario->with('profesor', 'curso')->get();
        return view('admin.horarios.show', compact('horario'));
    }

    public function edit(Horario $horario)
    {
        // Obtener el curso relacionado con el horario
        $curso = $horario->curso;
        $profesores = Profesor::all();
        $cursos = Curso::all();

        return view('admin.horarios.edit', compact('horario', 'curso', 'profesores', 'cursos'));
    }

    public function update(Request $request, Horario $horario)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        // Crea el nuevo horario
        $horario->update($request->all());


        return redirect()->route('admin.horarios.index')
            ->with('info', 'Horario actualizado correctamente.')
            ->with('icono', 'success');
    }


    public function destroy(Horario $horario)
    {

        // Eliminar el horario
        $horario->delete();

        return redirect()->route('admin.horarios.index')
            ->with('info', 'El horario se eliminó con éxito')
            ->with('icono', 'success');
    }
}
