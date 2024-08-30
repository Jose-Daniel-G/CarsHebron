@extends('layouts.app')

@section('content')
    <h1>Listado de Usuarios</h1>
    <a href="{{ route('users.create') }}">Crear nuevo usuario</a>

    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} - <a href="{{ route('users.edit', $user->id) }}">Editar</a></li>
        @endforeach
    </ul>
@endsection
