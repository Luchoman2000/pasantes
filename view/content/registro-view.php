<?php if ($_SESSION['rol'] == "PASANTE") {
?>
    <!-- <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="<?php echo SERVERURL ?>src/js/es.js"></script>

    <div class="card">
        <div class="card-content">
            <div class="container mW alignCenter content">
                <h1 class="title has-text-success">Registros</h1>
                <p>Historial de dias asistidos hasta la fecha:</p>
            </div>
        </div>
    </div>


    <br>
    <br>

    <div class="container">
        <div class="card">
            <div class="card-content">

                <div class="tabs is-fullwidth is-boxed">
                    <ul>
                        <li class="tab" onclick="openTab(event,'lista')">
                            <a>
                                <span class="icon is-small"><i class="fa fa-list" aria-hidden="true"></i></span>
                                <span>Lista</span>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li class="tab " onclick="openTab(event,'calendario')">
                            <a>
                                <span class="icon is-small"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                <span>Calendario</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="content-tab " id="lista" style="display: none;">
                    <div class="content">
                        <div class="columns is-vcentered is-mobile">
                            <div class="column">
                                <span class=" ml-3 has-text-info">Total Horas: <span class="total_horas_show title is-6">a</span></span>
                            </div>
                            <div class="column">
                                <div class="buttons is-right mr-3">

                                    <button type="submit" class=" btnExportarAsi is-outlined is-info button is-small modal-button" data-target="exportarAsistencia" data-toggle="modal">
                                        <span class="icon">
                                            <i class="fa fa-external-link" aria-hidden="true"></i>
                                        </span>
                                        <span>Exportar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-container">

                            <?php
                            require_once './controller/asistencia.controlador.php';
                            $asistencia = new AsistenciaControlador();
                            echo $asistencia->CtrMostrarAsistenciaPasante();
                            ?>
                        </div>
                    </div>
                </div>

                <div class="content-tab is-active" id="calendario">
                    <!-- <div class="content">
                        <div class="card">
                            <div class="card-content"> -->
                    <!-- <div class="content"> -->
                    <div id='calendar'></div>
                    <!-- </div> -->


                    <!-- </div> -->
                    <!-- </div>H -->
                    <!-- </div> -->
                </div>

            </div>
        </div>
    </div>

    <div class="modal modal-fx-fadeInScale" id="exportarAsistencia">
        <div class="modal-background"></div>
        <div class="modal-content mx-0">
            <div class="modal-card">
                <form method="POST" id="exportarWord" action="<?php echo SERVERURL ?>ajax/reporte.ajax.php">
                    <input type="hidden" name="reporte_asistencia" value="1">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Exportar</strong> </p>
                    </header>
                    <section class="modal-card-body">
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label">Empresa</label>
                                    <div class="control">
                                        <input class="input" type="text" name="empresa" value="Senescyt" required>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <label class="label">Tutor</label>
                                    <div class="control">
                                        <input class="input" type="text" name="tutor" value="Ing. Majo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <label class="label">Cargo</label>
                                    <div class="control">
                                        <input class="input" type="text" name="cargo" value="Soporte al Usuario 3" required>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <div class="control">
                                        <label class="radio">
                                            <input checked type="radio" name="tipoA" value="word">
                                            WORD
                                        </label>
                                        <label class="radio">
                                            <input  type="radio" name="tipoA" value="pdf">
                                            PDF
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced options toggle -->
                        <!-- <div class="columns">
                            <div class="column">
                                <a id="avancedOptions">Más opciones</a>
                            </div>
                            Advanced options
                            <div class="column" id="opciones_avanzadas_div">
                                <div class="field">
                                    <label class="label">Fecha Inicio</label>
                                    <div class="control">
                                        <input checked class="input" type="date" name="fecha_inicio_avanzada" id="fecha_inicio_avanzada" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Fecha Fin</label>
                                    <div class="control">
                                        <input class="input" type="date" name="fecha_fin_avanzada" id="fecha_fin_avanzada" required>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </section>
                    <footer class="modal-card-foot">
                        <button type="submit" class="btnExportarAsi is-small is-outlined is-info button modal-button">
                            <span class="icon">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </span>
                            <span>Exportar</span>
                        </button>
                    </footer>
                </form>

            </div>
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>

    <script>
        $('#opciones_avanzadas_div').hide();
        $('#avancedOptions').click(function() {
            $('#avancedOptions').text(function(i, text) {
                return text === "Más opciones" ? "Menos opciones" : "Más opciones";
            });
            $('#opciones_avanzadas_div').toggle('slow');
        });
    </script>

    <script>
        var calendarEl = document.getElementById('calendar');
        var datos = [];
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // themeSystem: 'bootstrap',
            eventClick: function(info) {
                console.log(info);
                console.log('');
                console.log(info.event.dia);
                console.log(info.event.title);
                if (info.event.title == "Incompleto") {
                    msgEstado = "Incompleto 🔴";
                } else if (info.event.title == "Completo") {
                    msgEstado = "Completo 🟢";
                } else {
                    msgEstado = "Pendiente 🟠";
                }

                Swal.fire({
                    title: 'Dia ' + info.event.extendedProps.dia,
                    html: '<span>Hora ingreso</span><p>' + info.event.extendedProps.h_ingreso + '</p>' +
                        '<span>Hora Salida</span><p>' + info.event.extendedProps.h_salida + '</p>' +
                        '<span>Estado</span><p>' + msgEstado + '</p>',

                    // showCloseButton: true,
                })
            },

            selectable: true,

            select: function(info) {
                this.changeView('timeGridDay', info.startStr);
                // this.eventClick(info);
            },

            events: {
                url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                method: 'POST',
                extraParams: {
                    mostrar_calendario: true,

                },
                failure: function(error) {
                    alert('Ha ocurrido un error obteniendo los datos!\n' + error);
                },
                success: function(data) {
                    // alert('nice!');
                    datos = data;
                    console.log('nice');
                    // console.log(data);
                },
                color: 'yellow', // a non-ajax option
                textColor: 'black' // a non-ajax option
            },

            locale: 'es',

            views: {
                dayGridMonth: { // name of view
                    titleFormat: {
                        month: 'long',
                        year: 'numeric',
                    }
                    // other view-specific options here
                },
                timeGridDay: {
                    titleFormat: {
                        day: 'numeric',
                        month: 'long',

                    },
                    slotLabelFormat: {
                        hour: 'numeric',
                        meridiem: 'short',
                        hour12: true,
                    },
                    // scrolltime: '08:00:00',
                    // slotDuration: '00:15:00',
                    // minTime: '08:00:00',
                    // maxTime: '20:00:00',
                    // slotLabelInterval: '00:15:00',
                    // slotLabelFormat: {
                    //     hour: 'numeric',
                    //     minute: '2-digit',
                    //     second: '2-digit',
                    //     hour12: false,
                    //     // meridiem: 'short'
                    // },
                    allDaySlot: false,
                    // slotLabelInterval: '00:15:00',


                    // other view-specific options here
                },

            },

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridDay'
            },
        });
        calendar.render();

        // $(document).on('click', '.btnExportarAsi', function() {

        //     console.log('click');
        //     console.log(datos);
        //     var form = $('<form>').attr('id', 'exportarWord').attr('method', 'POST').attr('action', SERVERURL + '/pasantes/ajax/reporte.ajax.php');
        //     var input = $('<input>').attr('type', 'hidden').attr('name', 'reporte_asistencia').val('true');
        //     form.append(input);
        //     $('body').append(form);
        //     form.submit();

        // })
    </script>

    <script>
        function openTab(evt, tabName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("content-tab");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" is-active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " is-active";


        }
    </script>






    <script>
        var tot = $('.total_horas').val()
        $('.total_horas_show').text(tot)
    </script>

    <br>
    <br>
    <br>

    <?php
} elseif ($_SESSION['rol'] == "ADMINISTRADOR") {

    // var_dump($_GET['views']);
    // echo "<br>";
    // echo $_REQUEST['views'];
    $ruta = explode("/", $_GET["views"]);
    if (isset($ruta[1])) {
        $id = $ruta[1];
        require_once './controller/asistencia.controlador.php';
        $asistencia = new AsistenciaControlador();

    ?>
        <div class="card">
            <div class="card-content">
                <div class="container mW alignCenter content">
                    <h1 class="title has-text-success">Registros</h1>
                    <p>Historial de dias asistidos de <strong><?php echo $asistencia->CtrGetNombrePasante($id) ?></strong> asta la fecha:</p>
                </div>
            </div>
        </div>


        <br>
        <br>

        <div class="container">


            <div class="card">
                <div class="card-content">
                    <div class="content">
                        <div class="columns is-vcentered is-mobile">
                            <div class="column">
                                <span class=" ml-3 has-text-info">Total Horas: <span class="total_horas_show title is-6">a</span></span>
                            </div>
                            <div class="column">
                                <div class="buttons is-right mr-3">
                                    <button class="button is-small">
                                        <span class="icon">
                                            <i class="fa fa-external-link" aria-hidden="true"></i>
                                        </span>
                                        <span>Exportar</span>
                                    </button>
                                </div>
                            </div>


                        </div>




                        <div class="table-container">
                            <?php
                            echo $asistencia->CtrMostrarAsistenciaPasanteAdmin();
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal modal-fx-fadeInScale" id="edit_hora">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="modal-card">

                    <!-- <input id="appt-time" type="time" name="appt-time" step="2"> -->
                    <form id="guardar_edicion" novalidate>


                        <header class="modal-card-head">
                            <p class="modal-card-title"><strong>Editar asistencia</strong> </p>
                            <!-- <button class="delete modal-close" aria-label="close"></button> -->
                        </header>

                        <section class="modal-card-body">

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora de ingreso:</label>
                                </div>
                                <div class="column">
                                    <input id="h_entrada_u" style="width: 60%; height:29px;" type="time" name="h_entrada_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2"></span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora inicio del almuerzo:</label>
                                </div>
                                <div class="column">
                                    <input id="h_almuerzo_start_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_start_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2">11:12:12</span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora fin del almuerzo:</label>
                                </div>
                                <div class="column">
                                    <input id="h_almuerzo_end_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_end_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2">11:12:12</span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora salida:</label>
                                </div>
                                <div class="column">
                                    <input id="h_salida_u" style="width: 60%; height:29px;" type="time" name="h_salida_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2">11:12:12</span>
                                </div>
                            </div>

                            <input id="asiId" type="hidden" name="asiId_u">
                        </section>

                        <footer class="modal-card-foot">
                            <button type="submit" class="button is-success">Guardar</button>
                            <!-- <button class="button">Cancelar</button> -->
                        </footer>

                    </form>


                </div>
            </div>
            <button class="modal-close is-large" aria-label="close"></button>
        </div>

        <!-- <script type="module">
            import BulmaModal from '../src/js/BulmaModal.js'

            // document.querySelector(".modal").addEventListener("modal:show", (event) => {
            //   console.log(event)
            // });
            const modals = document.querySelectorAll("[data-toggle='modal']");
            modals.forEach((modal) => new BulmaModal(modal));
        </script> -->

        <script>
            var tot = $('.total_horas').val()
            $('.total_horas_show').text(tot)
        </script>


        <br>
        <br>
        <br>
    <?php
    } else {
    ?>


        <div class="card">
            <div class="card-content">
                <div class="container mW alignCenter content">
                    <h1 class="title has-text-success">Registros</h1>
                    <p>Historial de dias asistidos de todos los pasantes asta la fecha:</p>
                </div>
            </div>
        </div>


        <br>
        <br>

        <div class="container">


            <div class="card">
                <div class="card-content">
                    <div class="content">
                        <div class="columns is-vcentered is-mobile">
                            <!-- <div class="column">
                            <span class=" ml-3 has-text-info">Total Horas: <span class="total_horas_show title is-6">a</span></span>
                        </div>
                        <div class="column">
                            <div class="buttons is-right mr-3">
                                <button class="button is-small">
                                    <span class="icon">
                                        <i class="fa fa-external-link" aria-hidden="true"></i>
                                    </span>
                                    <span>Exportar</span>
                                </button>
                            </div>
                        </div> -->


                        </div>




                        <div class="table-container">
                            <?php
                            require_once './controller/asistencia.controlador.php';
                            $asistencia = new AsistenciaControlador();
                            echo $asistencia->CtrMostrarAsistenciaPasanteTotal();
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <script>
            var table = $('#totalAsistencia').removeAttr('width').DataTable({
                // scrollY: "300px",
                // columnDefs: [{
                //     width: 6200,
                //     targets: 0
                // }],
                "language": {
                    "url": "./src/es_es.json"
                },
                "order": [
                    [
                        1, "desc"
                    ]
                ],
                searching: false,
                pagin: false,
                "pagingType": "simple",
                lengthChange: false,
                // responsive: true,
                scrollCollapse: true,
                scroller: true,
                // deferRender: true,
                fixedColumns: true,
            });
        </script>
        <br>
        <br>
        <br>
    <?php
    }
    ?>
    <script>
        $(document).on('click', '.verRegistro', function() {
            var id = $(this).attr('id');
            // window.location.href = id;
            console.log(id);
            window.location.href = "registro/" + id;




        })
        $(document).on('click', '.eliminarRegistro', function() {
            var id = $(this).attr('id');
            // window.location.href = id;
            console.log(id);
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Barrarás el registro de este usuario, ¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!',
                cancelButtonText: '¡No, cancelar!',

            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: SERVERURL + "/pasantes/ajax/asistencia.ajax.php",
                        method: "POST",
                        data: 'id=' + id + '&borrar_registro=true',
                        success: function(data) {
                            console.log(data);
                            if (data == 'ok') {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El registro ha sido eliminado.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })

                            } else if (data == 'error') {
                                Swal.fire(
                                    '¡Error!',
                                    'Ha ocurrido un error.',
                                    'error'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            }

                        }
                    });
                }
            });

        })

        var tot = $('.total_horas').val()
        $('.total_horas_show').text(tot)
    </script>
<?php
}
?>