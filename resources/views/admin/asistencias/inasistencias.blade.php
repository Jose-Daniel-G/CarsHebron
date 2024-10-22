@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>
        Clientes con Penalidades</h2>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
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
                        <tr>
                            <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
                            <td>{{ $cliente->nombre_evento }}</td>
                            <td>{{ $cliente->date }}</td>
                            <td>{{ $cliente->start . ' ' . $cliente->end }}</td>
                            <td><i
                                    class="{{ $cliente->asistio ? 'text-success bi bi-check-circle-fill' : 'text-danger bi bi-x-circle-fill' }}"></i>
                            </td>
                            <td>{{ $cliente->asistio ? '' : $cliente->cant_horas . ' horas' }}</td>
                            <td>{{ $cliente->asistio ? '' : $cliente->penalidad . ' horas' }}</td>
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
                                    <form action="{{ route('asistencia.habilitar', $cliente->id) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="form-control btn btn-success">Habilitar Cliente</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
