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
                            <a class="btn btn-secondary" data-toggle="modal" data-target="#createVehiculoModal"><i
                                    class="bi bi-plus-circle-fill"></i></a>
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
                                    <td>{{ $vehiculo->profesor->nombres.' '.$vehiculo->profesor->apellidos }}</td>
                                    <td>
                                        <a href="{{ route('admin.vehiculos.show', $vehiculo->id) }}"
                                            class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning" data-id="{{ $vehiculo->id }}"
                                            data-toggle="modal" data-target="#editVehiculoModal">
                                            <i class="fas fa-edit"></i>
                                        </a>

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
$('#editVehiculoModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var modal = $(this); // Define modal como el modal actual
    var url = "{{ route('admin.vehiculos.edit', ':id') }}"; // Corrige la ruta aquí
    url = url.replace(':id', button.data('id')); // Reemplaza ':id' con el ID del vehículo

    // Hacer una solicitud AJAX para obtener los datos del vehículo
    $.ajax({
        url: url, // URL de la API o endpoint
        method: 'GET',
        success: function(data) {
            modal.find('#edit_vehiculo_id').val(data.vehiculo.id); // Asegúrate que 'data.vehiculo' tenga el ID
            modal.find('#placa').val(data.vehiculo.placa);
            modal.find('#modelo').val(data.vehiculo.modelo);
            modal.find('#disponible').val(data.vehiculo.disponible ? '1' : '0');
            modal.find('#tipo').val(data.vehiculo.tipo);
            modal.find('#picoyplaca_id').val(data.vehiculo.picoyplaca_id);
            modal.find('#profesor_nombres').val(data.vehiculo.profesor.nombres + ' ' + data.vehiculo.profesor.apellidos);
            
            var select1 = modal.find('#tipo_select'); // Asegúrate de que este es el ID de tu select
            select1.empty(); // Limpiar las opciones existentes

            // Asegúrate de que los valores coincidan con lo que esperas en data.vehiculo.tipo
            select1.append(new Option('Sedan', 'sedan'));
            select1.append(new Option('SUV', 'suv'));
            select1.append(new Option('Pickup', 'pickup'));
            select1.append(new Option('Hatchback', 'hatchback'));

            // Comprobar el valor que se va a establecer
            console.log('Valor a establecer en el select:', data.vehiculo.tipo); // Verificar valor
            select1.val(data.vehiculo.tipo); // Establecer el valor seleccionado
            // select1.change(); // Forzar el evento de cambio

                
            select = modal.find('#profesor_select'); // Asegúrate de que este es el ID de tu select
            select.empty(); // Limpiar las opciones existentes
            $.each(data.profesores, function(index, profesor) {
                select.append(new Option(profesor.nombres + ' ' + profesor.apellidos, profesor.id));
            });
            select.val(data.vehiculo.profesor_id); // Establecer el valor seleccionado
        },
        error: function(xhr) {
            console.error('Error al cargar los datos del vehículo:', xhr);
        }
    });
});

</script>
<script>
    function formatearPlaca(input) {
        let valor = input.value.replace(/-/g, ''); // Eliminar guiones existentes
        if (valor.length >= 3) {
            valor = valor.slice(0, 3) + '-' + valor.slice(3); // Agregar guion después de 3 caracteres
        }
        if (valor.length > 7) {
            valor = valor.slice(0, 7); // Limitar a 7 caracteres
        }
        input.value = valor.toUpperCase(); // Opcional: convertir a mayúsculas
    }
    </script>


@endsection
