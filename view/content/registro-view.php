<link href="<?php echo SERVERURL ?>src/css/bulma-calendar.min.css" rel="stylesheet">
<link href="<?php echo SERVERURL ?>src/css/calendar.main.min.css" rel="stylesheet">
<script src="<?php echo SERVERURL ?>src/js/calendar.main.min.js"></script>
<script src="<?php echo SERVERURL ?>src/js/es.js"></script>
<script src="<?php echo SERVERURL ?>src/js/bulma-calendar.min.js"></script>
<?php if ($_SESSION['rol'] == "PASANTE") {
    require_once './controller/perfil.controlador.php';
    $perfil = new PerfilControlador();
    $horario = $perfil->CtrGetHorario();
?>


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
                        <?php if ($_SESSION['hor_id'] != "1" && $_SESSION['hor_id'] != null) {
                        ?>
                            <div class="box">
                                <h4 class="is-title has-text-primary">Horario</h4>
                                <div class="columns">
                                    <div class="column">
                                        <span class=" ml-3 has-text-info">Entrada: <span class="s_h_entrada title is-6"><?php echo $horario['hor_entrada'] ?></span></span>
                                        <span class=" ml-3 has-text-info">Salida: <span class="s_h_salida title is-6"><?php echo $horario['hor_salida'] ?></span></span>
                                        <span class="ml-3 has-text-info">Horas: <span class="s_h_tot_horas title is-6"></span></span>
                                    </div>
                                    <!-- <div class="column">
                                        <span class=" ml-3 has-text-info">Almuerzo inicio: <span class=" title is-6"><?php echo $horario['hor_salida_a'] ?></span></span>
                                        <span class=" ml-3 has-text-info">Almuerzo fin: <span class=" title is-6"><?php echo $horario['hor_regreso_a'] ?></span></span>
                                    </div> -->
                                    <input class="s_h_salida_a" type="hidden" value="<?php echo $horario['hor_salida_a'] ?>">
                                    <input class="s_h_regreso_a" type="hidden" value="<?php echo $horario['hor_regreso_a'] ?>">
                                </div>
                                <div class="column ">
                                    <!-- Checkbox para mostrar o no las horas de diferencia -->
                                    <div class="field">
                                        <div class="control">
                                            <label class="checkbox">
                                                <input checked type="checkbox" id="checkbox_horas_diferencia" onclick="show_horas_diferencia()">
                                                <span>Mostrar diferencia</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php
                        } else {
                ?>
                    <div class="box">
                        <h4 class="is-title has-text-primary">Sin horario asignado</h4>
                    </div>
                    <script>
                        $(document).ready(function() {
                            show_horas_diferencia();
                        });
                    </script>
                <?php
                        } ?>


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
                <div class="p-4">

                    <div id='calendar'></div>
                </div>

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
                                        <input id="empresa" minlength="4" maxlength="20" class="input" type="text" name="empresa" value="Senescyt" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns">

                            <div class="column">
                                <div class="field">
                                    <label class="label">Tutor</label>
                                    <div class="control">
                                        <input id="tutor" minlength="4" maxlength="50" class="input" type="text" name="tutor" value="Ing. Majo" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns">

                            <div class="column">
                                <div class="field">
                                    <label class="label">Cargo</label>
                                    <div class="control">
                                        <input id="cargo" minlength="4" maxlength="100" class="input" type="text" name="cargo" value="Soporte al Usuario 3" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <div class="control">
                                        <label class="radio">
                                            <input checked type="radio" name="tipoA" value="word">
                                            WORD
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

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
        require_once './controller/perfil.controlador.php';
        $perfil = new PerfilControlador();
        $asistencia = new AsistenciaControlador();
        $id_u = $asistencia->CtrGetIdUsuario($id);
        $horario = $perfil->CtrGetHorario($id_u);
        // var_dump(mainModel::decryption($id_u));

        // var_dump($horario);

    ?>
        <div class="card">
            <div class="card-content">
                <div class="container mW alignCenter content">
                    <h1 class="title has-text-success">Registros</h1>
                    <p>Historial de dias asistidos de <strong><?php echo $asistencia->CtrGetNombrePasante($id) ?></strong> hasta la fecha:</p>
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
                                    <span class=" ml-3 has-text-info">Total Horas: <span class="total_horas_show title is-6"></span></span>
                                </div>
                                <div class="column">
                                    <div class="buttons is-right mr-3">

                                        <button type="submit" class=" btnExportarAsi is-outlined is-info button is-small modal-button" data-target="exportarAsistencia" data-toggle="modal">
                                            <span class="icon">
                                                <i class="fa fa-external-link" aria-hidden="true"></i>
                                            </span>
                                            <span>Exportar</span>
                                        </button>
                                        <button class=" btnNuevoRegistroAsi is-outlined is-primary button is-small modal-button" data-target="nuevoRegistroAsi" data-toggle="modal">
                                            <span class="icon">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </span>
                                            <span>Nuevo</span>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <?php if (@$horario['hor_id'] != "1" && !is_null(@$horario['hor_id'])) {
                            ?>
                                <div class="box">
                                    <h4 class="is-title has-text-primary">Horario</h4>
                                    <div class="columns">
                                        <div class="column">
                                            <span class=" ml-3 has-text-info">Entrada: <span class="s_h_entrada title is-6"><?php echo $horario['hor_entrada'] ?></span></span>
                                            <span class=" ml-3 has-text-info">Salida: <span class="s_h_salida title is-6"><?php echo $horario['hor_salida'] ?></span></span>
                                            <span class="ml-3 has-text-info">Horas: <span class="s_h_tot_horas title is-6"></span></span>
                                        </div>
                                        <!-- <div class="column">
                                        <span class=" ml-3 has-text-info">Almuerzo inicio: <span class=" title is-6"><?php echo $horario['hor_salida_a'] ?></span></span>
                                        <span class=" ml-3 has-text-info">Almuerzo fin: <span class=" title is-6"><?php echo $horario['hor_regreso_a'] ?></span></span>
                                    </div> -->
                                        <input class="s_h_salida_a" type="hidden" value="<?php echo $horario['hor_salida_a'] ?>">
                                        <input class="s_h_regreso_a" type="hidden" value="<?php echo $horario['hor_regreso_a'] ?>">
                                    </div>
                                    <div class="column ">
                                        <!-- Checkbox para mostrar o no las horas de diferencia -->
                                        <div class="field">
                                            <div class="control">
                                                <label class="checkbox">
                                                    <input checked type="checkbox" id="checkbox_horas_diferencia" onclick="show_horas_diferencia()">
                                                    <span>Mostrar diferencia</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <?php
                            } else {
                    ?>
                        <div class="box">
                            <h4 class="is-title has-text-primary">Sin horario asignado</h4>
                        </div>
                        <script>
                            $(document).ready(function() {
                                show_horas_diferencia();
                            });
                        </script>
                    <?php
                            } ?>

                    <div class="table-container">
                        <?php
                        // var_dump($horario);
                        echo $asistencia->CtrMostrarAsistenciaPasanteAdmin(($horario == 1) ? $horario : $horario['hor_id']);
                        ?>
                    </div>
                    </div>
                </div>
                <div class="content-tab is-active" id="calendario">
                    <div class="p-4">

                        <div id='calendar'></div>
                    </div>
                </div>
            </div>

        </div>

        </div>

        <div class="modal modal-fx-fadeInScale" id="edit_hora">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="modal-card">

                    <form id="guardar_edicion" novalidate>


                        <header class="modal-card-head">
                            <p class="modal-card-title">Editar asistencia</p>
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
                                    <span class="tag is-white is-link is-light ml-2"></span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora fin del almuerzo:</label>
                                </div>
                                <div class="column">
                                    <input id="h_almuerzo_end_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_end_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2"></span>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora salida:</label>
                                </div>
                                <div class="column">
                                    <input id="h_salida_u" style="width: 60%; height:29px;" type="time" name="h_salida_u" step="2">
                                    <span class="tag is-white is-link is-light ml-2"></span>
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
        <div class="modal modal-fx-fadeInScale" id="nuevoRegistroAsi">
            <div class="modal-background"></div>
            <div class="modal-content">
                <div class="modal-card">

                    <!-- <input id="appt-time" type="time" name="appt-time" step="2"> -->
                    <form id="guardar_nuevo_registro" novalidate>


                        <header class="modal-card-head">
                            <p class="modal-card-title">Nuevo registro</p>
                            <!-- <button class="delete modal-close" aria-label="close"></button> -->
                        </header>

                        <section class="modal-card-body ">

                            <!-- <div class="field">
                                <label class="label">Empresa</label>
                                <div class="control">
                                    <input class="input" type="text" name="empresa" value="Senescyt" required>
                                </div>
                            </div> -->
                            <div class="columns">
                                <div class="column is-5 is-align-self-center">
                                    <label class="label has-text-info ">Fecha:</label>

                                </div>
                                <div class="column is-7">

                                    <!-- <input type="date" id="date_range" data-show-header="false" data-display-mode="dialog" data-is-range="true" data-close-on-select="false"> -->
                                    <input id="fecha_n_a" class="date is-medium " type="date" name="fecha">
                                </div>
                            </div>

                            <!-- <div class="column">
                                    <div class="field">
                                        <label for="date_end">Fecha de fin</label>
                                        <input id="date_end" type="date" name="date_end" class="input">
                                    </div>
                                </div> -->
                            <!-- <div class="mt-3"></div> -->
                            <!-- <button class="btnAutoFill button is-outlined is-info mb-3">

                                <span class="icon ">
                                    <i class="fa fa-plus-square"></i>
                                </span>
                                <span>Acorde al horario</span>
                            </button> -->
                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora de ingreso:</label>
                                </div>
                                <div class="column">
                                    <input id="h_entrada_u" style="width: 60%; height:29px;" type="time" name="h_entrada_u" step="2" value="00:00:00">

                                    <button class="btnReset_h_e button is-outlined is-info is-small mb-3" data-tooltip="Horario">
                                        <span class="icon is-small">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                    </button>

                                    <!-- <span class="tag is-white is-link is-light ml-2"></span> -->
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora inicio del almuerzo:</label>
                                </div>
                                <div class="column">
                                    <input id="h_almuerzo_start_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_start_u" step="2" value="00:00:00">
                                    <!-- <span class="tag is-white is-link is-light ml-2">11:12:12</span> -->

                                    <button class="btnReset_i_a button is-outlined is-info is-small mb-3" data-tooltip="Horario">
                                        <span class="icon is-small">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora fin del almuerzo:</label>
                                </div>
                                <div class="column">
                                    <input id="h_almuerzo_end_u" style="width: 60%; height:29px;" type="time" name="h_almuerzo_end_u" step="2" value="00:00:00">
                                    <!-- <span class="tag is-white is-link is-light ml-2">11:12:12</span> -->

                                    <button class="btnReset_f_a button is-outlined is-info is-small mb-3" data-tooltip="Horario">
                                        <span class="icon is-small">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column is-5">
                                    <label class="label has-text-info">Hora salida:</label>
                                </div>
                                <div class="column">
                                    <input id="h_salida_u" style="width: 60%; height:29px;" type="time" name="h_salida_u" step="2" value="00:00:00">
                                    <!-- <span class="tag is-white is-link is-light ml-2">11:12:12</span> -->

                                    <button class="btnReset_s button is-outlined is-info is-small mb-3" data-tooltip="Horario">
                                        <span class="icon is-small">
                                            <i class="fa fa-refresh"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <!-- id usuario -->
                            <input type="hidden" name="id_personal" value="<?php echo $id; ?>">

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
        <div class="modal modal-fx-fadeInScale" id="exportarAsistencia">
            <div class="modal-background"></div>
            <div class="modal-content mx-0">
                <div class="modal-card">
                    <form method="POST" id="exportarWord" action="<?php echo SERVERURL ?>ajax/reporte.ajax.php">
                        <input type="hidden" name="reporte_asistencia" value="1">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Exportar </p>
                        </header>
                        <section class="modal-card-body">
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label class="label">Empresa</label>
                                        <div class="control">
                                            <input minlength="4" maxlength="20" class="input" type="text" name="empresa" value="Senescyt" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">

                                <div class="column">
                                    <div class="field">
                                        <label class="label">Tutor</label>
                                        <div class="control">
                                            <input minlength="4" maxlength="50" class="input" type="text" name="tutor" value="Ing. Majo" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">

                                <div class="column">
                                    <div class="field">
                                        <label class="label">Cargo</label>
                                        <div class="control">
                                            <input minlength="4" maxlength="100" class="input" type="text" name="cargo" value="Soporte al Usuario 3" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <div class="control">
                                            <label class="radio">
                                                <input checked type="radio" name="tipoA" value="word">
                                                WORD
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input name="id" value="<?php echo $id ?>" type="text" hidden>
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
                        id_p: "<?php echo $id ?>"

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
            // var b_calendar = new bulmaCalendar('#date_range', {
            //     dateFormat: 'yyyy/MM/dd',
            //     disabledDates: [<?php echo $asistencia->CtrGetDatesById($id) ?>],
            //     lang: 'es',
            // });
            // b_calendar.on('select', date => {
            //     console.log(date);
            // });
        </script>


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
                    <p>Historial de dias asistidos de todos los pasantes hasta la fecha:</p>
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


                        </div>
                        <div class="table-container">
                            <div>
                                Filtro comunas: <a class="toggle-vis" data-column="0">Pasante</a> - <a class="toggle-vis" data-column="1">Fecha</a> - <a class="toggle-vis" data-column="2">Ingreso</a> - <a class="toggle-vis" data-column="3">Almuerzo incio</a> - <a class="toggle-vis" data-column="4">Almuerzo fin</a> - <a class="toggle-vis" data-column="5">Salida</a> - <a class="toggle-vis" data-column="6">Horas</a>
                            </div>
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
            $('#totalAsistencia thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#totalAsistencia thead');
            var table = $('#totalAsistencia').DataTable({
                "language": {
                    "url": "./src/es_es.json"
                },
                searching: false,
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');

                            // On every keypress in this input
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('keyup change', function(e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value + ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();

                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });
            $('a.toggle-vis').on('click', function(e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column($(this).attr('data-column'));

                // Toggle the visibility
                column.visible(!column.visible());
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
            // console.log(id);
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
    function show_horas_diferencia() {
        $('.h_diff').toggle('slow');
    }
</script>