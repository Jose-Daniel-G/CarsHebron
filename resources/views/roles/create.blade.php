@extends('layouts.app')

@section('content')
    <h1>Crear Rol</h1>

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <button type="submit">Guardar</button>
    </form>
@endsection
