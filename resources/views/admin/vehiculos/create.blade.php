<div class="container">
    <h1>Crear Horario de Pico y Placa</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.picoyplaca.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="dia">Día</label>
            <input type="text" class="form-control" name="dia" required>
        </div>
        <div class="form-group">
            <label for="horario">Horario</label>
            <input type="text" class="form-control" name="horario" required>
        </div>
        <div class="form-group">
            <label for="placa">Placa</label>
            <input type="text" class="form-control" name="placa" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>