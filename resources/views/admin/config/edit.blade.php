    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
        <h1>Sistema de reservas </h1>
    @stop

    @section('content')

        <div class="row">
            <h1>Modificacion configuracion</h1>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.config.update', $config->id) }}" method="POST" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de la Clínica/Hospital</label><b>*</b>
                                        <input type="text" class="form-control" name="nombre"
                                            value="{{ $config->nombre }}" required>
                                        @error('nombre')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label><b>*</b>
                                        <input type="text" class="form-control" name="direccion"
                                            value="{{ $config->direccion }}" required>
                                        @error('direccion')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label><b>*</b>
                                        <input type="number" class="form-control" name="telefono"
                                            value="{{ $config->telefono }}" required>
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
                                        <input type="email" class="form-control" name="correo"
                                            value="{{ $config->correo }}" required>
                                        @error('correo')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="logo">Logo</label><b>*</b>
                                        <!-- Campo para subir un nuevo logo -->
                                        <input type="file" id="file" class="form-control" name="logo">v>
                                        <!-- Mostrar el error si hay problemas con la carga de la imagen -->
                                        @error('logo')
                                            <small class="bg-danger text-white p-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- Mostrar la imagen actual si existe -->
                                        @if ($config->logo)
                                            <div class="mb-3 text-center">
                                                <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo actual"
                                                    width="150" class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">
                                            Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

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