@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>Marcar Asistencia</h2>
@stop

@section('content')

<form action="{{ route('asistencia.registrar') }}" method="POST">
    @csrf
    <label for="cliente">Seleccionar Cliente:</label>
    <select name="cliente_id">
        @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
        @endforeach
    </select>
    <label for="evento">Seleccionar Clase:</label>
    <select name="evento_id">
        @foreach($eventos as $evento)
            <option value="{{ $evento->id }}">{{ $evento->nombre }} - {{ $evento->fecha }}</option>
        @endforeach
    </select>
    <label>Asistió:</label>
    <input type="radio" name="asistio" value="true" checked> Sí
    <input type="radio" name="asistio" value="false"> No
    <button type="submit">Registrar</button>
</form>
@stop

@section('css')

@stop

@section('js')

@stop
