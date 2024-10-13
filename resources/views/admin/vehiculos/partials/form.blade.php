<div class="card">
    <div class="card-header">{{ $vehiculo->exists ? __('Editar Vehículo') : __('Crear Vehículo') }}</div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $vehiculo->exists ? route('vehiculos.update', $vehiculo->id) : route('vehiculos.store') }}" method="POST">
            @csrf
            @if($vehiculo->exists)
                @method('PUT')
            @endif

            {{-- <div class="form-group">
                <label for="marca">{{ __('Marca') }}</label>
                <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $vehiculo->marca) }}" required>
            </div> --}}
            {{-- <div class="form-group">
                <label for="anio">{{ __('Año') }}</label>
                <input type="number" class="form-control" id="anio" name="anio" value="{{ old('anio', $vehiculo->anio) }}" required>
            </div> --}}
            {{-- <div class="form-group">
                <label for="color">{{ __('Color') }}</label>
                <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $vehiculo->color) }}" required>
            </div> --}}
            <div class="form-group">
                <label for="placa">{{ __('Placa') }}</label>
                <input type="text" class="form-control" id="placa" name="placa" value="{{ old('placa', $vehiculo->placa) }}" required>
            </div>
            <div class="form-group">
                <label for="modelo">{{ __('Modelo') }}</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo', $vehiculo->modelo) }}" required>
            </div>
            <div class="form-group">
                <label for="tipo">{{ __('Tipo de Vehículo') }}</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="automovil" {{ old('tipo', $vehiculo->tipo) == 'automovil' ? 'selected' : '' }}>Automóvil</option>
                    <option value="motocicleta" {{ old('tipo', $vehiculo->tipo) == 'motocicleta' ? 'selected' : '' }}>Motocicleta</option>
                    <option value="camioneta" {{ old('tipo', $vehiculo->tipo) == 'camioneta' ? 'selected' : '' }}>Camioneta</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">{{ $vehiculo->exists ? __('Actualizar Vehículo') : __('Crear Vehículo') }}</button>
                <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
            </div>
        </form>
    </div>
</div>
