@extends('adminlte::page')

@section('title', 'DeveloTech')

@section('content_header')
    <h1>Lista de Vehículos</h1>
@stop

@section('content')
    <!-- Mostrar errores si existen -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }}</strong>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- <div class="row">
        <h1>Listado de secretarias</h1>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Vehiculos registrados</h3>
                    <div class="card-tools">
                        <div class="card-header">
                            <a class="btn btn-secondary" data-toggle="modal" data-target="#createVehiculoModal"><i class="bi bi-plus-circle-fill"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Modelo</th>
                                <th>Disponible</th>
                                <th>Tipo</th>
                                <th>PicoyPlaca ID</th>
                                <th>Usuario ID</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->placa }}</td>
                                    <td>{{ $vehiculo->modelo }}</td>
                                    <td>{{ $vehiculo->disponible ? 'Sí' : 'No' }}</td>
                                    <td>{{ $vehiculo->tipo }}</td>
                                    <td>{{ $vehiculo->picoyplaca_id }}</td>
                                    <td>{{ $vehiculo->usuario_id }}</td>
                                    <td>
                                        <a href="{{ route('admin.vehiculos.show', $vehiculo->id) }}"
                                            class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                    </a>
                                        <a href="{{ route('admin.vehiculos.edit', $vehiculo->id) }}"
                                            class="btn btn-warning" data-toggle="modal" data-target="#editVehiculoModal"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.vehiculos.destroy', $vehiculo->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modales para crear y editar vehículos -->
    @include('admin.vehiculos.create')
    @include('admin.vehiculos.edit')

@endsection

@section('js')
    <script>
        // Escucha el evento cuando se abre el modal
        $('#editVehiculoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var id = button.data('id');
            var placa = button.data('placa');
            var modelo = button.data('modelo');
            var disponible = button.data('disponible');
            var tipo = button.data('tipo');
            var picoyplaca_id = button.data('picoyplaca_id');
            var usuario_id = button.data('usuario_id');

            var modal = $(this);
            modal.find('#editVehiculoForm').attr('action', '{{ url('admin/vehiculos') }}/' +
            id); // Establece la acción del formulario
            modal.find('#placa').val(placa);
            modal.find('#modelo').val(modelo);
            modal.find('#disponible').val(disponible ? '1' : '0');
            modal.find('#tipo').val(tipo);
            modal.find('#picoyplaca_id').val(picoyplaca_id);
            modal.find('#usuario_id').val(usuario_id);
        });
    </script>
@endsection
