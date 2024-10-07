@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>Clientes con Penalidades</h2>
@stop

@section('content')

<table>
    <thead>
        <tr>
            <th>Nombre del Cliente</th>
            <th>Horas Penalizadas</th>
            <th>Penalidad Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->asistencias->where('asistio', false)->sum('evento.duracion') }} horas</td>
                <td>${{ $cliente->asistencias->where('asistio', false)->sum('penalidad') }}</td>
                <td>
                    <form action="{{ route('asistencia.habilitar', $cliente->id) }}" method="POST">
                        @csrf
                        <button type="submit">Habilitar Cliente</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('css')

@stop

@section('js')

@stop

