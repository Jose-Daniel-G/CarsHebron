@extends('layouts.app')

@section('content')
    <h1>Listado de Roles</h1>
    <a href="{{ route('roles.create') }}">Crear nuevo rol</a>

    <ul>
        @foreach($roles as $rol)
            <li>{{ $rol->nombre }} - <a href="{{ route('roles.edit', $rol->id) }}">Editar</a></li>
        @endforeach
    </ul>
@endsection
