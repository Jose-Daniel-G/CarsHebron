    {{-- MODAL --}}
    <div class="modal fade" id="claseModal" tabindex="-1" aria-labelledby="claseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="claseModalLabel">Fechas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" autocomplete="off" id="eventoForm" method="POST">
                        @csrf
                        {{-- <div class="form-group d-none">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" name="id" id="id"
                                aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted">Help text</small>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="profesor_id1">Profesor</label>
                                    <p id="nombres_teacher"> 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Clase</label>
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Agenda la clase">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción del evento</label>
                            <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
                        </div>
                        <div class="form-group d-none">
                            <label for="start">Inicio</label>
                            <input type="date" class="form-control" name="start" id="start">
                        </div>
                        <div class="form-group d-none">
                            <label for="end">Fin</label>
                            <input type="date" class="form-control" name="end" id="end">
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success me-2" id="btnGuardar">Guardar</button>
                    <button type="button" class="btn btn-warning me-2" id="btnUpdate">Modificar</button>
                    <button type="button" class="btn btn-danger me-2" id="btnEliminar">Eliminar</button>
                    <button type="button" class="btn btn-secondary me-2" data-dismiss="modal">cerrar</button>
                </div>
            </div>
        </div>
    </div>