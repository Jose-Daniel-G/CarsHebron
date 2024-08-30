@extends('layouts.app')

@section('content')
    <h1>Crear Clase</h1>

    <form method="POST" action="{{ route('clases.store') }}">
        @csrf
        <div>
            <label for="alumno_id">ID del Alumno:</label>
            <input type="text" name="alumno_id" id="alumno_id" required>
        </div>

        <div>
            <label for="profesor_id">ID del Profesor:</label>
            <input type="text" name="profesor_id" id="profesor_id" required>
        </div>

        <div>
            <label for="vehiculo_id">ID del Vehículo:</label>
            <input type="text" name="vehiculo_id" id="vehiculo_id" required>
        </div>

        <div>
            <label for="curso_id">ID del Curso:</label>
            <input type="text" name="curso_id" id="curso_id" required>
        </div>

        <div>
            <label for="fecha_hora">Fecha y Hora:</label>
            <input type="datetime-local" name="fecha_hora" id="fecha_hora" required>
        </div>

        <div>
            <label for="duracion">Duración (minutos):</label>
            <input type="number" name="duracion" id="duracion" required>
        </div>

        <div>
            <label for="estado">Estado:</label>
            <input type="text" name="estado" id="estado" required>
        </div>

        <button type="submit">Guardar</button>
    </form>
@endsection
