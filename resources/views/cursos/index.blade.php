@extends('layouts.app')

@section('content')
    <h1>Listado de Cursos</h1>
    <a href="{{ route('cursos.create') }}">Crear nuevo curso</a>

    <ul>
        @foreach($cursos as $curso)
            <li>{{ $curso->nombre }} - <a href="{{ route('cursos.edit', $curso->id) }}">Editar</a></li>
        @endforeach
    </ul>
@endsection
