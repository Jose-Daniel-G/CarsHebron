<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th scope="col">Hora</th>
                <th scope="col">Lunes</th>
                <th scope="col">Martes</th>
                <th scope="col">Miercoles</th>
                <th scope="col">Jueves</th>
                <th scope="col">Viernes</th>
                <th scope="col">Sabado</th>
            </tr>
        </thead>
        <tbody>
            @php
                $horas = [
                    '08:00 am - 09:00 am',
                    '09:00 am - 10:00 am',
                    '10:00 am - 11:00 am',
                    '11:00 am - 12:00 pm',
                    '12:00 pm - 01:00 pm',
                    '01:00 pm - 02:00 pm',
                    '02:00 pm - 03:00 pm',
                    '03:00 pm - 04:00 pm',
                    '04:00 pm - 05:00 pm',
                    '05:00 pm - 06:00 pm',
                    '06:00 pm - 07:00 pm',
                    '07:00 pm - 08:00 pm',
                ];
                $diasSemana = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
            @endphp

            @foreach ($horas as $hora)
                @php
                    [$hora_inicio, $hora_fin] = explode(' - ', $hora);
                    // Convertimos las horas a formato de 24 horas sin segundos para las comparaciones
                    $hora_inicio_24 = date('H:i', strtotime($hora_inicio));
                    $hora_fin_24 = date('H:i', strtotime($hora_fin));
                @endphp
                <tr>
                    <td scope="row">{{ $hora }}</td> <!-- Muestra en formato de 12 horas -->
                    @foreach ($diasSemana as $dia)
                        @php
                            $nombre_profesor = '';
                            foreach ($horarios as $horario) {
                                $horario_inicio_24 = date('H:i', strtotime($horario->hora_inicio));
                                $horario_fin_24 = date('H:i', strtotime($horario->hora_fin));

                                // Comparar las horas en formato de 24 horas (sin segundos)
                                if (
                                    strtoupper($horario->dia) == $dia &&
                                    $hora_inicio_24 >= $horario_inicio_24 &&
                                    $hora_fin_24 <= $horario_fin_24
                                ) {
                                    $nombre_profesor = $horario->profesor->nombres . ' ' . $horario->profesor->apellidos;
                                    break; // Salir del bucle si se encuentra el profesor adecuado
                                }
                            }
                        @endphp
                        <td>{{ $nombre_profesor }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
