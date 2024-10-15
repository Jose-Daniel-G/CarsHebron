@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>Clientes con Penalidades</h2>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>Horas Penalizadas</th>
                        <th>Penalidad Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre.' '.$cliente->apellido }}</td>
                            <td>{{ $cliente->asistencias->where('asistio', false)->sum('evento.duracion') }} horas</td>
                            <td>${{ $cliente->asistencias->where('asistio', false)->sum('penalidad') }}</td>
                            <td>
                                <form action="{{ route('asistencia.habilitar', $cliente->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="form-control btn btn-success">Habilitar Cliente</button>
                                </form>
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
