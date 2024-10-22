@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
@stop

@section('content_header')
    <h1>Sistema de reservas</h1>
@stop

@section('content')
<div class="container">
    <h1>Horarios de Pico y Placa</h1>
    <button class="btn btn-primary" data-toggle="modal" data-target="#createPicoyPlacaModal">Agregar Horario</button>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>Día</th>
                <th>Horario</th>
                <th>Placas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($picoyplaca as $dia => $items)
                <tr>
                    <td>{{ $dia }}</td>
                    <td>
                        @foreach ($items as $item)
                            <div>{{ $item->horario }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($items as $item)
                            <div>{{ $item->placa }}</div>
                        @endforeach
                    </td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editPicoyPlacaModal{{ $items[0]->id }}">Editar</button>
                        <form action="{{ route('admin.picoyplaca.destroy', $items[0]->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $items[0]->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $items[0]->id }})">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editPicoyPlacaModal{{ $items[0]->id }}" tabindex="-1" role="dialog" aria-labelledby="editPicoyPlacaModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPicoyPlacaModalLabel">Editar Horario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.picoyplaca.update', $items[0]->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="dia">Día</label>
                                        <input type="text" class="form-control" name="dia" value="{{ $dia }}" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="horario">Horario</label>
                                        <input type="text" class="form-control" name="horario" value="{{ $items[0]->horario }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="placa">Placa</label>
                                        <input type="text" class="form-control" name="placa" value="{{ $items[0]->placa }}" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Crear -->
<div class="modal fade" id="createPicoyPlacaModal" tabindex="-1" role="dialog" aria-labelledby="createPicoyPlacaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPicoyPlacaModalLabel">Agregar Horario de Pico y Placa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.picoyplaca.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="dia">Día</label>
                        <input type="text" class="form-control" name="dia" required>
                    </div>
                    <div class="form-group">
                        <label for="horario">Horario</label>
                        <input type="text" class="form-control" name="horario" required>
                    </div>
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" name="placa" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.colVis.min.js"></script>
    
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción eliminará el registro.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    @if (session('info') && session('icono'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        </script>
    @endif
@stop
