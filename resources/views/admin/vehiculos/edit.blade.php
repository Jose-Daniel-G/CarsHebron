<div class="modal fade" id="editVehiculoModal" tabindex="-1" aria-labelledby="editVehiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVehiculoModalLabel">Editar Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.vehiculos.update', $vehiculo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="placa" class="form-label">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa"
                            value="{{ $vehiculo->placa }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo"
                            value="{{ $vehiculo->modelo }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="disponible" class="form-label">Disponible</label>
                        <select class="form-select form-control" id="disponible" name="disponible">
                            <option value="1" {{ $vehiculo->disponible ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ !$vehiculo->disponible ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-select form-control" id="tipo" name="tipo">
                            <option value="sedan" {{ $vehiculo->tipo === 'sedan' ? 'selected' : '' }}>Sedan</option>
                            <option value="suv" {{ $vehiculo->tipo === 'suv' ? 'selected' : '' }}>SUV</option>
                            <option value="pickup" {{ $vehiculo->tipo === 'pickup' ? 'selected' : '' }}>Pickup</option>
                            <option value="hatchback" {{ $vehiculo->tipo === 'hatchback' ? 'selected' : '' }}>Hatchback
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="picoyplaca_id" class="form-label">PicoyPlaca ID</label>
                        <input type="number" class="form-control" id="picoyplaca_id" name="picoyplaca_id"
                            value="{{ $vehiculo->picoyplaca_id }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario_id" class="form-label">Usuario ID</label>
                        <input type="number" class="form-control" id="usuario_id" name="usuario_id"
                            value="{{ $vehiculo->usuario_id }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar vehículo</button>
                </form>
            </div>
        </div>
    </div>
</div>
