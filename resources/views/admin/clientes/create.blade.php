@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">

        <div class="row">
            <h1>Registro de nueva clientes</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los Datos</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.clientes.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombres">Nombres </label><b>*</b>
                                        <input type="text" class="form-control" name="nombres"
                                            value="{{ old('nombres') }}" required>
                                        @error('nombres')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos </label><b>*</b>
                                        <input type="text" class="form-control" name="apellidos"
                                            value="{{ old('apellidos') }}" required>
                                        @error('apellidos')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cc">Cc </label><b>*</b>
                                        <input type="text" class="form-control" name="cc"
                                            value="{{ old('cc') }}" required>
                                        @error('cc')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nro_seguro">Nro seguro </label><b>*</b>
                                        <input type="text" class="form-control" name="nro_seguro"
                                            value="{{ old('nro_seguro') }}" required>
                                        @error('nro_seguro')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de nacimiento </label><b>*</b>
                                        <input type="date" class="form-control" name="fecha_nacimiento"
                                            value="{{ old('fecha_nacimiento') }}" required>
                                        @error('fecha_nacimiento')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="celular">Celular </label><b>*</b>
                                        <input type="number" class="form-control" name="celular"
                                            value="{{ old('celular') }}" required>
                                        @error('celular')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="genero">Género </label><b>*</b>
                                        <select name="genero" id="" class="form-control" name="genero">
                                            <!-- Opción por defecto -->
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        </select>
                                        @error('genero')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo">Correo </label><b>*</b>
                                        <input type="email" class="form-control" name="correo"
                                            value="{{ old('correo') }}" required>
                                        @error('correo')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="direccion">Direccion </label><b>*</b>
                                        <input type="address" class="form-control" name="direccion"
                                            value="{{ old('direccion') }}" required>
                                        @error('direccion')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="grupo_sanguineo">Grupo sanguineo</label><b>*</b>
                                        <select name="grupo_sanguineo" id="" class="form-control"
                                            name="grupo_sanguineo">
                                            <!-- Opción por defecto -->
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>

                                        @error('grupo_sanguineo')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="alergias">Alergias</label><b>*</b>
                                        <input type="text" class="form-control" name="alergias"
                                            value="{{ old('alergias') }}" required>
                                    </div>
                                    @error('alergias')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contacto_emergencia">Contacto Emergencia</label><b>*</b>
                                        <input type="text" class="form-control" name="contacto_emergencia"
                                            value="{{ old('contacto_emergencia') }}" required>
                                    </div>
                                    @error('contacto_emergencia')
                                        <small class="bg-danger text-white p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">Contrasena </label><b>*</b>
                                        <input type="password" class="form-control" name="password"
                                            value="{{ old('password') }}" required>
                                        @error('password')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password_confirmation">Verificacion de contrasena </label><b>*</b>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}" required>
                                        @error('password_confirmation')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <input type="text" class="form-control" name="observaciones"
                                            value="{{ old('observaciones') }}" required>
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>
            </div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">
                        Cancelar
                        {{-- <i class="fa-solid fa-plus"></i> --}}
                    </a>
                    <button type="submit" class="btn btn-primary">Registrar cliente</button>
                </div>
            </div>
        </div>
        </form>
    </div>
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
