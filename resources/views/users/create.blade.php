@extends('layouts.app')

@section('content')
    <h1>Crear Usuario</h1>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" required>
        </div>

        <div>
            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>

        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Guardar</button>
    </form>
@endsection
