@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <h1>Bienvenido a Platzi</h1>
        <form action="{{ route('admin.clientes.store') }}" method="POST">
            {{-- @method("POST") --}}
        @include('card._form')
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
