<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\HorarioController;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {return view('welcome');});
Route::get('/', function () {
    return redirect()->route('login'); // Redirige a la página de login
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
->group(function () {Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');});
// ->group(function () {Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});

//RUTAS HORARIOS ADMIN
Route::resource('/admin/horarios', HorarioController::class)->names('admin.horarios')->middleware('auth', 'can:admin.horarios');

//AJAX
Route::get('/curso/{id}', [WebController::class, 'cargar_datos_cursos'])->name('cargar_datos_cursos');
// ->middleware('auth','can:cargar_datos_cursos');
Route::get('/admin/horarios/cargar_reserva_profesores/{id}', [HomeController::class, 'cargar_reserva_profesores'])
     ->name('admin.horarios.cargar_reserva_profesores');
Route::get('/admin/ver_reservas/{id}', [HomeController::class, 'ver_reservas'])->name('admin.ver_reservas')->middleware('auth','can:admin.ver_reservas');
Route::get('/admin/horarios/curso/{id}', [HorarioController::class, 'cargar_datos_cursos'])->name('admin.horarios.cargar_datos_cursos')->middleware('auth');
// Route::get('/admin/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes');
