<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\UsuarioController;

// use App\Http\Controllers\UsuarioController;
// use App\Http\Controllers\ClaseController;
// use App\Http\Controllers\CursoController;

Route::get("/", [HomeController::class, "index"])->name("admin.home")->middleware('can:admin.home');
Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->names('admin.users');

// Route::resource('cursos', CursoController::class)->names('admin.cursos');
// Route::resource('clases', ClaseController::class)->names('admin.clases');

//RUTAS ADMIN
Route::get('/admin', [HomeController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/ver_reservas/{id}', [HomeController::class, 'ver_reservas'])->name('admin.ver_reservas')->middleware('auth','can:admin.ver_reservas');


//RUTAS USUARIOS ADMIN
Route::resource('/usuarios', UsuarioController::class)->names('admin.usuarios')->middleware('auth', 'can:admin.usuarios');

//RUTAS CONFIGURACIONES ADMIN
Route::resource('/config', ConfigController::class)->names('admin.config')->middleware('auth', 'can:admin.config');

//RUTAS SECRETARIAS ADMIN
Route::resource('/secretarias', SecretariaController::class)->names('admin.secretarias')->middleware('auth', 'can:admin.secretarias');

//RUTAS AgendarS ADMIN
Route::resource('/clientes', ClienteController::class)->names('admin.clientes')->middleware('auth', 'can:admin.clientes');

//RUTAS CURSOS ADMIN
Route::resource('/cursos', CursoController::class)->names('admin.cursos')->middleware('auth', 'can:admin.cursos');

//RUTAS REPORTES DOCTORES ADMIN
Route::get('/profesores/pdf/{id}', [ProfesorController::class, 'reportes'])->name('admin.profesores.pdf');
// ->middleware('auth', 'can:admin.profesores.pdf');
Route::get('/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes')->middleware('auth', 'can:admin.profesores.reportes');
Route::resource('/profesores', ProfesorController::class)->names('admin.profesores')->parameters(['profesores' => 'profesor'])->middleware('auth', 'can:admin.profesores');


// Route::resource('/events/create', EventController::class)->names('admin.events');
// Route::get('events/mostrar', [EventController::class, 'show'])->name('admin.events.show');// This isn't working is an example

//RUTAS PARA LOS EVENTOS
Route::resource('/eventos', EventController::class)->names('admin.eventos');

//RUTAS para las reservas
Route::get('/reservas/reportes', [EventController::class, 'reportes'])->name('admin.reservas.reportes')->middleware('auth', 'can:admin.reservas.reportes');
Route::get('/reservas/pdf/{id}', [EventController::class, 'pdf'])->name('admin.reservas.pdf')->middleware('auth', 'can:admin.reservas.pdf');
Route::get('/reservas/pdf_fechas', [EventController::class, 'pdf_fechas'])->name('admin.reservas.pdf_fechas')->middleware('auth', 'can:admin.event.pdf_fechas');

//RUTAS para el historial clinico
Route::get('/historial/pdf',[HistorialController::class,'pdf'])->name('admin.historial.pdf')->middleware('auth', 'can:admin.historial');
Route::resource('/historial', HistorialController::class)->names('admin.historial')->middleware('auth', 'can:admin.historial');


// Route::post('events/editar/{id}', [EventController::class, 'edit'])->name('admin.events.edit');
// Route::put('events/actualizar/{evento}', [EventController::class, 'update'])->name('admin.events.update');
// Route::post('events/actualizar/{evento}', [EventController::class, 'edit'])->name('admin.events.update');
// Route::delete('events/eliminar/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');
// Route::post('events/agregar', [EventController::class, 'store'])->name('admin.events.store');

// Route::group(['middleware'=>['auth']], function(){
    Route::get('events', [EventController::class, 'index'])->name('admin.events.index');
    Route::get('events/mostrar', [EventController::class, 'show'])->name('admin.events.show');
    // Route::post('events/editar/{id}', [EventController::class, 'edit'])->name('admin.events.edit');
    // Route::put('events/actualizar/{evento}', [EventController::class, 'update'])->name('admin.events.update');

    // Route::post('events/actualizar/{evento}', [EventController::class, 'edit'])->name('admin.events.update');
    // Route::delete('events/eliminar/{id}', [EventController::class, 'destroy'])->name('admin.events.destroy');
    Route::post('events/agregar', [EventController::class, 'store'])->name('admin.events.store');

// });
