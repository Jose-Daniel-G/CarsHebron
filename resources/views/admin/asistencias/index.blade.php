@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content_header')
    <h2>Asistencia a Clase de Conducción</h2>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form action="{{ route('admin.asistencias.store') }}" method="POST">
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
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->cliente->nombres }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->start }}</td>
                                        <td>
                                            <input type="hidden" name="eventos[{{ $event->id }}][cliente_id]" value="{{ $event->cliente->id }}">
                                            <input type="checkbox" name="eventos[{{ $event->id }}][asistio]" value="1"
                                                @if($asistencias->where('evento_id', $event->id)->where('cliente_id', $event->cliente->id)->first() &&
                                                   $asistencias->where('evento_id', $event->id)->where('cliente_id', $event->cliente->id)->first()->asistio)
                                                    checked 
                                                @endif>
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
