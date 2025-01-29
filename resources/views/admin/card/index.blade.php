@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <h1>Bienvenido a Platzi</h1>

        @foreach ($cards as $card)
            <label for="title_{{ $card->id }}" class="uppercase text-gray-700 text-xs">Título</label>
            <input type="text" name="title" id="title_{{ $card->id }}" class="rounded border-gray-200 w-full mb-4" value="{{ $card->title }}">
            
            <label for="body_{{ $card->id }}" class="uppercase text-gray-700 text-xs">Contenido</label>
            <textarea name="body" id="body_{{ $card->id }}" rows="5" class="rounded border-gray-200 w-full mb-4">{{ $card->body }}</textarea>
        @endforeach
        
        <div class="flex justify-center items-center">
            <a href="{{ route('card.index') }}" class="text-indigo-600">Volver</a>
            <input type="submit" value="Enviar" class="bg-gray-800 text-white rounded px-4 py-2">
        </div>
        
        <!-- Renderiza la paginación -->
        {{ $cards->links() }}
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
