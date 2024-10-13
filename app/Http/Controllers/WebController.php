<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Event;
use App\Models\Horario;
use App\Models\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {

        $cursos = Curso::all();
        return view('index', compact('cursos'));
    }

    // public function show_datos_cursos($id)
    // {
    //     $curso = Curso::find($id);
    //     try {
    //         $horarios = Horario::with('profesor', 'curso')->where('curso_id', $id)->get();
    //         return view('show_datos_cursos', compact('horarios','curso'));
    //     } catch (\Exception $exception) {
    //         return response()->json(['mesaje' => 'Error']);
    //     }
    // }

    // public function show_reserva_profesores($id)
    // { //echo $id;
    //     try { 
    //         $events = Event::where('profesor_id', $id)->get();
    //                 // ->select('id','title', DB::raw('DATE_FORMAT(start, %Y-%m-%d) as start'),DB::raw('DATE_FORMAT(end, %Y-%m-%d) as end'),'color')
    //                 // ->get();
    //         return response()->json($events);
    //     } catch (\Exception $exception) {
    //         return response()->json(['mesaje' => 'Error']);
    //     }
    // }

    public function show(Web $web)
    {
        //
    }

    public function edit(Web $web)
    {
        //
    }

    public function update(Request $request, Web $web)
    {
        //
    }

    public function destroy(Web $web)
    {
        //
    }
}
