<?php if ($_SESSION['rol'] == "PASANTE") {
?>
    <script>
        alert("No tienes permisos para acceder a esta página");
        window.location.href = "../login";
    </script>
<?php

} elseif ($_SESSION['rol'] == "ADMINISTRADOR") {
?>
    <div class="card">
        <div class="card-content">
            <div class="container mW alignCenter content">
                <h1 class="title has-text-success">Administración</h1>
                <!-- <p>Historial de dias asistidos de <strong></strong> asta la fecha:</p> -->
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
                        <!-- <li>
                                <a>
                                    <span class="icon is-small"><i class="fa fa-file-alt" aria-hidden="true"></i></span>
                                    <span>Documents</span>
                                </a>
                            </li> -->
                    </ul>
                </div>

                <div class="content-tab" id="usuarios">
                    <div class="container">

                        <div class="card">
                            <!-- Nuevo usuario -->

                            <button id="nuevo_usuario" class="button is-success is-outlined mt-4 ml-3 modal-button" data-target="usuarioForm" data-toggle="modal">
                                <span class="icon is-small">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </span>
                                <span>Nuevo usuario</span>
                            </button>

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

                                <!-- <table id="listaPersonal" class="table stripe row-border order-column nowrap" style="width:100%; box-sizing: inherit;">
                                    <thead>
                                        <tr>
                                            <th>Nombre completo</th>
                                            <th>Cedula</th>
                                            <th>telefono</th>
                                            <th>Email</th>
                                            <th>Fecha nacimiento</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align: middle;">Estacio Sabando Luis Angel</td>
                                            <td style="vertical-align: middle;">1314147552</td>
                                            <td style="vertical-align: middle;">0878279968</td>
                                            <td style="vertical-align: middle;">asd@asd.com</td>
                                            <td style="vertical-align: middle;">2000-09-28</td>
                                            <td style="vertical-align: middle;">PASANTE</td>
                                            <td style="vertical-align: middle;">Activo</td>
                                            <td style="vertical-align: middle;">
                                                <button style="height: fit-content;" class="button is-success is-outlined ">
                                                    <span class="icon">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                                <button style="height: fit-content;" class="button is-danger is-outlined ">
                                                    <span class="icon">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </span>
                                                </button>



                                        </tr>
                                    </tbody>
                                </table> -->
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
                        <div class="card-content">


                            <!-- Tabla de usuarios -->
                            <table id="listaHorarios" class="table is-fullwidth is-striped is-hoverable">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Rol</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Luasdis</td>
                                        <td>Perez</td>
                                        <td>Admin</td>
                                        <td>asd@asd.com</td>

                                    </tr>
                                </tbody>
                            </table>
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
                                <!-- <span class="icon is-small is-left">
                                    <i class="fa fa-users"></i>
                                </span> -->
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
                                                <!-- <option>Administrador</option>
                                            <option>Pasante</option> -->
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
                                                <!-- <option>Activo</option>
                                            <option>Inactivo</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </section>

                    <footer class="modal-card-foot">
                        <button type="submit" class="button is-success btnUsuarioForm"></button>
                        <!-- <button class="button modal-button-close">Cancelar</button> -->
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
                        <!-- <div class="field">
                        <label class="label">Rol</label>
                        <div class="control">
                            <div class="select">
                                <select>
                                    <option>Administrador</option>
                                    <option>Pasante</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
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
                    "url": "../src/es_es.json"
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
                scrollY: "400px",
                pagin: false,
                "pagingType": "simple",
                // lengthChange: false,
                scrollCollapse: true,
                scroller: true,
                fixedColumns: true,


            });
            $('#listaPersonal').removeAttr('width').DataTable({
                // scrollY: "400px",
                "language": {
                    "url": "../src/es_es.json"
                },
                pagin: false,
                "pagingType": "simple",
                // lengthChange: false,
                scrollCollapse: true,
                scroller: true,
                fixedColumns: true,

            });
            $('#listaHorarios').DataTable({
                "language": {
                    "url": "../src/es_es.json"
                }
            });
        });
    </script>


    <!-- <script type="module">
        import BulmaModal from '../src/js/BulmaModal.js'

        // document.querySelector(".modal").addEventListener("modal:show", (event) => {
        //   console.log(event)
        // });
        const modals = document.querySelectorAll("[data-toggle='modal']");
        modals.forEach((modal) => new BulmaModal(modal));
    </script> -->




<?php
}
?>