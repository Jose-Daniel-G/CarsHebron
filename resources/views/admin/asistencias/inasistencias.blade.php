@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2> Clientes con Penalidades</h2>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Historial</h3>
                    <div class="card-tools">
                        {{-- <a href="{{ route('admin.') }}" class="btn btn-primary">Registrar <i class="fa-solid fa-plus"></i> --}}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="inasistencias" class="table table-striped table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Nombre del Cliente</th>
                                <th>Curso</th>
                                <th>Fecha</th>
                                <th>Hora Inicio y Fin</th>
                                <th>Asistio</th>
                                <th>Horas Penalizadas</th>
                                <th>Penalidad Total</th>
                                <th>liquidado</th>
                                <th>fecha de pago</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                            @if (!$cliente->asistio)
                                <tr>
                                    <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
                                    <td>{{ $cliente->nombre_evento }}</td>
                                    <td>{{ $cliente->date }}</td>
                                    <td>{{ $cliente->start . ' ' . $cliente->end }}</td>
                                    <td>
                                        <i class="text-danger bi bi-x-circle-fill"></i>
                                    </td>
                                    {{-- <td>
                                        <i class="{{ $cliente->asistio ? 'text-success bi bi-check-circle-fill' : 'text-danger bi bi-x-circle-fill' }}"></i>
                                    </td> --}}
                                    <td>{{ $cliente->asistio ? '' : $cliente->cant_horas . ' horas' }}</td>
                                    <td>{{ $cliente->asistio ? '' : $cliente->penalidad }}</td>
                                    <td>
                                        @if (!$cliente->asistio)
                                            <i
                                                class="{{ $cliente->liquidado ? 'text-success bi bi-check-circle-fill' : 'text-danger bi bi-x-circle-fill' }}"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$cliente->asistio)
                                            {{ $cliente->fecha_pago_multa }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$cliente->asistio)
                                            <form action="{{ route('asistencia.habilitar', $cliente->id) }}"
                                                method="POST">
                                                @csrf

                                                <button type="submit" class="form-control btn btn-success">Habilitar
                                                    Cliente</button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
<script>
            new DataTable('#inasistencias', {
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ profesores",
                "infoEmpty": "Mostrando 0 a 0 de 0 profesores",
                "infoFiltered": "(filtrado de _MAX_ profesores totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ profesores",
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
            },
            initComplete: function() {
                // Apply custom styles after initialization
                $('.dt-button').css({
                    'background-color': '#4a4a4a',
                    'color': 'white',
                    'border': 'none',
                    'border-radius': '4px',
                    'padding': '8px 12px',
                    'margin': '0 5px',
                    'font-size': '14px'
                });
            },
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    },
                    {
                        // text: '<i class="bi bi-file-pdf-fill"></i>',//NO SE ESTA VISUALIZANDO ICONO DE  BOOTSTRAP 4
                        extend: 'pdf'
                    }, {
                        extend: 'csv'
                    }, {
                        extend: 'excel'
                    }, {
                        text: 'Imprimir',
                        extend: 'print'
                    }
                ]
            }, ],

        });
</script>
@stop
