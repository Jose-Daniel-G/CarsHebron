@extends('adminlte::page')

@section('title', 'Dashboard')
{{-- @section('plugins.Sweetalert2', true) --}}
@section('css')

@stop
@section('content_header')
    <h1>Sistema de reservas </h1>
@stop

@section('content')
    <div class="row">
        <h3><b>Bienvenido:</b> {{ Auth::user()->email }} / <b>Rol:</b> {{ Auth::user()->roles->pluck('name')->first() }}
        </h3>
    </div>

    <div class="row">
        @can('admin.users.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_configuraciones }}</h3>
                        <p>Configuracion</p>
                    </div>
                    <a href="{{ route('admin.config.index') }}" class="small-box-footer"><i class="fas fa-sync-alt"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.users.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_usuarios }}</h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">Mas informacion <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.secretarias.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $total_secretarias }}
                            {{-- <sup style="font-size: 20px">%</sup></h3> --}}
                            <p>Secretarias</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.secretarias.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.clientes.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_clientes }}</h3>

                        <p>Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('admin.clientes.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.cursos.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $total_cursos }}</h3>

                        <p>Cursos</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-building-fill-add"></i>
                    </div>
                    <a href="{{ route('admin.cursos.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.clientes.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $total_profesores }}</h3>

                        <p>Profesores</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-person-lines-fill"></i>
                    </div>
                    <a href="{{ route('admin.profesores.index') }}" class="small-box-footer">Mas informacion <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan
        @can('admin.horarios.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $total_horarios }}</h3>

                        <p>Horarios</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-calendar2-week"></i>
                    </div>
                    <a href="{{ route('admin.horarios.index') }}" class="small-box-footer">Mas informacion <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endcan

        @can('admin.reservas.index')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $total_eventos }}</h3>

                        <p>Reservas</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas bi bi-calendar2-week"></i>
                    </div>
                    <a href="" class="small-box-footer"> <i class="fas fa-calendar-alt"></i></a>
                </div>
            </div>
        @endcan
    </div>

    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link " id="custom-tabs-three-home-tab" data-toggle="pill"
                        href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                        aria-selected="false">Horario de profesores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-profile-tab" data-toggle="pill"
                        href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                        aria-selected="false">Calendario de reserva</a>
                </li>
                {{-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill"
                            href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages"
                            aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill"
                            href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings"
                            aria-selected="true">Settings</a>
                    </li> --}}
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel"
                    aria-labelledby="custom-tabs-three-home-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="card-title">Calendario de atencion de profesores </h3>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <label for="curso_id">Cursos </label><b>*</b>
                        </div>
                        <div class="col-md-4">
                            <select name="curso_id" id="curso_select" class="form-control">
                                <option value="" selected disabled>Seleccione una opción</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">
                                        {{ $curso->nombre }} </option>
                                    {{-- {{ $curso->nombre . ' - ' . $curso->ubicacion }} </option> --}}
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div id="curso_info"></div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade active show" id="custom-tabs-three-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-three-profile-tab">

                    <div class="row">
                        <div class="col-md-8 d-flex justify-content-end">
                            <label for="curso_id">Profesores </label><b>*</b>
                        </div>
                        <div class="col-md-4">
                            <select name="profesor_id" id="profesor_select" class="form-control">
                                <option value="" selected disabled>Seleccione una opción</option>
                                @foreach ($profesores as $profesore)
                                    <option value="{{ $profesore->id }}">
                                        {{ $profesore->nombres . ' ' . $profesore->apellidos . ' - ' . $profesore->especialidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @can('cargar_datos_cursos')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#claseModal">
                                    Agendar Clase
                                </button>

                                <a href="{{ route('admin.ver_reservas', Auth::user()->id) }}" class="btn btn-success">
                                    <i class="bi bi-calendar-check"></i>Ver las reservas
                                </a>
                            @endcan
                        </div>


                        <!-- Modal -->
                        @include('admin.events.event')
                        <!-- Incluir Modal INFO-->
                        @include('admin.events.show')
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="profesor_info"></div>
                            <div id="calendar"></div>

                        </div>

                    </div>
                </div>
                {{-- <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-three-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi

                    </div>
                    <div class="tab-pane fade active show" id="custom-tabs-three-settings" role="tabpanel"
                        aria-labelledby="custom-tabs-three-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare
                    </div> --}}
            </div>
        </div>

    </div>
    @if (Auth::check() && Auth::user()->profesor)
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Calendario de reservas</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ Auth::user()->profesor->nombres }}
                        <table id="reservas" class="table table-striped table-bordered table-hover table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nro</th>
                                    <th>Usuario</th>
                                    <th>Fecha de la reserva</th>
                                    <th>Hora de reserva</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 1; ?>
                                @foreach ($events as $evento)
                                    @if (Auth::user()->profesor->id == $evento->profesor_id)
                                        {{-- NOTA: SI  FALLA --}}
                                        <tr>
                                            <td scope="row">{{ $contador++ }}</td>
                                            <td scope="row">{{ $evento->user->name }}</td>
                                            <td scope="row" class="text-center">
                                                {{ \Carbon\Carbon::parse($evento->start)->format('Y-m-d') }}</td>
                                            <td scope="row" class="text-center">
                                                {{ \Carbon\Carbon::parse($evento->end)->format('H:i') }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop

@section('js')
    {{-- Axios JS --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //-------------------------------------------------------------
            // VALIDAR SI LA FECHA YA NO HA PASADO
            const fechaReservaInput = document.getElementById('fecha_reserva');
            // Escuchar el evento de cambio en el campo de fecha de reserva
            fechaReservaInput.addEventListener('change', function() {
                let selectedDate = this.value; //Obtener fecha seleccionada
                //Obetner la fecha actual en el formato ISO (yyyy-mm-dd)
                let today = new Date().toISOString().slice(0, 10);
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedDate < today) {
                    // si es asi, establecer la fecha seleccionada en null
                    this.value = null;
                    alert('No se puede seleccionar una fecha pasada');
                }

            })
            //----------------------------------------------------------------
            // VALIDAR SI LA HORA YA NO HA PASADO
            const HoraReservaInput = document.getElementById('hora_reserva');
            const HoraIncioInput = document.getElementById('hora_inicio');
            const HoraFinInput = document.getElementById('hora_fin');

            // Escuchar el evento de cambio en el campo de hora de reserva
            HoraIncioInput.addEventListener('change', function() {
                let selectedTime = this.value; //Obtener fecha seleccionada
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedTime) {
                    selectedTime = selectedTime.split(':'); //Dividir la cadena en horas y minutos
                    selectedTime = selectedTime[0] + ':00'; //conservar la hora, ignorar los minutos
                    this.value = selectedTime; // Establecer la hora modificada en el campo de entrada
                }
                // verificar si la fecha selecionada es anterior a la fecha actual
                if (selectedTime < '08:00' || selectedTime > '20:00') {
                    // si es asi, establecer la hora seleccionada en null
                    this.value = null;
                    alert('Por favor seleccione una fecha entre 08:00 y las 20:00');
                }
            })

            // Agregar un evento de cambio al input
            HoraFinInput.addEventListener('change', function() {
                let selectedTime = this.value;
                // Conservar solo la hora, ignorar los minutos
                selectedTime = selectedTime.split(':')[0] + ':00'; // "14:00"
                this.value = selectedTime;
            });
        });

        // carga contenido de tabla en  curso_info
        $('#curso_select').on('change', function() {
            var curso_id = $('#curso_select').val();
            var url = "{{ route('admin.horarios.cargar_datos_cursos', ':id') }}";
            url = url.replace(':id', curso_id);

            if (curso_id) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#curso_info').html(data);
                    },
                    error: function() {
                        alert('Error al obtener datos del curso');
                    }
                });
            } else {
                $('#curso_info').html('');
            }
        });
        // carga contenido de tabla en profesor_info
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            // Crea una instancia del calendario una sola vez
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: [], // Inicialmente vacío para evitar carga de eventos al inicio
                eventClick: function(info) {
                    var evento = info.event;
                    var startTime = evento.start;

                    // Mostrar la información en el modal
                    var profesorNombres = evento.extendedProps.profesor ? evento.extendedProps.profesor
                        .nombres : 'No disponible';
                    var profesorApellidos = evento.extendedProps.profesor ? evento.extendedProps
                        .profesor.apellidos : 'No disponible';
                    var clienteNombres = evento.extendedProps.cliente ? evento.extendedProps.cliente
                        .nombres : 'No disponible';
                    var clienteApellidos = evento.extendedProps.cliente ? evento.extendedProps.cliente
                        .apellidos : 'No disponible';

                    document.getElementById('nombres_cliente').textContent =
                        `${clienteNombres} ${clienteApellidos}`;
                    document.getElementById('nombres_teacher').textContent =
                        `${profesorNombres} ${profesorApellidos}`;
                    document.getElementById('fecha_reserva1').textContent = startTime.toISOString()
                        .split('T')[0]; // Fecha
                    document.getElementById('hora_reserva1').textContent = startTime
                        .toLocaleTimeString(); // Hora de inicio

                    // Mostrar el modal
                    $("#mdalSelected").modal("show");
                }
            });

            // Renderizar el calendario cuando se activa la pestaña correspondiente
            $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
                var target = $(e.target).attr("href"); // Obtener la pestaña activa
                if (target === '#custom-tabs-three-profile') {
                    calendar
                .render(); // Renderizar el calendario solo si la pestaña activa es la del calendario
                }
            });

            // Forzar el renderizado al cargar la página si ya está activa la pestaña del calendario
            if ($('#custom-tabs-three-profile').hasClass('active')) {
                calendar.render();
            }

            // Evento cuando cambia la selección del profesor
            $('#profesor_select').on('change', function() {
                var profesor_id = $(this).val();

                // Remover todas las fuentes de eventos del calendario
                calendar.removeAllEventSources();

                // Si hay un profesor seleccionado, cargar sus eventos
                if (profesor_id) {
                    var url = "{{ route('admin.horarios.cargar_reserva_profesores', ':id') }}";
                    url = url.replace(':id', profesor_id);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Asegúrate de que 'data' esté en el formato correcto
                            calendar.addEventSource(data); // Añade los eventos al calendario
                        },
                        error: function() {
                            alert('Error al obtener datos del profesor');
                        }
                    });
                } else {
                    // Si no hay profesor seleccionado, también puedes limpiar los eventos si es necesario
                    calendar.removeAllEventSources();
                }
            });
        });
    </script>

    <script>
        //NOTA: NO SE ESTA VISUALIZANDO 
        new DataTable('#reservas', {
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis' // Botones que aparecen en la imagen
            ],
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ reservas",
                "infoEmpty": "Mostrando 0 a 0 de 0 reservas",
                "infoFiltered": "(filtrado de _MAX_ reservas totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ reservas",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "orderable": "Ordenar por esta columna",
                    "orderableReverse": "Invertir el orden de esta columna"
                }
            }

        });
    </script>

    @if (session('info') && session('icono') && session('hora_reserva'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        </script>
    @endif

    @if (session('info') && session('icono') && session('title'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // Establece el evento para llamar a la función cargarProfesores al cambiar el curso
            $('#cursoid').on('change', function() {
                var cursoid = $(this).val(); // Obtén el valor seleccionado
                // Función para cargar profesores
                if (!cursoid) return; // Salir si no hay curso seleccionado
                var url = "{{ route('obtenerProfesores', ':id') }}";
                url = url.replace(':id', cursoid);
                // alert('url ' + url);

                // Realizar una llamada AJAX para obtener los profesores disponibles
                $.ajax({
                    url: url, // URL a la que se realiza la solicitud
                    method: 'GET',

                    success: function(data) {
                        // console.log('Profesores: ',
                        // data); // Debería mostrar la lista de profesores

                        // Verifica si hay profesores y si es un array
                        if (data && Array.isArray(data)) {
                            // Limpia el select de profesores antes de llenarlo
                            $('#profesorid').empty().append(
                                '<option value="" selected disabled>Seleccione un Profesor</option>'
                            );

                            data.forEach(function(profesor) {
                                $('#profesorid').append(
                                    `<option value="${profesor.id}">${profesor.nombres} ${profesor.apellidos}</option>`
                                );
                            });
                        } else {
                            alert('No se encontraron profesores.');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error al cargar los profesores:', xhr.responseText);
                        alert('Error al cargar los profesores. Intenta nuevamente.');
                    }
                });
            });
        });
    </script>
@stop
