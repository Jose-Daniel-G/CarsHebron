@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h2>Marcar Asistencia</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form action="{{ route('asistencia.registrar') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="cliente">Seleccionar Cliente:</label>
                            <select name="cliente_id" class="form-control">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombres }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="evento">Seleccionar Clase:</label>
                            <select name="evento_id" class="form-control">
                                @foreach ($eventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->title }} - {{ $evento->start }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Asistió:</label><br>
                            <input type="radio" name="asistio" value="1" checked> Sí
                            <input type="radio" name="asistio" value="0"> No
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="form-control btn btn-primary" style="margin-top: 28px;">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- Aquí puedes agregar estilos adicionales si lo deseas -->
@endsection

@section('js')
    <!-- Aquí puedes agregar scripts adicionales si es necesario -->
@endsection
