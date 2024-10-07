<form action="{{ route('admin.eventos.store') }}" method="POST">
    @csrf
    <div class="modal fade" id="claseModal" tabindex="-1" aria-labelledby="claseModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="claseModal">Profesores</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="profesor_id">Profesor</label>
                                <select name="profesor_id" class="form-control">
                                    <option value="" selected disabled>Selecione un Profesor
                                    </option>
                                    @foreach ($profesores as $profesore)
                                        <option value="{{ $profesore->id }}">
                                            {{ $profesore->nombres . ' ' . $profesore->apellidos . ' - ' . $profesore->especialidad }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('profesor_id')
                                    <small
                                        class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="profesor">Fecha de reserva</label>
                                <input type="date" class="form-control" name="fecha_reserva"
                                    id="fecha_reserva" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="hora_inicio">Hora inicio</label>
                                <input type="time" class="form-control" name="hora_inicio"
                                    id="hora_inicio">
                                @error('hora_inicio')
                                    <small
                                        class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="hora_fin">Hora fin</label>
                                <input type="time" class="form-control" name="hora_fin"
                                    id="hora_fin">
                                @error('hora_fin')
                                    <small
                                        class="bg-danger text-white p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>