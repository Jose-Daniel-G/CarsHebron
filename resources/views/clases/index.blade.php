@extends('layouts.app')

@section('content')
    <h1>Listado de Clases</h1>
    <a href="{{ route('clases.create') }}">Crear nueva clase</a>

    <ul>
        @foreach($clases as $clase)
            <li>Clase {{ $clase->id }} - <a href="{{ route('clases.edit', $clase->id) }}">Editar</a></li>
        @endforeach
    </ul>
@endsection
