@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content_header')
    <h2>Asistencia a Clase de Conducción</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form action="{{ route('asistencia.registrar') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Clase</th>
                                    <th>Fecha</th>
                                    <th>Asistió</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventos as $evento)
                                    <tr>
                                        <td>{{ $evento->cliente->nombres }}</td>
                                        <td>{{ $evento->title }}</td>
                                        <td>{{ $evento->start }}</td>
                                        <td>
                                            <input type="hidden" name="eventos[{{ $evento->id }}][cliente_id]" value="{{ $evento->cliente->id }}">
                                            <input type="checkbox" name="eventos[{{ $evento->id }}][asistio]" value="1">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="form-control btn btn-primary">Registrar Asistencia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
