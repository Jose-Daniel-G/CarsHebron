@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.clientes.update',$post) }}" method="POST">
            @method("PUT")
        @include('posts._form')
        </form>
    </div>
@stop

@section('css')