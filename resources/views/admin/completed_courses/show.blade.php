@extends('layouts.app')

@section('content')
    <h1>Detalles del Curso Completado</h1>

    <p><strong>Usuario:</strong> {{ $completedCourse->user->name }}</p>
    <p><strong>Curso:</strong> {{ $completedCourse->course->title }}</p>
    <p><strong>Fecha de Finalización:</strong> {{ $completedCourse->completed_at->format('d-m-Y H:i') }}</p>
@endsection
