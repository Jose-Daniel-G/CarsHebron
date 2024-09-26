@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1>Registro de una nueva configuración</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Llene los Datos</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.config.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de la Clínica/Hospital</label><b>*</b>
                                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                                        @error('nombre')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label><b>*</b>
                                        <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                                        @error('direccion')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label><b>*</b>
                                        <input type="number" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                                        @error('telefono')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo">Correo</label><b>*</b>
                                        <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" required>
                                        @error('correo')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="logo">Logo</label><b>*</b>
                                        <input type="file" id="file" class="form-control" name="logo" required>
                                        <div class="text-center"><output id="list"></output></div>
                                        @error('logo')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.config.index') }}" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary">Registrar configuracion</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('file').addEventListener('change', function(evt) {
                var files = evt.target.files; // FileList object
                if (files.length > 0) {
                    var file = files[0]; // Tomamos el primer archivo seleccionado
                    if (!file.type.match('image.*')) {
                        alert("Solo se permiten archivos de imagen.");
                        return;
                    }

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById("list").innerHTML = 
                            `<img class="thumb thumbnail" src="${e.target.result}" width="100%" title="${file.name}"/>`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@stop
