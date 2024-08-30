@extends('layouts.app')

@section('content')
    <h1>Crear Curso</h1>

    <form method="POST" action="{{ route('cursos.store') }}">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required></textarea>
        </div>

        <div>
            <label for="horas_requeridas">Horas Requeridas:</label>
            <input type="number" name="horas_requeridas" id="horas_requeridas" required>
        </div>

        <button type="submit">Guardar</button>
    </form>
@endsection
