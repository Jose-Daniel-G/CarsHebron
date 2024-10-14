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
                        <form action="{{ route('admin.config.store') }}" method="POST" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_name">Nombre del sitio</label>
                                <input type="text" class="form-control" name="site_name" value="{{ old('site_name') }}"
                                    required>
                                @error('site_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                    required>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="number" class="form-control" name="phone" value="{{ old('telefono') }}"
                                    required>
                                @error('telefono')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email_contact">Correo de contacto</label>
                                <input type="email" class="form-control" name="email_contact"
                                    value="{{ old('email_contact') }}" required>
                                @error('email_contact')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo</label><b>*</b>
                                <input type="file" id="file" class="form-control" name="logo" required>
                                <div class="text-center"><output id="list"></output></div>
                                @error('logo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.config.index') }}" class="btn btn-secondary">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">Registrar configuracion</button>
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
