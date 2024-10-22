<!-- Modal de Detalle -->
<div class="modal fade" id="showVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="showVehiculoModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showVehiculoModalLabel">Detalles del Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="placa">Placa:</label>
                    <p id="placa">{{ $vehiculo->placa }}</p>
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <p id="modelo">{{ $vehiculo->modelo }}</p>
                </div>
                <div class="form-group">
                    <label for="disponible">Disponible:</label>
                    <p id="disponible">{{ $vehiculo->disponible ? 'Sí' : 'No' }}</p>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <p id="tipo">{{ $vehiculo->tipo }}</p>
                </div>
                <div class="form-group">
                    <label for="profesor">Profesor:</label>
                    <p id="profesor">{{ $vehiculo->usuario_id ? $vehiculo->usuario->nombre : 'No asignado' }}</p>
                </div>
                <!-- Agrega otros campos según sea necesario -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
