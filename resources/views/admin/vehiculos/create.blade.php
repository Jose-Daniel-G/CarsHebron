<div class="modal fade" id="createVehiculoModal" tabindex="-1" aria-labelledby="createVehiculoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVehiculoModalLabel">Crear nuevo Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createVehiculoForm" action="{{ route('admin.vehiculos.store') }}" autocomplete="off"
                    method="POST">
                    @csrf
                    <!-- Campo: Placa -->
                    <div class="mb-3">
                        <label for="placa" class="form-label">{{ __('Placa') }}</label>
                        <input type="text" class="form-control" id="placa" name="placa" value=""
                            required>
                    </div>

                    <!-- Campo: Modelo -->
                    <div class="mb-3">
                        <label for="modelo" class="form-label">{{ __('Modelo') }}</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" value=""
                            required>
                    </div>

                    <!-- Campo: Tipo de Vehículo -->
                    <div class="mb-3">
                        <label for="tipo" class="form-label">{{ __('Tipo de Vehículo') }}</label>
                        <select id="tipo" name="tipo" class="form-control" required>
                            @php
                                $tipos = ['automovil', 'motocicleta', 'camioneta'];
                            @endphp
                                <option value="" selected disabled>Seleccione una opción</option>

                            @foreach ($tipos as $value)
                                <option value="{{ $value }}">
                                    {{ ucfirst($value) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Crear vehículo</button>
                </form>
            </div>
        </div>
    </div>
</div>
