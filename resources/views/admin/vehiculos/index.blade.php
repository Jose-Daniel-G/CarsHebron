@extends('adminlte::page')

@section('title', 'DeveloTech')

@section('content_header')
    <h1>Lista de Vehículos</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
    @endif
    <!-- Mostrar errores si existen -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" data-toggle="modal" data-target="#createVehiculoModal">Agregar Vehículo</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Modelo</th>
                        <th>Placa</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                        <tr>
                            <td>{{ $vehiculo->id }}</td>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->placa }}</td>
                            <td width="10px">
                                <!-- Botón de edición con los datos del vehículo -->
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editVehiculoModal"
                                    data-id="{{ $vehiculo->id }}" 
                                    data-modelo="{{ $vehiculo->modelo }}"
                                    data-placa="{{ $vehiculo->placa }}"
                                    data-tipo="{{ $vehiculo->tipo }}">Editar</a>
                            </td>
                            <td width="10px">
                                <form id="delete-form-{{ $vehiculo->id }}" action="{{ route('admin.vehiculos.destroy', $vehiculo->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $vehiculo->id }})">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modales para crear y editar vehículos -->
    @include('admin.vehiculos.create')
{{--     @include('admin.vehiculos.edit') --}}

@endsection

    @section('js')
    <script>
        $(document).ready(function() {
            // Llenar el modal de edición con los datos del vehículo seleccionado
            $('#editVehiculoModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que disparó el modal
                var id = button.data('id'); // Extraer el ID del vehículo
                var name = button.data('name'); // Extraer el nombre del vehículo
                var modelo = button.data('modelo'); // Extraer el modelo del vehículo
                var placa = button.data('placa'); // Extraer la placa del vehículo
                var tipo = button.data('tipo'); // Extraer el tipo de vehículo

                // Actualizar la acción del formulario con el ID del vehículo
                var form = $('#editVehiculoForm');
                var action = form.attr('action').replace(':id', id);
                form.attr('action', action);

                // Rellenar los campos del modal con los datos del vehículo
                $('#editVehiculoNombre').val(name);
                $('#editVehiculoModelo').val(modelo);
                $('#editVehiculoTipo').val(tipo);

                // Mostrar la placa en el campo de texto y actualizar el campo oculto
                $('#editVehiculoPlaca').val(placa); // Mostrar la placa al usuario
                $('#placa').val(placa); // Asegurarse de que el valor de la placa se envía
            });
        });
    </script>

@endsection