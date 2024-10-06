@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
@stop
@section('content_header')
    <h1>Listado de reservas</h1>
@stop

@section('content')
        <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reservas registradas</h3>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="reservas" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Profesor</th>
                                <th>Especialidad</th>
                                <th>Fecha de reserva</th>
                                <th>Hora de inicio</th>
                                <th>Hora de fin</th>
                                <th>Fecha y hora de registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($eventos as $evento)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $evento->profesor->nombres." ".$evento->profesor->apellidos }}</td>
                                    <td scope="row" class="text-center">{{ $evento->profesor->especialidad }}</td>
                                    <td scope="row" class="text-center">{{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d') }}</td>
                                    <td scope="row" class="text-center">{{ \Carbon\Carbon::parse($evento->start)->format('H:i') }}</td>
                                    <td scope="row" class="text-center">{{ \Carbon\Carbon::parse($evento->end)->format('H:i') }}</td>
                                    <td scope="row" class="text-center">{{ $evento->created_at }}</td>
                                    <td scope="row">
                                        {{-- <a href=""  class="btn btn-info btn-sm">Ver</a> --}}
                                        <div class="btn-group" role="group" aria-label="basic example">
                                            <form action="{{ route('admin.eventos.destroy', $evento->profesor->id)}}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este curso?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
  <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>

    <!-- Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.colVis.min.js"></script>
    <script>
        
        new DataTable('#reservas', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis' // Botones que aparecen en la imagen
            ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ reservas",
                "infoEmpty": "Mostrando 0 a 0 de 0 reservas",
                "infoFiltered": "(filtrado de _MAX_ reservas totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ reservas",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "orderable": "Ordenar por esta columna",
                    "orderableReverse": "Invertir el orden de esta columna"
                }
            }

        });
        @if (session('info') && session('icono'))
            Swal.fire({
                title: "Good job!",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        @endif
        </script>
@stop
