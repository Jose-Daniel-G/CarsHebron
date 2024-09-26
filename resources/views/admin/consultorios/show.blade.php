@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Curso: {{ $curso->nombre }} {{ $curso->ubicacion }}</h1>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos registrados</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.cursos.update', $curso->id) }}" method="POST"
                            autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del curso </label><b>*</b>
                                        <p>
                                            {{ $curso->nombre }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="ubicacion">Ubicacion </label><b>*</b>
                                        <p>
                                            {{ $curso->ubicacion }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="capacidad">Capacidad </label><b>*</b>
                                        <p>
                                            {{ $curso->capacidad }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Telefono </label><b>*</b>
                                        <p>
                                            {{ $curso->telefono }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="especialidad">Especialidad </label><b>*</b>
                                        <p>
                                            {{ $curso->especialidad }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado">Estado </label><b>*</b>
                                            <!-- Opción por defecto -->
                                            <p>{{ $curso->estado == 'A' ? 'Activo' : 'Inactivo' }}</p>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">
                                            Regresar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')

@stop

@section('js')

@stop
