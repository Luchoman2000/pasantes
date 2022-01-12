<?php if ($_SESSION['rol'] == "PASANTE") {
    require_once './controller/login.controlador.php';
    $logout = new LoginControlador();
    echo $logout->CtrCerrarSesion();
?>
    <script>
        alert("No tienes permisos para acceder a esta página");
        window.location.href = "../login";
    </script>
<?php

} elseif ($_SESSION['rol'] == "ADMINISTRADOR") {
    require_once './controller/perfil.controlador.php';
    $perfil = new PerfilControlador();
    $permite_cambio_clave = $perfil->CtrGetCoreConfig('permite_cambio_clave');


?>
    <link href="<?php echo SERVERURL ?>src/css/bulma-switch.min.css" rel="stylesheet">
    <link href="<?php echo SERVERURL ?>src/css/balloon.min.css" rel="stylesheet">
    <link href="<?php echo SERVERURL ?>src/css/bulma-checkradio.min.css" rel="stylesheet">


    <div class="card">
        <div class="card-content">
            <div class="container mW alignCenter content">
                <h1 class="title has-text-success">Administración</h1>
            </div>
        </div>
    </div>


    <br>
    <br>

    <div class="container">


        <div class="card">
            <div class="card-content">
                <!-- <div class="content"> -->

                <div class="tabs is-centered is-boxed is-medium">
                    <ul>
                        <li class="tab is-active" onclick="openTab(event,'usuarios')">
                            <a>
                                <span class="icon is-small"><i class="fa fa-user" aria-hidden="true"></i></span>
                                <span>Usuarios</span>
                            </a>
                        </li>
                        <li class="tab" onclick="openTab(event,'personal')">
                            <a>
                                <span class="icon is-small"><i class="fa fa-users" aria-hidden="true"></i></span>
                                <span>Personal</span>
                            </a>
                        </li>
                        <li class="tab" onclick="openTab(event,'horarios')">
                            <a>
                                <span class="icon is-small"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                <span>Horarios</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="content-tab" id="usuarios">
                    <div class="container">

                        <div class="card">
                            <!-- Nuevo usuario -->

                            <div class="columns is-vcentered is-align-items-center is-align-items-self-end">
                                <div class="column is-8">

                                    <button id="nuevo_usuario" class="button is-success is-outlined mt-4 ml-3 modal-button" data-target="usuarioForm" data-toggle="modal">
                                        <span class="icon is-small">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        </span>
                                        <span>Nuevo usuario</span>
                                    </button>
                                </div>
                                <div class="column">
                                    <div class="field is-pulled-right pr-4">
                                        <div class="control">
                                            <label class="checkbox">
                                                <!-- <input id="switchColorDefault" type="checkbox" name="switchColorDefault" class="switch" checked="checked"> -->

                                                <input name="checkbox_cambio_clave" class="switch is-rounded is-outlined" <?php echo $permite_cambio_clave ? 'checked' : '' ?> type="checkbox" id="checkbox_cambio_clave" onclick="toggle_permitir_cambio_clave()">
                                                <label for="checkbox_cambio_clave">Permitir cambio de clave </label>
                                                <!-- <span>Mostrar diferencia</span> -->
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card-content">
                                <!-- Tabla de usuarios -->
                                <div class="table-container">

                                    <?php
                                    require_once './controller/admin.controlador.php';
                                    $Usuarios = new AdminControlador();
                                    echo $Usuarios->CtrMostrarUsuarios();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-tab" id="personal" style="display: none;">
                    <div class="card">
                        <!-- Nuevo usuario -->

                        <button id="nuevo_personal" class="button is-success is-outlined mt-4 ml-3 modal-button" data-target="personalForm" data-toggle="modal">
                            <span class="icon is-small">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </span>
                            <span>Nueva persona</span>
                        </button>
                        <div class="card-content">
                            <!-- Tabla de usuarios -->
                            <div class="table-container">
                                <?php
                                require_once './controller/admin.controlador.php';
                                $Personal = new AdminControlador();
                                echo $Personal->CtrMostrarPersonal();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-tab" id="horarios" style="display: none;">
                    <div class="card">
                        <!-- Nuevo horario -->
                        <button id="nuevo_horario" class="button is-success is-outlined mt-4 ml-3 modal-button" data-target="horarioForm" data-toggle="modal">
                            <span class="icon is-small">
                                <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                            </span>
                            <span>Nuevo horario</span>
                        </button>
                        <div class="card-content">


                            <!-- Tabla de usuarios -->

                            <div class="table-container">
                                <?php
                                require_once './controller/admin.controlador.php';
                                $Personal = new AdminControlador();
                                echo $Personal->CtrMostrarHorarios();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- </div> -->
            </div>

        </div>

    </div>

    <div class="modal modal-fx-fadeInScale" id="usuarioForm">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="modal-card">
                <form id="mUsuario" novalidate>

                    <header class="modal-card-head">
                        <p class="modal-card-title"><strong class="mUserTitle"></strong> </p>
                    </header>

                    <section class="modal-card-body">

                        <div class="field ">
                            <label class="label">Personal</label>
                            <div class="control ">
                                <span class="select">
                                    <select name="uPersonal" class="euNombre">
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Usuario</label>
                            <div class="control has-icons-left">

                                <input name="uUsuario" class="input uUsuario" type="text" placeholder="Usuario">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field euClave">

                        </div>

                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label">Nueva</label>
                                    <div class="control has-icons-left">
                                        <input name="uNClave" class="input uNClave" type="password" placeholder="Clave">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="column">
                                <div class="field">
                                    <label class="label">Repita la clave</label>
                                    <div class="control has-icons-left">
                                        <input name="uSNClave" class="input uSNClave" type="password" placeholder="Clave">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label">Rol</label>
                                    <div class="control">
                                        <div class="select">
                                            <select name="uRol" class="euRol">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <label class="label">Estado</label>
                                    <div class="control">
                                        <div class="select">
                                            <select name="uEstado" class="euEstado">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- horario -->
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label">Horario</label>
                                    <div class="control">
                                        <div class="select">
                                            <select name="uHorario" class="euHorario">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </section>

                    <footer class="modal-card-foot">
                        <button type="submit" class="button is-success btnUsuarioForm"></button>
                    </footer>
                </form>

            </div>
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>

    <div class="modal modal-fx-fadeInScale" id="personalForm">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="modal-card">
                <form id="mPersonal" novalidate>

                    <header class="modal-card-head">
                        <p class="modal-card-title"><strong class="mPersonTitle"></strong> </p>
                    </header>

                    <section class="modal-card-body">
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label">Primer Nombre*</label>
                                    <div class="control">
                                        <input class="input pNombre" type="text" name="pNombre" placeholder="Nombre">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <label class="label">Segundo Nombre</label>
                                    <div class="control">
                                        <input class="input pNombre2" type="text" name="pNombre2" placeholder="Nombre">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label">Primer Apellido*</label>
                                    <div class="control">
                                        <input class="input pApellido" type="text" name="pApellido" placeholder="Apellido">
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <label class="label">Segundo Apellido</label>
                                    <div class="control">
                                        <input class="input pApellido2" type="text" name="pApellido2" placeholder="Apellido">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Cedula*</label>
                            <div class="control">
                                <input class="input pCedula" type="text" name="pCedula" placeholder="Cedula">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Telefono</label>
                            <div class="control">
                                <input class="input pTelefono" type="text" name="pTelefono" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Direccion</label>
                            <div class="control">
                                <input class="input pDireccion" type="text" name="pDireccion" placeholder="Direccion">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input pEmail" type="text" name="pEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Fecha nacimiento</label>
                            <div class="control">
                                <input class="input pFechaNacimiento" type="date" name="pFechaNacimiento" placeholder="Fecha nacimiento">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Estado</label>
                            <div class="control">
                                <div class="select">
                                    <select name="pEstado" class="pEstado">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-success btnPersonalForm">Guardar</button>
                        <!-- <button class="button modal-close-button">Cancelar</button> -->
                    </footer>
                </form>
            </div>

        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>

    <div class="modal modal-fx-fadeInScale" id="horarioForm">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="modal-card">
                <form id="mHorario" novalidate>
                    <header class="modal-card-head">
                        <p class="modal-card-title"><strong class="mHorarioTitle"></strong> </p>
                    </header>
                    <section class="modal-card-body">
                        <div class="columns is-multiline is-mobile is-align-items-self-end">
                            <div class="column is-two-fifths">
                                <div class="field">
                                    <label class="label">Hora entrada*</label>
                                    <div class="control">
                                        <input class="input hInicio" type="time" name="hInicio" placeholder="Hora Inicio">
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <div class="control">
                                        <label class="label is-inline">Compensación</label>

                                        <span data-balloon-length="medium" aria-label="Minutos de compensación, es decir los minutos que se van a restar " data-balloon-pos="right" style="cursor: help; color:turquoise " class="icon is-info mb-2">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        <input value="3" min="0" max="100" style="width: 5rem;" type="number" class="input " name="h_entrada_c"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-2">
                                <div class="field">
                                    <div class="control">
                                        <label class="label mb-2">Límite</label>

                                        <!-- <span aria-label="Límite " data-balloon-pos="right" style="cursor: help; color:turquoise" class="icon is-info mb-2">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span> -->
                                        <input value="10" min="0" max="100" type="number" class="input" name="h_limite"></input>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="column">

                                <div class="field">

                                    <div class="control">
                                        <label class="radio">
                                            <input type="radio" name="rsvp">
                                            Going
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="rsvp">
                                            Not going
                                        </label>
                                        <label class="radio" disabled>
                                            <input type="radio" name="rsvp" disabled>
                                            Maybe
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="column">
                                <div class="field">
                                    <input id="switchRoundedDefault" type="checkbox" name="switchRoundedDefault" class="switch is-rounded is-small" checked="checked">
                                    <label for="switchRoundedDefault">witch rounded defaultS</label>
                                </div>
                            </div> -->

                            <!-- <div class="column">
                                <div class="field">
                                    <label class="label">Hora Salida*</label>
                                    <div class="control">
                                        <input class="input hFin" type="time" name="hFin" placeholder="Hora Fin">
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <div class="columns is-multiline is-mobile is-align-items-self-end">
                            <!-- almuerzo inicio -->
                            <div class="column is-two-fifths">
                                <div class="field">
                                    <label class="label">Hora Almuerzo Inicio*</label>
                                    <div class="control">
                                        <input class="input hAlmuerzoInicio" type="time" name="hAlmuerzoInicio" placeholder="Hora Almuerzo Inicio">
                                    </div>
                                </div>
                            </div>

                            <div class="column is-4">
                                <div class="field">
                                    <div class="control">
                                        <label class="label is-inline">Compensación</label>

                                        <span data-balloon-length="medium" aria-label="Minutos de compensación, es decir los minutos que se van a restar " data-balloon-pos="right" style="cursor: help; color:turquoise " class="icon is-info mb-2">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        <input value="0" min="0" max="100" style="width: 5rem;" type="number" class="input " name="h_a_inicio_c"></input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="columns is-multiline is-mobile is-align-items-self-end">
                            <!-- almuerzo fin -->

                            <div class="column is-two-fifths">
                                <div class="field">
                                    <label class="label">Hora Almuerzo Fin*</label>
                                    <div class="control">
                                        <input class="input hAlmuerzoFin" type="time" name="hAlmuerzoFin" placeholder="Hora Almuerzo Fin">
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <div class="control">
                                        <label class="label is-inline">Compensación</label>

                                        <span data-balloon-length="medium" aria-label="Minutos de compensación, es decir los minutos que se van a restar " data-balloon-pos="right" style="cursor: help; color:turquoise " class="icon is-info mb-2">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        <input value="5" min="0" max="100" style="width: 5rem;" type="number" class="input " name="h_a_fin_c"></input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="columns is-multiline is-mobile is-align-items-self-end">
                            <!-- almuerzo fin -->
                            <div class="column is-two-fifths">
                                <div class="field">
                                    <label class="label">Hora Salida*</label>
                                    <div class="control">
                                        <input class="input hFin" type="time" name="hFin" placeholder="Hora Fin">
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <div class="control">
                                        <label class="label is-inline">Compensación</label>

                                        <span data-balloon-length="medium" aria-label="Minutos de compensación, es decir los minutos que se van a restar " data-balloon-pos="right" style="cursor: help; color:turquoise " class="icon is-info mb-2">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        <input value="0" min="0" max="100" style="width: 5rem;" type="number" class="input " name="h_salida_c"></input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="columns is-multiline is-mobile is-align-items-self-end">
                            <!-- almuerzo fin -->
                            <!-- <div class="column is-two-fifths"> -->
                            <!-- <div class="field">
                                    <label class="label">Tarde*</label>
                                    <div class="control">
                                        <input class="input hFin" type="time" name="hFin" placeholder="Hora Fin">
                                    </div>
                                </div> -->
                            <!-- </div> -->
                            <div class="column">
                                <div class="field">
                                    <div class="is-block mb-4">
                                        <label class="label is-inline mb-5">Tarde*</label>
                                        <span data-balloon-length="medium" aria-label="Condición en caso de que se marque la entrada después del límite" data-balloon-pos="right" style="cursor: help; color:turquoise " class="icon is-info mb-2 is-inline">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                    <div class="is-block">

                                        <input class="is-checkradio" id="m_t_0" type="radio" name="condicion_tarde" checked="checked" value="0">
                                        <label for="m_t_0">Si permitir <span data-balloon-length="medium" aria-label="Permite al pasante marcar el ingreso asi este haya marcado después del límite" data-balloon-pos="up" style="cursor: help; color:turquoise " class="icon is-info mb-2 is-inline">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </span></label>

                                        <input class="is-checkradio is-warning" id="m_t_1" type="radio" name="condicion_tarde" value="1">
                                        <label for="m_t_1">Si, con pensión <span data-balloon-length="medium" aria-label="Permite marcar el ingreso, pero con la la hora empiezan a contar desde el inicio del almuerzo" data-balloon-pos="up" style="cursor: help; color:turquoise " class="icon is-info mb-2 is-inline">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </span></label>

                                        <input class="is-checkradio is-danger" id="m_t_2" type="radio" name="condicion_tarde" value="2">
                                        <label for="m_t_2">No permitir <span data-balloon-length="medium" aria-label="En caso de que el pasante exeda el límite ya no se le permitirá seguir marcando ese día, es decir se anula el día " data-balloon-pos="up" style="cursor: help; color:turquoise " class="icon is-info mb-2 is-inline">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </span></label>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- </div> -->
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-success btnHorarioForm">Guardar</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo SERVERURL ?>src/js/ajax-admin.js"></script>

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
        $(document).ready(function() {
            $('#listaUsuarios').removeAttr('width').DataTable({

                "language": {
                    "url": SERVERURL + "/pasantes/src/es_es.json"
                },
                columnDefs: [{
                        width: 200,
                        targets: 0
                    },
                    {
                        width: 100,
                        targets: 4
                    },
                ],
                pagin: false,
                scrollCollapse: true,
                scroller: true,
                fixedColumns: true,


            });
            $('#listaPersonal').removeAttr('width').DataTable({
                "language": {
                    "url": SERVERURL + "/pasantes/src/es_es.json"
                },
                pagin: false,
                scrollCollapse: true,
                scroller: true,
                fixedColumns: true,

            });
            $('#listaHorarios').DataTable({
                "language": {
                    "url": SERVERURL + "/pasantes/src/es_es.json"
                },
                pagin: false,
                searching: false,
            });
        });
    </script>


<?php
}
?>