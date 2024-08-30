<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-12 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Bienvenido al Dashboard</h1>
            </div>

            <!-- Estadísticas -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Usuarios Activos</h5>
                            <p class="card-text">1234</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Ventas Mensuales</h5>
                            <p class="card-text">$5678</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Nuevos Registros</h5>
                            <p class="card-text">56</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráfico -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Gráfico de Ventas</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Tabla de Datos -->
            <div class="card">
                <div class="card-header">
                    <h5>Últimos Empleados</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Juan Pérez</td>
                                <td>juan@example.com</td>
                                <td>2024-08-01</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ana García</td>
                                <td>ana@example.com</td>
                                <td>2024-08-02</td>
                            </tr>
                            <!-- Más filas según sea necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                datasets: [{
                    label: 'Ventas',
                    data: [10, 20, 30, 40, 50, 60],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
