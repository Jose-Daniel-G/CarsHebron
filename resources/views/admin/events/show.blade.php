
{{-- @csrf --}}
<div class="modal fade" id="mdalSelected" tabindex="-1" aria-labelledby="mdalSelected" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdalSelected">Profesores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="eventoForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="profesor_id1">Profesor</label>
                                {{-- <p id="nombres_teacher" name="nombres_teacher">{{ $event->profesor->nombres . ' ' . $event->profesor->apellidos . ' - ' . $event->profesor->especialidad }} </p> --}}
                                <p id="nombres_teacher" name="nombres_teacher"> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="fecha_reserva1">Fecha de reserva</label>
                                <p id="fecha_reserva1" name="fecha_reserva1"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="hora_reserva1">Hora de
                                    reserva</label>
                                <p id="hora_reserva1"></p>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        {{-- <button type="submit" class="btn btn-success">Actualizar</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

