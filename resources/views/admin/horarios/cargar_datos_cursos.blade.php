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
                    '08:00:00 - 09:00:00',
                    '09:00:00 - 10:00:00',
                    '10:00:00 - 11:00:00',
                    '11:00:00 - 12:00:00',
                    '12:00:00 - 13:00:00',
                    '13:00:00 - 14:00:00',
                    '14:00:00 - 15:00:00',
                    '15:00:00 - 16:00:00',
                    '17:00:00 - 18:00:00',
                    '19:00:00 - 20:00:00',
                ];
                $diasSemana = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
            @endphp

            @foreach ($horas as $hora)
                @php
                    [$hora_inicio, $hora_fin] = explode(' - ', $hora);
                    $hora_inicio = date('H:i:s', strtotime($hora_inicio));
                    $hora_fin = date('H:i:s', strtotime($hora_fin));
                @endphp
                <tr>
                    <td scope="row">{{ $hora }}</td>
                    @foreach ($diasSemana as $dia)
                        @php
                            $nombre_profesor = '';
                            foreach ($horarios as $horario) {
                                $horario_inicio = date('H:i:s', strtotime($horario->hora_inicio));
                                $horario_fin = date('H:i:s', strtotime($horario->hora_fin));

   
                                if (
                                    strtoupper($horario->dia) == $dia &&
                                    $hora_inicio >= $horario_inicio &&// Ajuste en comparación
                                    $hora_fin <= $horario_fin  // Ajuste en comparación
                                ) {
                                    // Asignar nombre del doctor (que es el profesor)
                                    $nombre_profesor =  $horario->profesor->nombres . ' ' . $horario->profesor->apellidos;
                                    break; // Salir del bucle si se encuentra el doctor adecuado
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
